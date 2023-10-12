<?php
declare(strict_types=1);
/**
 * Copyright © ict. All rights reserved.
 * https://ict.lv/
 */

namespace ICT\Klar\Model;

use ICT\Klar\Api\Data\CustomerInterfaceFactory;
use ICT\Klar\Api\Data\LineItemInterfaceFactory;
use ICT\Klar\Api\Data\OptionalIdentifiersInterface;
use ICT\Klar\Api\Data\OptionalIdentifiersInterfaceFactory;
use ICT\Klar\Api\Data\OrderInterface;
use ICT\Klar\Api\Data\OrderInterfaceFactory;
use ICT\Klar\Api\Data\RefundedLineItemInterfaceFactory;
use ICT\Klar\Api\Data\ShippingInterfaceFactory;
use ICT\Klar\Model\Builders\CustomerBuilder;
use ICT\Klar\Model\Builders\LineItemsBuilder;
use ICT\Klar\Model\Builders\RefundedLineItemsBuilder;
use ICT\Klar\Model\Builders\ShippingBuilder;
use ICT\Klar\Model\Builders\OptionalIdentifiersBuilder;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\Intl\DateTimeFactory;
use Magento\Sales\Api\Data\InvoiceInterface;
use Magento\Sales\Api\Data\OrderInterface as SalesOrderInterface;
use Magento\Sales\Api\Data\ShipmentInterface;
use Magento\Sales\Model\Order as SalesOrderModel;
use Magento\Sales\Model\Order\Shipment as ShipmentModel;
use Magento\Store\Model\StoreManagerInterface;

class ApiRequestParamsBuilder extends AbstractApiRequestParamsBuilder
{
    private const EMPTY_VALUE = '-';
    private const FINANCIAL_STATUS_PENDING = 'pending';
    private const FINANCIAL_STATUS_PAID = 'paid';
    private const FINANCIAL_STATUS_PARTIALLY_PAID = 'partially_paid';
    private const FINANCIAL_STATUS_REFUNDED = 'refunded';
    private const FINANCIAL_STATUS_PARTIALLY_REFUNDED = 'partially_refunded';
    private const SHIPMENT_STATUS_NOT_SHIPPED = 'not_shipped';
    private const SHIPMENT_STATUS_SHIPPED = 'shipped';
    private const SHIPMENT_STATUS_PARTIALLY_SHIPPED = 'partially_shipped';

    private OrderInterfaceFactory $orderFactory;
    private StoreManagerInterface $storeManager;
    private LineItemsBuilder $lineItemsBuilder;
    private RefundedLineItemsBuilder $refundedLineItemsBuilder;
    private ShippingBuilder $shippingBuilder;
    private CustomerBuilder $customerBuilder;
    private OptionalIdentifiersInterfaceFactory $optionalIdentifiersFactory;
    private OptionalIdentifiersBuilder $optionalIdentifiersBuilder;

    /**
     * ParamsBuilder constructor.
     *
     * @param DateTimeFactory $dateTimeFactory
     * @param OrderInterfaceFactory $orderFactory
     * @param StoreManagerInterface $storeManager
     * @param LineItemsBuilder $lineItemsBuilder
     * @param RefundedLineItemsBuilder $refundedLineItemsBuilder
     * @param ShippingBuilder $shippingBuilder
     * @param CustomerBuilder $customerBuilder
     * @param OptionalIdentifiersInterfaceFactory $optionalIdentifiersFactory
     * @param OptionalIdentifiersBuilder $optionalIdentifiersBuilder
     */
    public function __construct(
        DateTimeFactory $dateTimeFactory,
        OrderInterfaceFactory $orderFactory,
        StoreManagerInterface $storeManager,
        LineItemsBuilder $lineItemsBuilder,
        RefundedLineItemsBuilder $refundedLineItemsBuilder,
        ShippingBuilder $shippingBuilder,
        CustomerBuilder $customerBuilder,
        OptionalIdentifiersInterfaceFactory $optionalIdentifiersFactory,
        OptionalIdentifiersBuilder $optionalIdentifiersBuilder
    ) {
        parent::__construct($dateTimeFactory);
        $this->orderFactory = $orderFactory;
        $this->storeManager = $storeManager;
        $this->lineItemsBuilder = $lineItemsBuilder;
        $this->refundedLineItemsBuilder = $refundedLineItemsBuilder;
        $this->shippingBuilder = $shippingBuilder;
        $this->customerBuilder = $customerBuilder;
        $this->optionalIdentifiersFactory = $optionalIdentifiersFactory;
        $this->optionalIdentifiersBuilder = $optionalIdentifiersBuilder;
    }

    /**
     * Build params array from sales order.
     *
     * @param SalesOrderInterface $salesOrder
     *
     * @return array
     */
    public function buildFromSalesOrder(SalesOrderInterface $salesOrder): array
    {
        /* @var OrderInterface $order */
        $order = $this->orderFactory->create();
        $processedAt = $this->getProcessedAt($salesOrder);

        $order->setId($salesOrder->getId());
        $order->setCreatedAt($this->getTimestamp($salesOrder->getCreatedAt()));
        $order->setUpdatedAt($this->getTimestamp($salesOrder->getUpdatedAt()));

        if ($processedAt) {
            $order->setProcessedAt($processedAt);
        }

        $order->setClosedAt($this->getClosedAt($salesOrder));
        $order->setCancelledAt($this->getCancelledAt($salesOrder));
        $order->setCurrencyCodeIso3Letter($salesOrder->getOrderCurrencyCode());
        $order->setFinancialStatus($this->getFinancialStatus($salesOrder));
        $order->setShipmentStatus($this->getShipmentStatus($salesOrder));
        $order->setPaymentGatewayName($salesOrder->getPayment()->getMethod());
        $order->setPaymentMethodName(
            $salesOrder->getPayment()->getAdditionalInformation('method_title') ?? self::EMPTY_VALUE
        );
        $order->setOrderName($this->getOrderName($salesOrder));
        $order->setOrderNumber($salesOrder->getIncrementId());
        $order->setLineItems($this->lineItemsBuilder->buildFromSalesOrder($salesOrder));
        $order->setRefundedLineItems($this->refundedLineItemsBuilder->buildFromSalesOrder($salesOrder));
        $order->setShipping($this->shippingBuilder->buildFromSalesOrder($salesOrder));
        $order->setCustomer($this->customerBuilder->buildFromSalesOrder($salesOrder));
        $order->setOptionalIdentifiers($this->optionalIdentifiersBuilder->buildFromSalesOrder($salesOrder));

        return $this->snakeToCamel($order->toArray());
    }

    /**
     * Get sales order processed at timestamp.
     *
     * @param SalesOrderInterface $salesOrder
     *
     * @return false|int
     */
    private function getProcessedAt(SalesOrderInterface $salesOrder)
    {
        $processedAt = false;

        if ($salesOrder->hasShipments()) {
            /* @var ShipmentModel $firstShipment */
            $firstShipment = $salesOrder->getShipmentsCollection()
                ->addFieldToSelect(ShipmentInterface::CREATED_AT)
                ->getFirstItem();

            if ($firstShipment->getId()) {
                $processedAt = $this->getTimestamp($firstShipment->getUpdatedAt());
            }
        }

        return $processedAt;
    }

    /**
     * Get sales order closed at timestamp.
     *
     * @param SalesOrderInterface $salesOrder
     *
     * @return int
     */
    private function getClosedAt(SalesOrderInterface $salesOrder): int
    {
        $closedAt = 0;

        foreach ($salesOrder->getAllStatusHistory() as $orderComment) {
            if ($orderComment->getStatus() === SalesOrderModel::STATE_CLOSED) {
                $closedAt = $this->getTimestamp($orderComment->getCreatedAt());
            }
        }

        return $closedAt;
    }

    /**
     * Get sales order cancelled at.
     *
     * @param SalesOrderInterface $salesOrder
     *
     * @return int
     */
    private function getCancelledAt(SalesOrderInterface $salesOrder): int
    {
        $cancelledAt = 0;

        if ($salesOrder->getStatus() === SalesOrderModel::STATE_CANCELED) {
            $cancelledAt = $this->getTimestamp($salesOrder->getUpdatedAt());
        }

        return $cancelledAt;
    }

    /**
     * Get sales order financial status.
     *
     * @param SalesOrderInterface $salesOrder
     *
     * @return string
     */
    private function getFinancialStatus(SalesOrderInterface $salesOrder): string
    {
        $financialStatus = self::FINANCIAL_STATUS_PENDING;
        $totalPaid = (float)$salesOrder->getTotalPaid();
        $totalRefunded = (float)$salesOrder->getTotalRefunded();
        $grandTotal = $salesOrder->getGrandTotal();

        if ($totalPaid >= $grandTotal) {
            $financialStatus = self::FINANCIAL_STATUS_PAID;
        }

        if ($totalPaid > 0 && $totalPaid < $grandTotal) {
            $financialStatus = self::FINANCIAL_STATUS_PARTIALLY_PAID;
        }

        if ($totalRefunded >= $grandTotal) {
            $financialStatus = self::FINANCIAL_STATUS_REFUNDED;
        }

        if ($totalRefunded > 0 && $totalRefunded < $grandTotal) {
            $financialStatus = self::FINANCIAL_STATUS_PARTIALLY_REFUNDED;
        }

        return $financialStatus;
    }

    /**
     * Get sales order shipment status.
     *
     * @param SalesOrderInterface $salesOrder
     *
     * @return string
     */
    private function getShipmentStatus(SalesOrderInterface $salesOrder): string
    {
        $shipmentStatus = self::SHIPMENT_STATUS_NOT_SHIPPED;

        if ($salesOrder->hasShipments()) {
            $qtyOrdered = (float)$salesOrder->getTotalQtyOrdered();
            $qtyShipped = 0;

            $shipments = $salesOrder->getShipmentsCollection()
                ->addFieldToSelect(ShipmentInterface::TOTAL_QTY)
                ->getItems();

            /* @var ShipmentModel $shipment */
            foreach ($shipments as $shipment) {
                if ($shipment->getId()) {
                    $qtyShipped += (float)$shipment->getTotalQty();
                }
            }

            if ($qtyShipped < $qtyOrdered) {
                $shipmentStatus = self::SHIPMENT_STATUS_PARTIALLY_SHIPPED;
            } else {
                $shipmentStatus = self::SHIPMENT_STATUS_SHIPPED;
            }
        }

        return $shipmentStatus;
    }

    /**
     * Get order name.
     *
     * @param SalesOrderInterface $salesOrder
     *
     * @return string
     */
    private function getOrderName(SalesOrderInterface $salesOrder): string
    {
        $orderName = self::EMPTY_VALUE;
        try {
            $storeName = $this->storeManager->getStore($salesOrder->getStoreId())->getName();
            $orderName = $storeName . ' - Order #' . $salesOrder->getIncrementId();
        } catch (NoSuchEntityException $e) {
            return $orderName;
        }

        return $orderName;
    }

    /**
     * Get optional identifiers.
     *
     * @return OptionalIdentifiersInterface
     */
    private function getOptionalIdentifiers(): OptionalIdentifiersInterface
    {
        return $this->optionalIdentifiersFactory->create();
    }
}

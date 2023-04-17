<?php
declare(strict_types=1);
/**
 * Copyright © ict. All rights reserved.
 * https://ict.lv/
 */

namespace ICT\Klar\Model\Builders;

use ICT\Klar\Api\Data\RefundedLineItemInterface;
use ICT\Klar\Api\Data\RefundedLineItemInterfaceFactory;
use ICT\Klar\Model\AbstractApiRequestParamsBuilder;
use Magento\Framework\Intl\DateTimeFactory;
use Magento\Sales\Api\Data\OrderInterface as SalesOrderInterface;

class RefundedLineItemsBuilder extends AbstractApiRequestParamsBuilder
{
    private RefundedLineItemInterfaceFactory $refundedLineItemFactory;

    /**
     * RefundedLineItemsBuilder constructor.
     *
     * @param DateTimeFactory $dateTimeFactory
     * @param RefundedLineItemInterfaceFactory $refundedLineItemFactory
     */
    public function __construct(
        DateTimeFactory $dateTimeFactory,
        RefundedLineItemInterfaceFactory $refundedLineItemFactory
    ) {
        parent::__construct($dateTimeFactory);
        $this->refundedLineItemFactory = $refundedLineItemFactory;
    }

    /**
     * Build refunded line items array from sales order.
     *
     * @param SalesOrderInterface $salesOrder
     *
     * @return array
     */
    public function buildFromSalesOrder(SalesOrderInterface $salesOrder): array
    {
        $refundedLineItems = [];

        foreach ($salesOrder->getItems() as $salesOrderItem) {
            if (!(float)$salesOrderItem->getQtyRefunded()) {
                continue;
            }

            /* @var RefundedLineItemInterface $refundedLineItem */
            $refundedLineItem = $this->refundedLineItemFactory->create();

            $refundedLineItem->setId((string)$salesOrderItem->getId());
            $refundedLineItem->setLineItemId((string)$salesOrderItem->getId());
            $refundedLineItem->setRefundedQuantity((float)$salesOrderItem->getQtyRefunded());
            $refundedLineItem->setCreatedAt($this->getTimestamp($salesOrderItem->getUpdatedAt()));

            $refundedLineItems[] = $this->snakeToCamel($refundedLineItem->toArray());
        }

        return $refundedLineItems;
    }
}

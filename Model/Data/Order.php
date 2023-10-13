<?php
declare(strict_types=1);
/**
 * Copyright © ict. All rights reserved.
 * https://ict.lv/
 */

namespace ICT\Klar\Model\Data;

use ICT\Klar\Api\Data\OptionalIdentifiersInterface;
use ICT\Klar\Api\Data\OrderInterface;
use Magento\Framework\DataObject;

class Order extends DataObject implements OrderInterface
{
    /**
     * Getter for Id.
     *
     * @return string|null
     */
    public function getId(): ?string
    {
        return $this->getData(self::ID);
    }

    /**
     * Setter for Id.
     *
     * @param string|null $id
     *
     * @return void
     */
    public function setId(?string $id): void
    {
        $this->setData(self::ID, $id);
    }

    /**
     * Getter for CreatedAt.
     *
     * @return int|null
     */
    public function getCreatedAt(): ?int
    {
        return $this->getData(self::CREATED_AT) === null ? null
            : (int)$this->getData(self::CREATED_AT);
    }

    /**
     * Setter for CreatedAt.
     *
     * @param int|null $createdAt
     *
     * @return void
     */
    public function setCreatedAt(?int $createdAt): void
    {
        $this->setData(self::CREATED_AT, $createdAt);
    }

    /**
     * Getter for UpdatedAt.
     *
     * @return int|null
     */
    public function getUpdatedAt(): ?int
    {
        return $this->getData(self::UPDATED_AT) === null ? null
            : (int)$this->getData(self::UPDATED_AT);
    }

    /**
     * Setter for UpdatedAt.
     *
     * @param int|null $updatedAt
     *
     * @return void
     */
    public function setUpdatedAt(?int $updatedAt): void
    {
        $this->setData(self::UPDATED_AT, $updatedAt);
    }

    /**
     * Getter for ProcessedAt.
     *
     * @return int|null
     */
    public function getProcessedAt(): ?int
    {
        return $this->getData(self::PROCESSED_AT) === null ? null
            : (int)$this->getData(self::PROCESSED_AT);
    }

    /**
     * Setter for ProcessedAt.
     *
     * @param int|null $processedAt
     *
     * @return void
     */
    public function setProcessedAt(?int $processedAt): void
    {
        $this->setData(self::PROCESSED_AT, $processedAt);
    }

    /**
     * Getter for ClosedAt.
     *
     * @return int|null
     */
    public function getClosedAt(): ?int
    {
        return $this->getData(self::CLOSED_AT) === null ? null
            : (int)$this->getData(self::CLOSED_AT);
    }

    /**
     * Setter for ClosedAt.
     *
     * @param int|null $closedAt
     *
     * @return void
     */
    public function setClosedAt(?int $closedAt): void
    {
        $this->setData(self::CLOSED_AT, $closedAt);
    }

    /**
     * Getter for CancelledAt.
     *
     * @return int|null
     */
    public function getCancelledAt(): ?int
    {
        return $this->getData(self::CANCELLED_AT) === null ? null
            : (int)$this->getData(self::CANCELLED_AT);
    }

    /**
     * Setter for CancelledAt.
     *
     * @param int|null $cancelledAt
     *
     * @return void
     */
    public function setCancelledAt(?int $cancelledAt): void
    {
        $this->setData(self::CANCELLED_AT, $cancelledAt);
    }

    /**
     * Getter for CurrencyCodeIso3Letter.
     *
     * @return string|null
     */
    public function getCurrencyCodeIso3Letter(): ?string
    {
        return $this->getData(self::CURRENCY_CODE_ISO3_LETTER);
    }

    /**
     * Setter for CurrencyCodeIso3Letter.
     *
     * @param string|null $currencyCodeIso3Letter
     *
     * @return void
     */
    public function setCurrencyCodeIso3Letter(?string $currencyCodeIso3Letter): void
    {
        $this->setData(self::CURRENCY_CODE_ISO3_LETTER, $currencyCodeIso3Letter);
    }

    /**
     * Getter for FinancialStatus.
     *
     * @return string|null
     */
    public function getFinancialStatus(): ?string
    {
        return $this->getData(self::FINANCIAL_STATUS);
    }

    /**
     * Setter for FinancialStatus.
     *
     * @param string|null $financialStatus
     *
     * @return void
     */
    public function setFinancialStatus(?string $financialStatus): void
    {
        $this->setData(self::FINANCIAL_STATUS, $financialStatus);
    }

    /**
     * Getter for ShipmentStatus.
     *
     * @return string|null
     */
    public function getShipmentStatus(): ?string
    {
        return $this->getData(self::SHIPMENT_STATUS);
    }

    /**
     * Setter for ShipmentStatus.
     *
     * @param string|null $shipmentStatus
     *
     * @return void
     */
    public function setShipmentStatus(?string $shipmentStatus): void
    {
        $this->setData(self::SHIPMENT_STATUS, $shipmentStatus);
    }

    /**
     * Getter for PaymentGatewayName.
     *
     * @return string|null
     */
    public function getPaymentGatewayName(): ?string
    {
        return $this->getData(self::PAYMENT_GATEWAY_NAME);
    }

    /**
     * Setter for PaymentGatewayName.
     *
     * @param string|null $paymentGatewayName
     *
     * @return void
     */
    public function setPaymentGatewayName(?string $paymentGatewayName): void
    {
        $this->setData(self::PAYMENT_GATEWAY_NAME, $paymentGatewayName);
    }

    /**
     * Getter for PaymentMethodName.
     *
     * @return string|null
     */
    public function getPaymentMethodName(): ?string
    {
        return $this->getData(self::PAYMENT_METHOD_NAME);
    }

    /**
     * Setter for PaymentMethodName.
     *
     * @param string|null $paymentMethodName
     *
     * @return void
     */
    public function setPaymentMethodName(?string $paymentMethodName): void
    {
        $this->setData(self::PAYMENT_METHOD_NAME, $paymentMethodName);
    }

    /**
     * Getter for OrderName.
     *
     * @return string|null
     */
    public function getOrderName(): ?string
    {
        return $this->getData(self::ORDER_NAME);
    }

    /**
     * Setter for OrderName.
     *
     * @param string|null $orderName
     *
     * @return void
     */
    public function setOrderName(?string $orderName): void
    {
        $this->setData(self::ORDER_NAME, $orderName);
    }

    /**
     * Getter for OrderNumber.
     *
     * @return string|null
     */
    public function getOrderNumber(): ?string
    {
        return $this->getData(self::ORDER_NUMBER);
    }

    /**
     * Setter for OrderNumber.
     *
     * @param string|null $orderNumber
     *
     * @return void
     */
    public function setOrderNumber(?string $orderNumber): void
    {
        $this->setData(self::ORDER_NUMBER, $orderNumber);
    }

    /**
     * Getter for Tags.
     *
     * @return string|null
     */
    public function getTags(): ?string
    {
        return $this->getData(self::TAGS);
    }

    /**
     * Setter for Tags.
     *
     * @param string|null $tags
     *
     * @return void
     */
    public function setTags(?string $tags): void
    {
        $this->setData(self::TAGS, $tags);
    }

    /**
     * Getter for LineItems.
     *
     * @return array|null
     */
    public function getLineItems(): ?array
    {
        return $this->getData(self::LINE_ITEMS);
    }

    /**
     * Setter for LineItems.
     *
     * @param array|null $lineItems
     *
     * @return void
     */
    public function setLineItems(?array $lineItems): void
    {
        $this->setData(self::LINE_ITEMS, $lineItems);
    }

    /**
     * Getter for RefundedLineItems.
     *
     * @return array|null
     */
    public function getRefundedLineItems(): ?array
    {
        return $this->getData(self::REFUNDED_LINE_ITEMS);
    }

    /**
     * Setter for RefundedLineItems.
     *
     * @param array|null $refundedLineItems
     */
    public function setRefundedLineItems(?array $refundedLineItems): void
    {
        $this->setData(self::REFUNDED_LINE_ITEMS, $refundedLineItems);
    }

    /**
     * Getter for Shipping.
     *
     * @return array|null
     */
    public function getShipping(): ?array
    {
        return $this->getData(self::SHIPPING);
    }

    /**
     * Setter for Shipping.
     *
     * @param array $shipping
     *
     * @return void
     */
    public function setShipping(array $shipping): void
    {
        $this->setData(self::SHIPPING, $shipping);
    }

    /**
     * Getter for TransactionCosts.
     *
     * @return float|null
     */
    public function getTransactionCosts(): ?float
    {
        return $this->getData(self::TRANSACTION_COSTS);
    }

    /**
     * Setter for Transaction Costs.
     *
     * @param float|null $transactionCosts
     *
     * @return void
     */
    public function setTransactionCosts(?float $transactionCosts): void
    {
        $this->setData(self::TRANSACTION_COSTS, $transactionCosts);
    }

    /**
     * Getter for Customer.
     *
     * @return array|null
     */
    public function getCustomer(): ?array
    {
        return $this->getData(self::CUSTOMER);
    }

    /**
     * Setter for Customer.
     *
     * @param array $customer
     *
     * @return void
     */
    public function setCustomer(array $customer): void
    {
        $this->setData(self::CUSTOMER, $customer);
    }

    /**
     * Getter for OptionalIdentifiers.
     *
     * @return array|null
     */
    public function getOptionalIdentifiers(): ?array
    {
        return $this->getData(self::OPTIONAL_IDENTIFIERS);
    }

    /**
     * Setter for OptionalIdentifiers.
     *
     * @param array $optionalIdentifiers
     *
     * @return void
     */
    public function setOptionalIdentifiers(array $optionalIdentifiers): void
    {
        $this->setData(self::OPTIONAL_IDENTIFIERS, $optionalIdentifiers);
    }
}

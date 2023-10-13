<?php
declare(strict_types=1);
/**
 * Copyright © ict. All rights reserved.
 * https://ict.lv/
 */

namespace ICT\Klar\Api\Data;

interface OrderInterface
{
    /**
     * String constants for property names
     */
    public const ID = 'id';
    public const CREATED_AT = 'created_at';
    public const UPDATED_AT = 'updated_at';
    public const PROCESSED_AT = 'processed_at';
    public const CLOSED_AT = 'closed_at';
    public const CANCELLED_AT = 'cancelled_at';
    public const CURRENCY_CODE_ISO3_LETTER = 'currency_code_iso3_letter';
    public const FINANCIAL_STATUS = 'financial_status';
    public const SHIPMENT_STATUS = 'shipment_status';
    public const PAYMENT_GATEWAY_NAME = 'payment_gateway_name';
    public const PAYMENT_METHOD_NAME = 'payment_method_name';
    public const ORDER_NAME = 'order_name';
    public const ORDER_NUMBER = 'order_number';
    public const TAGS = 'tags';
    public const LINE_ITEMS = 'line_items';
    public const REFUNDED_LINE_ITEMS = 'refunded_line_items';
    public const SHIPPING = 'shipping';
    public const TRANSACTION_COSTS = 'transaction_costs';
    public const CUSTOMER = 'customer';
    public const OPTIONAL_IDENTIFIERS = 'optional_identifiers';

    /**
     * Getter for Id.
     *
     * @return string|null
     */
    public function getId(): ?string;

    /**
     * Setter for Id.
     *
     * @param string|null $id
     *
     * @return void
     */
    public function setId(?string $id): void;

    /**
     * Getter for CreatedAt.
     *
     * @return int|null
     */
    public function getCreatedAt(): ?int;

    /**
     * Setter for CreatedAt.
     *
     * @param int|null $createdAt
     *
     * @return void
     */
    public function setCreatedAt(?int $createdAt): void;

    /**
     * Getter for UpdatedAt.
     *
     * @return int|null
     */
    public function getUpdatedAt(): ?int;

    /**
     * Setter for UpdatedAt.
     *
     * @param int|null $updatedAt
     *
     * @return void
     */
    public function setUpdatedAt(?int $updatedAt): void;

    /**
     * Getter for ProcessedAt.
     *
     * @return int|null
     */
    public function getProcessedAt(): ?int;

    /**
     * Setter for ProcessedAt.
     *
     * @param int|null $processedAt
     *
     * @return void
     */
    public function setProcessedAt(?int $processedAt): void;

    /**
     * Getter for ClosedAt.
     *
     * @return int|null
     */
    public function getClosedAt(): ?int;

    /**
     * Setter for ClosedAt.
     *
     * @param int|null $closedAt
     *
     * @return void
     */
    public function setClosedAt(?int $closedAt): void;

    /**
     * Getter for CancelledAt.
     *
     * @return int|null
     */
    public function getCancelledAt(): ?int;

    /**
     * Setter for CancelledAt.
     *
     * @param int|null $cancelledAt
     *
     * @return void
     */
    public function setCancelledAt(?int $cancelledAt): void;

    /**
     * Getter for CurrencyCodeIso3Letter.
     *
     * @return string|null
     */
    public function getCurrencyCodeIso3Letter(): ?string;

    /**
     * Setter for CurrencyCodeIso3Letter.
     *
     * @param string|null $currencyCodeIso3Letter
     *
     * @return void
     */
    public function setCurrencyCodeIso3Letter(?string $currencyCodeIso3Letter): void;

    /**
     * Getter for FinancialStatus.
     *
     * @return string|null
     */
    public function getFinancialStatus(): ?string;

    /**
     * Setter for FinancialStatus.
     *
     * @param string|null $financialStatus
     *
     * @return void
     */
    public function setFinancialStatus(?string $financialStatus): void;

    /**
     * Getter for ShipmentStatus.
     *
     * @return string|null
     */
    public function getShipmentStatus(): ?string;

    /**
     * Setter for ShipmentStatus.
     *
     * @param string|null $shipmentStatus
     *
     * @return void
     */
    public function setShipmentStatus(?string $shipmentStatus): void;

    /**
     * Getter for PaymentGatewayName.
     *
     * @return string|null
     */
    public function getPaymentGatewayName(): ?string;

    /**
     * Setter for PaymentGatewayName.
     *
     * @param string|null $paymentGatewayName
     *
     * @return void
     */
    public function setPaymentGatewayName(?string $paymentGatewayName): void;

    /**
     * Getter for PaymentMethodName.
     *
     * @return string|null
     */
    public function getPaymentMethodName(): ?string;

    /**
     * Setter for PaymentMethodName.
     *
     * @param string|null $paymentMethodName
     *
     * @return void
     */
    public function setPaymentMethodName(?string $paymentMethodName): void;

    /**
     * Getter for OrderName.
     *
     * @return string|null
     */
    public function getOrderName(): ?string;

    /**
     * Setter for OrderName.
     *
     * @param string|null $orderName
     *
     * @return void
     */
    public function setOrderName(?string $orderName): void;

    /**
     * Getter for OrderNumber.
     *
     * @return string|null
     */
    public function getOrderNumber(): ?string;

    /**
     * Setter for OrderNumber.
     *
     * @param string|null $orderNumber
     *
     * @return void
     */
    public function setOrderNumber(?string $orderNumber): void;

    /**
     * Getter for Tags.
     *
     * @return string|null
     */
    public function getTags(): ?string;

    /**
     * Setter for Tags.
     *
     * @param string|null $tags
     *
     * @return void
     */
    public function setTags(?string $tags): void;

    /**
     * Getter for LineItems.
     *
     * @return array|null
     */
    public function getLineItems(): ?array;

    /**
     * Setter for LineItems.
     *
     * @param array|null $lineItems
     */
    public function setLineItems(?array $lineItems): void;

    /**
     * Getter for RefundedLineItems.
     *
     * @return array|null
     */
    public function getRefundedLineItems(): ?array;

    /**
     * Setter for RefundedLineItems.
     *
     * @param array|null $refundedLineItems
     */
    public function setRefundedLineItems(?array $refundedLineItems): void;

    /**
     * Getter for Shipping.
     *
     * @return array|null
     */
    public function getShipping(): ?array;

    /**
     * Setter for Shipping.
     *
     * @param array $shipping
     *
     * @return void
     */
    public function setShipping(array $shipping): void;

    /**
     * Getter for TransactionCosts.
     *
     * @return float|null
     */
    public function getTransactionCosts(): ?float;

    /**
     * Setter for Transaction Costs.
     *
     * @param float|null $transactionCosts
     *
     * @return void
     */
    public function setTransactionCosts(?float $transactionCosts): void;

    /**
     * Getter for Customer.
     *
     * @return array|null
     */
    public function getCustomer(): ?array;

    /**
     * Setter for Customer.
     *
     * @param array $customer
     *
     * @return void
     */
    public function setCustomer(array $customer): void;

    /**
     * Getter for OptionalIdentifiers.
     *
     * @return array|null
     */
    public function getOptionalIdentifiers(): ?array;

    /**
     * Setter for OptionalIdentifiers.
     *
     * @param array $optionalIdentifiers
     *
     * @return void
     */
    public function setOptionalIdentifiers(array $optionalIdentifiers): void;
}

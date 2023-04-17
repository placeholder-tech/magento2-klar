<?php
declare(strict_types=1);
/**
 * Copyright © ict. All rights reserved.
 * https://ict.lv/
 */

namespace ICT\Klar\Api\Data;

interface RefundedLineItemInterface
{
    /**
     * String constants for property names
     */
    public const ID = 'id';
    public const LINE_ITEM_ID = 'line_item_id';
    public const REASON_DESCRIPTOR = 'reason_descriptor';
    public const REFUNDED_QUANTITY = 'refunded_quantity';
    public const CREATED_AT = 'created_at';
    public const PROCESSED_AT = 'processed_at';

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
     * Getter for LineItemId.
     *
     * @return string|null
     */
    public function getLineItemId(): ?string;

    /**
     * Setter for LineItemId.
     *
     * @param string|null $lineItemId
     *
     * @return void
     */
    public function setLineItemId(?string $lineItemId): void;

    /**
     * Getter for ReasonDescriptor.
     *
     * @return string|null
     */
    public function getReasonDescriptor(): ?string;

    /**
     * Setter for ReasonDescriptor.
     *
     * @param string|null $reasonDescriptor
     *
     * @return void
     */
    public function setReasonDescriptor(?string $reasonDescriptor): void;

    /**
     * Getter for RefundedQuantity.
     *
     * @return float|null
     */
    public function getRefundedQuantity(): ?float;

    /**
     * Setter for RefundedQuantity.
     *
     * @param float|null $refundedQuantity
     *
     * @return void
     */
    public function setRefundedQuantity(?float $refundedQuantity): void;

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
}

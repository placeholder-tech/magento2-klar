<?php
declare(strict_types=1);
/**
 * Copyright © ict. All rights reserved.
 * https://ict.lv/
 */

namespace ICT\Klar\Model\Data;

use ICT\Klar\Api\Data\RefundedLineItemInterface;
use Magento\Framework\DataObject;

class RefundedLineItem extends DataObject implements RefundedLineItemInterface
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
     * Getter for LineItemId.
     *
     * @return string|null
     */
    public function getLineItemId(): ?string
    {
        return $this->getData(self::LINE_ITEM_ID);
    }

    /**
     * Setter for LineItemId.
     *
     * @param string|null $lineItemId
     *
     * @return void
     */
    public function setLineItemId(?string $lineItemId): void
    {
        $this->setData(self::LINE_ITEM_ID, $lineItemId);
    }

    /**
     * Getter for ReasonDescriptor.
     *
     * @return string|null
     */
    public function getReasonDescriptor(): ?string
    {
        return $this->getData(self::REASON_DESCRIPTOR);
    }

    /**
     * Setter for ReasonDescriptor.
     *
     * @param string|null $reasonDescriptor
     *
     * @return void
     */
    public function setReasonDescriptor(?string $reasonDescriptor): void
    {
        $this->setData(self::REASON_DESCRIPTOR, $reasonDescriptor);
    }

    /**
     * Getter for RefundedQuantity.
     *
     * @return float|null
     */
    public function getRefundedQuantity(): ?float
    {
        return $this->getData(self::REFUNDED_QUANTITY) === null ? null
            : (float)$this->getData(self::REFUNDED_QUANTITY);
    }

    /**
     * Setter for RefundedQuantity.
     *
     * @param float|null $refundedQuantity
     *
     * @return void
     */
    public function setRefundedQuantity(?float $refundedQuantity): void
    {
        $this->setData(self::REFUNDED_QUANTITY, $refundedQuantity);
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
}

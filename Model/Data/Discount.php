<?php
declare(strict_types=1);
/**
 * Copyright © ict. All rights reserved.
 * https://ict.lv/
 */

namespace ICT\Klar\Model\Data;

use ICT\Klar\Api\Data\DiscountInterface;
use Magento\Framework\DataObject;

class Discount extends DataObject implements DiscountInterface
{
    /**
     * Getter for Title.
     *
     * @return string|null
     */
    public function getTitle(): ?string
    {
        return $this->getData(self::TITLE);
    }

    /**
     * Setter for Title.
     *
     * @param string|null $title
     *
     * @return void
     */
    public function setTitle(?string $title): void
    {
        $this->setData(self::TITLE, $title);
    }

    /**
     * Getter for Descriptor.
     *
     * @return string|null
     */
    public function getDescriptor(): ?string
    {
        return $this->getData(self::DESCRIPTOR);
    }

    /**
     * Setter for Descriptor.
     *
     * @param string|null $descriptor
     *
     * @return void
     */
    public function setDescriptor(?string $descriptor): void
    {
        $this->setData(self::DESCRIPTOR, $descriptor);
    }

    /**
     * Getter for IsVoucher.
     *
     * @return bool|null
     */
    public function getIsVoucher(): ?bool
    {
        return $this->getData(self::IS_VOUCHER) === null ? null
            : (bool)$this->getData(self::IS_VOUCHER);
    }

    /**
     * Setter for IsVoucher.
     *
     * @param bool|null $isVoucher
     *
     * @return void
     */
    public function setIsVoucher(?bool $isVoucher): void
    {
        $this->setData(self::IS_VOUCHER, $isVoucher);
    }

    /**
     * Getter for VoucherCode.
     *
     * @return string|null
     */
    public function getVoucherCode(): ?string
    {
        return $this->getData(self::VOUCHER_CODE);
    }

    /**
     * Setter for VoucherCode.
     *
     * @param string|null $voucherCode
     *
     * @return void
     */
    public function setVoucherCode(?string $voucherCode): void
    {
        $this->setData(self::VOUCHER_CODE, $voucherCode);
    }

    /**
     * Getter for VoucherType.
     *
     * @return string|null
     */
    public function getVoucherType(): ?string
    {
        return $this->getData(self::VOUCHER_TYPE);
    }

    /**
     * Setter for VoucherType.
     *
     * @param string|null $voucherType
     *
     * @return void
     */
    public function setVoucherType(?string $voucherType): void
    {
        $this->setData(self::VOUCHER_TYPE, $voucherType);
    }

    /**
     * Getter for DiscountAmount.
     *
     * @return float|null
     */
    public function getDiscountAmount(): ?float
    {
        return $this->getData(self::DISCOUNT_AMOUNT) === null ? null
            : (float)$this->getData(self::DISCOUNT_AMOUNT);
    }

    /**
     * Setter for DiscountAmount.
     *
     * @param float|null $discountAmount
     *
     * @return void
     */
    public function setDiscountAmount(?float $discountAmount): void
    {
        $this->setData(self::DISCOUNT_AMOUNT, $discountAmount);
    }
}

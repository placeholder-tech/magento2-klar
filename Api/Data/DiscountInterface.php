<?php
declare(strict_types=1);
/**
 * Copyright © ict. All rights reserved.
 * https://ict.lv/
 */

namespace ICT\Klar\Api\Data;

interface DiscountInterface
{
    /**
     * String constants for property names
     */
    public const TITLE = 'title';
    public const DESCRIPTOR = 'descriptor';
    public const IS_VOUCHER = 'is_voucher';
    public const VOUCHER_CODE = 'voucher_code';
    public const VOUCHER_TYPE = 'voucher_type';
    public const DISCOUNT_AMOUNT = 'discount_amount';

    /*
     * Other constants
     */
    public const DEFAULT_DISCOUNT_TITLE = 'Total Discount';

    /**
     * Getter for Title.
     *
     * @return string|null
     */
    public function getTitle(): ?string;

    /**
     * Setter for Title.
     *
     * @param string|null $title
     *
     * @return void
     */
    public function setTitle(?string $title): void;

    /**
     * Getter for Descriptor.
     *
     * @return string|null
     */
    public function getDescriptor(): ?string;

    /**
     * Setter for Descriptor.
     *
     * @param string|null $descriptor
     *
     * @return void
     */
    public function setDescriptor(?string $descriptor): void;

    /**
     * Getter for IsVoucher.
     *
     * @return bool|null
     */
    public function getIsVoucher(): ?bool;

    /**
     * Setter for IsVoucher.
     *
     * @param bool|null $isVoucher
     *
     * @return void
     */
    public function setIsVoucher(?bool $isVoucher): void;

    /**
     * Getter for VoucherCode.
     *
     * @return string|null
     */
    public function getVoucherCode(): ?string;

    /**
     * Setter for VoucherCode.
     *
     * @param string|null $voucherCode
     *
     * @return void
     */
    public function setVoucherCode(?string $voucherCode): void;

    /**
     * Getter for VoucherType.
     *
     * @return string|null
     */
    public function getVoucherType(): ?string;

    /**
     * Setter for VoucherType.
     *
     * @param string|null $voucherType
     *
     * @return void
     */
    public function setVoucherType(?string $voucherType): void;

    /**
     * Getter for DiscountAmount.
     *
     * @return float|null
     */
    public function getDiscountAmount(): ?float;

    /**
     * Setter for DiscountAmount.
     *
     * @param float|null $discountAmount
     *
     * @return void
     */
    public function setDiscountAmount(?float $discountAmount): void;
}

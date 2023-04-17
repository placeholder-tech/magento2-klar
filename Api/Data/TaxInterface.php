<?php
declare(strict_types=1);
/**
 * Copyright © ict. All rights reserved.
 * https://ict.lv/
 */

namespace ICT\Klar\Api\Data;

interface TaxInterface
{
    /**
     * String constants for property names
     */
    public const TITLE = 'title';
    public const DESCRIPTOR = 'descriptor';
    public const TAX_RATE = 'tax_rate';
    public const TAX_AMOUNT = 'tax_amount';

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
     * Getter for TaxRate.
     *
     * @return float|null
     */
    public function getTaxRate(): ?float;

    /**
     * Setter for TaxRate.
     *
     * @param float|null $taxRate
     *
     * @return void
     */
    public function setTaxRate(?float $taxRate): void;

    /**
     * Getter for TaxAmount.
     *
     * @return float|null
     */
    public function getTaxAmount(): ?float;

    /**
     * Setter for TaxAmount.
     *
     * @param float|null $taxAmount
     *
     * @return void
     */
    public function setTaxAmount(?float $taxAmount): void;
}

<?php
declare(strict_types=1);
/**
 * Copyright © ict. All rights reserved.
 * https://ict.lv/
 */

namespace ICT\Klar\Model\Data;

use ICT\Klar\Api\Data\TaxInterface;
use Magento\Framework\DataObject;

class Tax extends DataObject implements TaxInterface
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
     * Getter for TaxRate.
     *
     * @return float|null
     */
    public function getTaxRate(): ?float
    {
        return $this->getData(self::TAX_RATE) === null ? null
            : (float)$this->getData(self::TAX_RATE);
    }

    /**
     * Setter for TaxRate.
     *
     * @param float|null $taxRate
     *
     * @return void
     */
    public function setTaxRate(?float $taxRate): void
    {
        $this->setData(self::TAX_RATE, $taxRate);
    }

    /**
     * Getter for TaxAmount.
     *
     * @return float|null
     */
    public function getTaxAmount(): ?float
    {
        return $this->getData(self::TAX_AMOUNT) === null ? null
            : (float)$this->getData(self::TAX_AMOUNT);
    }

    /**
     * Setter for TaxAmount.
     *
     * @param float|null $taxAmount
     *
     * @return void
     */
    public function setTaxAmount(?float $taxAmount): void
    {
        $this->setData(self::TAX_AMOUNT, $taxAmount);
    }
}

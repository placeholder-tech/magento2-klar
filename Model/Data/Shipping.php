<?php
declare(strict_types=1);
/**
 * Copyright © ict. All rights reserved.
 * https://ict.lv/
 */

namespace ICT\Klar\Model\Data;

use ICT\Klar\Api\Data\DiscountInterface;
use ICT\Klar\Api\Data\ShippingInterface;
use ICT\Klar\Api\Data\TaxInterface;
use Magento\Framework\DataObject;

class Shipping extends DataObject implements ShippingInterface
{
    /**
     * Getter for City.
     *
     * @return string|null
     */
    public function getCity(): ?string
    {
        return $this->getData(self::CITY);
    }

    /**
     * Setter for City.
     *
     * @param string|null $city
     *
     * @return void
     */
    public function setCity(?string $city): void
    {
        $this->setData(self::CITY, $city);
    }

    /**
     * Getter for ProvinceOrState.
     *
     * @return string|null
     */
    public function getProvinceOrState(): ?string
    {
        return $this->getData(self::PROVINCE_OR_STATE);
    }

    /**
     * Setter for ProvinceOrState.
     *
     * @param string|null $provinceOrState
     *
     * @return void
     */
    public function setProvinceOrState(?string $provinceOrState): void
    {
        $this->setData(self::PROVINCE_OR_STATE, $provinceOrState);
    }

    /**
     * Getter for CountryCodeIso3Letter.
     *
     * @return string|null
     */
    public function getCountryCodeIso3Letter(): ?string
    {
        return $this->getData(self::COUNTRY_CODE_ISO3_LETTER);
    }

    /**
     * Setter for CountryCodeIso3Letter.
     *
     * @param string|null $countryCodeIso3Letter
     *
     * @return void
     */
    public function setCountryCodeIso3Letter(?string $countryCodeIso3Letter): void
    {
        $this->setData(self::COUNTRY_CODE_ISO3_LETTER, $countryCodeIso3Letter);
    }

    /**
     * Getter for CountryCodeIso2Letter.
     *
     * @return string|null
     */
    public function getCountryCodeIso2Letter(): ?string
    {
        return $this->getData(self::COUNTRY_CODE_ISO2_LETTER);
    }

    /**
     * Setter for CountryCodeIso2Letter.
     *
     * @param string|null $countryCodeIso2Letter
     *
     * @return void
     */
    public function setCountryCodeIso2Letter(?string $countryCodeIso2Letter): void
    {
        $this->setData(self::COUNTRY_CODE_ISO2_LETTER, $countryCodeIso2Letter);
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
     * Getter for ZipOrPostalCode.
     *
     * @return string|null
     */
    public function getZipOrPostalCode(): ?string
    {
        return $this->getData(self::ZIP_OR_POSTAL_CODE);
    }

    /**
     * Setter for ZipOrPostalCode.
     *
     * @param string|null $zipOrPostalCode
     *
     * @return void
     */
    public function setZipOrPostalCode(?string $zipOrPostalCode): void
    {
        $this->setData(self::ZIP_OR_POSTAL_CODE, $zipOrPostalCode);
    }

    /**
     * Getter for ProviderDescriptor.
     *
     * @return string|null
     */
    public function getProviderDescriptor(): ?string
    {
        return $this->getData(self::PROVIDER_DESCRIPTOR);
    }

    /**
     * Setter for ProviderDescriptor.
     *
     * @param string|null $providerDescriptor
     *
     * @return void
     */
    public function setProviderDescriptor(?string $providerDescriptor): void
    {
        $this->setData(self::PROVIDER_DESCRIPTOR, $providerDescriptor);
    }

    /**
     * Getter for ShippingTotalAmountBeforeTaxAndDiscounts.
     *
     * @return float|null
     */
    public function getShippingTotalAmountBeforeTaxAndDiscounts(): ?float
    {
        return $this->getData(self::SHIPPING_TOTAL_AMOUNT_BEFORE_TAX_AND_DISCOUNTS) === null ? null
            : (float)$this->getData(self::SHIPPING_TOTAL_AMOUNT_BEFORE_TAX_AND_DISCOUNTS);
    }

    /**
     * Setter for ShippingTotalAmountBeforeTaxAndDiscounts.
     *
     * @param float|null $shippingTotalAmountBeforeTaxAndDiscounts
     *
     * @return void
     */
    public function setShippingTotalAmountBeforeTaxAndDiscounts(?float $shippingTotalAmountBeforeTaxAndDiscounts): void
    {
        $this->setData(self::SHIPPING_TOTAL_AMOUNT_BEFORE_TAX_AND_DISCOUNTS, $shippingTotalAmountBeforeTaxAndDiscounts);
    }

    /**
     * Getter for ShippingTotalAmountAfterTaxAndDiscounts.
     *
     * @return float|null
     */
    public function getShippingTotalAmountAfterTaxAndDiscounts(): ?float
    {
        return $this->getData(self::SHIPPING_TOTAL_AMOUNT_AFTER_TAX_AND_DISCOUNTS) === null ? null
            : (float)$this->getData(self::SHIPPING_TOTAL_AMOUNT_AFTER_TAX_AND_DISCOUNTS);
    }

    /**
     * Setter for ShippingTotalAmountAfterTaxAndDiscounts.
     *
     * @param float|null $shippingTotalAmountAfterTaxAndDiscounts
     *
     * @return void
     */
    public function setShippingTotalAmountAfterTaxAndDiscounts(?float $shippingTotalAmountAfterTaxAndDiscounts): void
    {
        $this->setData(self::SHIPPING_TOTAL_AMOUNT_AFTER_TAX_AND_DISCOUNTS, $shippingTotalAmountAfterTaxAndDiscounts);
    }

    /**
     * Getter for TotalLogisticsCosts.
     *
     * @return float|null
     */
    public function getTotalLogisticsCosts(): ?float
    {
        return $this->getData(self::TOTAL_LOGISTICS_COSTS) === null ? null
            : (float)$this->getData(self::TOTAL_LOGISTICS_COSTS);
    }

    /**
     * Setter for TotalLogisticsCosts.
     *
     * @param float|null $totalLogisticsCosts
     *
     * @return void
     */
    public function setTotalLogisticsCosts(?float $totalLogisticsCosts): void
    {
        $this->setData(self::TOTAL_LOGISTICS_COSTS, $totalLogisticsCosts);
    }

    /**
     * Getter for Discounts.
     *
     * @return array|null
     */
    public function getDiscounts(): ?array
    {
        return $this->getData(self::DISCOUNTS);
    }

    /**
     * Setter for Discounts.
     *
     * @param array $discounts
     *
     * @return void
     */
    public function setDiscounts(array $discounts): void
    {
        $this->setData(self::DISCOUNTS, $discounts);
    }

    /**
     * Getter for Taxes.
     *
     * @return array|null
     */
    public function getTaxes(): ?array
    {
        return $this->getData(self::TAXES);
    }

    /**
     * Setter for Taxes.
     *
     * @param array $taxes
     *
     * @return void
     */
    public function setTaxes(array $taxes): void
    {
        $this->setData(self::TAXES, $taxes);
    }
}

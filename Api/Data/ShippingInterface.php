<?php
declare(strict_types=1);
/**
 * Copyright © ict. All rights reserved.
 * https://ict.lv/
 */

namespace ICT\Klar\Api\Data;

interface ShippingInterface
{
    /**
     * String constants for property names
     */
    public const CITY = 'city';
    public const PROVINCE_OR_STATE = 'province_or_state';
    public const COUNTRY_CODE_ISO3_LETTER = 'country_code_iso3_letter';
    public const COUNTRY_CODE_ISO2_LETTER = 'country_code_iso2_letter';
    public const CURRENCY_CODE_ISO3_LETTER = 'currency_code_iso3_letter';
    public const ZIP_OR_POSTAL_CODE = 'zip_or_postal_code';
    public const PROVIDER_DESCRIPTOR = 'provider_descriptor';
    public const SHIPPING_TOTAL_AMOUNT_BEFORE_TAX_AND_DISCOUNTS = 'shipping_total_amount_before_tax_and_discounts';
    public const SHIPPING_TOTAL_AMOUNT_AFTER_TAX_AND_DISCOUNTS = 'shipping_total_amount_after_tax_and_discounts';
    public const TOTAL_LOGISTICS_COSTS = 'total_logistics_costs';
    public const DISCOUNTS = 'discounts';
    public const TAXES = 'taxes';

    /**
     * Getter for City.
     *
     * @return string|null
     */
    public function getCity(): ?string;

    /**
     * Setter for City.
     *
     * @param string|null $city
     *
     * @return void
     */
    public function setCity(?string $city): void;

    /**
     * Getter for ProvinceOrState.
     *
     * @return string|null
     */
    public function getProvinceOrState(): ?string;

    /**
     * Setter for ProvinceOrState.
     *
     * @param string|null $provinceOrState
     *
     * @return void
     */
    public function setProvinceOrState(?string $provinceOrState): void;

    /**
     * Getter for CountryCodeIso3Letter.
     *
     * @return string|null
     */
    public function getCountryCodeIso3Letter(): ?string;

    /**
     * Setter for CountryCodeIso3Letter.
     *
     * @param string|null $countryCodeIso3Letter
     *
     * @return void
     */
    public function setCountryCodeIso3Letter(?string $countryCodeIso3Letter): void;

    /**
     * Getter for CountryCodeIso2Letter.
     *
     * @return string|null
     */
    public function getCountryCodeIso2Letter(): ?string;

    /**
     * Setter for CountryCodeIso2Letter.
     *
     * @param string|null $countryCodeIso2Letter
     *
     * @return void
     */
    public function setCountryCodeIso2Letter(?string $countryCodeIso2Letter): void;

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
     * Getter for ZipOrPostalCode.
     *
     * @return string|null
     */
    public function getZipOrPostalCode(): ?string;

    /**
     * Setter for ZipOrPostalCode.
     *
     * @param string|null $zipOrPostalCode
     *
     * @return void
     */
    public function setZipOrPostalCode(?string $zipOrPostalCode): void;

    /**
     * Getter for ProviderDescriptor.
     *
     * @return string|null
     */
    public function getProviderDescriptor(): ?string;

    /**
     * Setter for ProviderDescriptor.
     *
     * @param string|null $providerDescriptor
     *
     * @return void
     */
    public function setProviderDescriptor(?string $providerDescriptor): void;

    /**
     * Getter for ShippingTotalAmountBeforeTaxAndDiscounts.
     *
     * @return float|null
     */
    public function getShippingTotalAmountBeforeTaxAndDiscounts(): ?float;

    /**
     * Setter for ShippingTotalAmountBeforeTaxAndDiscounts.
     *
     * @param float|null $shippingTotalAmountBeforeTaxAndDiscounts
     *
     * @return void
     */
    public function setShippingTotalAmountBeforeTaxAndDiscounts(?float $shippingTotalAmountBeforeTaxAndDiscounts): void;

    /**
     * Getter for ShippingTotalAmountAfterTaxAndDiscounts.
     *
     * @return float|null
     */
    public function getShippingTotalAmountAfterTaxAndDiscounts(): ?float;

    /**
     * Setter for ShippingTotalAmountAfterTaxAndDiscounts.
     *
     * @param float|null $shippingTotalAmountAfterTaxAndDiscounts
     *
     * @return void
     */
    public function setShippingTotalAmountAfterTaxAndDiscounts(?float $shippingTotalAmountAfterTaxAndDiscounts): void;

    /**
     * Getter for TotalLogisticsCosts.
     *
     * @return float|null
     */
    public function getTotalLogisticsCosts(): ?float;

    /**
     * Setter for TotalLogisticsCosts.
     *
     * @param float|null $totalLogisticsCosts
     *
     * @return void
     */
    public function setTotalLogisticsCosts(?float $totalLogisticsCosts): void;

    /**
     * Getter for Discounts.
     *
     * @return array|null
     */
    public function getDiscounts(): ?array;

    /**
     * Setter for Discounts.
     *
     * @param array $discounts
     *
     * @return void
     */
    public function setDiscounts(array $discounts): void;

    /**
     * Getter for Taxes.
     *
     * @return array|null
     */
    public function getTaxes(): ?array;

    /**
     * Setter for Taxes.
     *
     * @param array $taxes
     *
     * @return void
     */
    public function setTaxes(array $taxes): void;
}

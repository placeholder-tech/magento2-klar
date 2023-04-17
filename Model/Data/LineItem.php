<?php
declare(strict_types=1);
/**
 * Copyright © ict. All rights reserved.
 * https://ict.lv/
 */

namespace ICT\Klar\Model\Data;

use ICT\Klar\Api\Data\DiscountInterface;
use ICT\Klar\Api\Data\LineItemInterface;
use ICT\Klar\Api\Data\TaxInterface;
use Magento\Framework\DataObject;

class LineItem extends DataObject implements LineItemInterface
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
     * Getter for ProductName.
     *
     * @return string|null
     */
    public function getProductName(): ?string
    {
        return $this->getData(self::PRODUCT_NAME);
    }

    /**
     * Setter for ProductName.
     *
     * @param string|null $productName
     *
     * @return void
     */
    public function setProductName(?string $productName): void
    {
        $this->setData(self::PRODUCT_NAME, $productName);
    }

    /**
     * Getter for ProductId.
     *
     * @return string|null
     */
    public function getProductId(): ?string
    {
        return $this->getData(self::PRODUCT_ID);
    }

    /**
     * Setter for ProductId.
     *
     * @param string|null $productId
     *
     * @return void
     */
    public function setProductId(?string $productId): void
    {
        $this->setData(self::PRODUCT_ID, $productId);
    }

    /**
     * Getter for ProductVariantName.
     *
     * @return string|null
     */
    public function getProductVariantName(): ?string
    {
        return $this->getData(self::PRODUCT_VARIANT_NAME);
    }

    /**
     * Setter for ProductVariantName.
     *
     * @param string|null $productVariantName
     *
     * @return void
     */
    public function setProductVariantName(?string $productVariantName): void
    {
        $this->setData(self::PRODUCT_VARIANT_NAME, $productVariantName);
    }

    /**
     * Getter for ProductVariantId.
     *
     * @return string|null
     */
    public function getProductVariantId(): ?string
    {
        return $this->getData(self::PRODUCT_VARIANT_ID);
    }

    /**
     * Setter for ProductVariantId.
     *
     * @param string|null $productVariantId
     *
     * @return void
     */
    public function setProductVariantId(?string $productVariantId): void
    {
        $this->setData(self::PRODUCT_VARIANT_ID, $productVariantId);
    }

    /**
     * Getter for ProductBrand.
     *
     * @return string|null
     */
    public function getProductBrand(): ?string
    {
        return $this->getData(self::PRODUCT_BRAND);
    }

    /**
     * Setter for ProductBrand.
     *
     * @param string|null $productBrand
     *
     * @return void
     */
    public function setProductBrand(?string $productBrand): void
    {
        $this->setData(self::PRODUCT_BRAND, $productBrand);
    }

    /**
     * Getter for ProductCollection.
     *
     * @return string|null
     */
    public function getProductCollection(): ?string
    {
        return $this->getData(self::PRODUCT_COLLECTION);
    }

    /**
     * Setter for ProductCollection.
     *
     * @param string|null $productCollection
     *
     * @return void
     */
    public function setProductCollection(?string $productCollection): void
    {
        $this->setData(self::PRODUCT_COLLECTION, $productCollection);
    }

    /**
     * Getter for ProductCogs.
     *
     * @return float|null
     */
    public function getProductCogs(): ?float
    {
        return $this->getData(self::PRODUCT_COGS) === null ? null
            : (float)$this->getData(self::PRODUCT_COGS);
    }

    /**
     * Setter for ProductCogs.
     *
     * @param float|null $productCogs
     *
     * @return void
     */
    public function setProductCogs(?float $productCogs): void
    {
        $this->setData(self::PRODUCT_COGS, $productCogs);
    }

    /**
     * Getter for ProductGmv.
     *
     * @return float|null
     */
    public function getProductGmv(): ?float
    {
        return $this->getData(self::PRODUCT_GMV) === null ? null
            : (float)$this->getData(self::PRODUCT_GMV);
    }

    /**
     * Setter for ProductGmv.
     *
     * @param float|null $productGmv
     *
     * @return void
     */
    public function setProductGmv(?float $productGmv): void
    {
        $this->setData(self::PRODUCT_GMV, $productGmv);
    }

    /**
     * Getter for ProductShippingWeightInGrams.
     *
     * @return float|null
     */
    public function getProductShippingWeightInGrams(): ?float
    {
        return $this->getData(self::PRODUCT_SHIPPING_WEIGHT_IN_GRAMS) === null ? null
            : (float)$this->getData(self::PRODUCT_SHIPPING_WEIGHT_IN_GRAMS);
    }

    /**
     * Setter for ProductShippingWeightInGrams.
     *
     * @param float|null $productShippingWeightInGrams
     *
     * @return void
     */
    public function setProductShippingWeightInGrams(?float $productShippingWeightInGrams): void
    {
        $this->setData(self::PRODUCT_SHIPPING_WEIGHT_IN_GRAMS, $productShippingWeightInGrams);
    }

    /**
     * Getter for Sku.
     *
     * @return string|null
     */
    public function getSku(): ?string
    {
        return $this->getData(self::SKU);
    }

    /**
     * Setter for Sku.
     *
     * @param string|null $sku
     *
     * @return void
     */
    public function setSku(?string $sku): void
    {
        $this->setData(self::SKU, $sku);
    }

    /**
     * Getter for Quantity.
     *
     * @return float|null
     */
    public function getQuantity(): ?float
    {
        return $this->getData(self::QUANTITY) === null ? null
            : (float)$this->getData(self::QUANTITY);
    }

    /**
     * Setter for Quantity.
     *
     * @param float|null $quantity
     *
     * @return void
     */
    public function setQuantity(?float $quantity): void
    {
        $this->setData(self::QUANTITY, $quantity);
    }

    /**
     * Getter for ProductTags.
     *
     * @return string|null
     */
    public function getProductTags(): ?string
    {
        return $this->getData(self::PRODUCT_TAGS);
    }

    /**
     * Setter for ProductTags.
     *
     * @param string|null $productTags
     *
     * @return void
     */
    public function setProductTags(?string $productTags): void
    {
        $this->setData(self::PRODUCT_TAGS, $productTags);
    }

    /**
     * Getter for TotalAmountBeforeTaxesAndDiscounts.
     *
     * @return float|null
     */
    public function getTotalAmountBeforeTaxesAndDiscounts(): ?float
    {
        return $this->getData(self::TOTAL_AMOUNT_BEFORE_TAXES_AND_DISCOUNTS) === null ? null
            : (float)$this->getData(self::TOTAL_AMOUNT_BEFORE_TAXES_AND_DISCOUNTS);
    }

    /**
     * Setter for TotalAmountBeforeTaxesAndDiscounts.
     *
     * @param float|null $totalAmountBeforeTaxesAndDiscounts
     *
     * @return void
     */
    public function setTotalAmountBeforeTaxesAndDiscounts(?float $totalAmountBeforeTaxesAndDiscounts): void
    {
        $this->setData(self::TOTAL_AMOUNT_BEFORE_TAXES_AND_DISCOUNTS, $totalAmountBeforeTaxesAndDiscounts);
    }

    /**
     * Getter for TotalAmountAfterTaxesAndDiscounts.
     *
     * @return float|null
     */
    public function getTotalAmountAfterTaxesAndDiscounts(): ?float
    {
        return $this->getData(self::TOTAL_AMOUNT_AFTER_TAXES_AND_DISCOUNTS) === null ? null
            : (float)$this->getData(self::TOTAL_AMOUNT_AFTER_TAXES_AND_DISCOUNTS);
    }

    /**
     * Setter for TotalAmountAfterTaxesAndDiscounts.
     *
     * @param float|null $totalAmountAfterTaxesAndDiscounts
     *
     * @return void
     */
    public function setTotalAmountAfterTaxesAndDiscounts(?float $totalAmountAfterTaxesAndDiscounts): void
    {
        $this->setData(self::TOTAL_AMOUNT_AFTER_TAXES_AND_DISCOUNTS, $totalAmountAfterTaxesAndDiscounts);
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

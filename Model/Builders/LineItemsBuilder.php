<?php
declare(strict_types=1);
/**
 * Copyright © ict. All rights reserved.
 * https://ict.lv/
 */

namespace ICT\Klar\Model\Builders;

use ICT\Klar\Api\Data\LineItemInterface;
use ICT\Klar\Api\Data\LineItemInterfaceFactory;
use ICT\Klar\Helper\Config;
use ICT\Klar\Model\AbstractApiRequestParamsBuilder;
use Magento\Catalog\Api\CategoryRepositoryInterface;
use Magento\Catalog\Model\Product;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\Intl\DateTimeFactory;
use Magento\Sales\Api\Data\OrderInterface as SalesOrderInterface;
use Magento\Sales\Api\Data\OrderItemInterface as SalesOrderItemInterface;

class LineItemsBuilder extends AbstractApiRequestParamsBuilder
{
    private LineItemInterfaceFactory $lineItemFactory;
    private CategoryRepositoryInterface $categoryRepository;
    private TaxesBuilder $taxesBuilder;
    private Config $config;
    private LineItemDiscountsBuilder $discountsBuilder;

    /**
     * LineItemsBuilder constructor.
     *
     * @param DateTimeFactory $dateTimeFactory
     * @param LineItemInterfaceFactory $lineItemFactory
     * @param CategoryRepositoryInterface $categoryRepository
     * @param TaxesBuilder $taxesBuilder
     * @param Config $config
     * @param LineItemDiscountsBuilder $discountsBuilder
     */
    public function __construct(
        DateTimeFactory $dateTimeFactory,
        LineItemInterfaceFactory $lineItemFactory,
        CategoryRepositoryInterface $categoryRepository,
        TaxesBuilder $taxesBuilder,
        Config $config,
        LineItemDiscountsBuilder $discountsBuilder
    ) {
        parent::__construct($dateTimeFactory);
        $this->lineItemFactory = $lineItemFactory;
        $this->categoryRepository = $categoryRepository;
        $this->taxesBuilder = $taxesBuilder;
        $this->config = $config;
        $this->discountsBuilder = $discountsBuilder;
    }

    /**
     * Build line items array from sales order.
     *
     * @param SalesOrderInterface $salesOrder
     *
     * @return array
     */
    public function buildFromSalesOrder(SalesOrderInterface $salesOrder): array
    {
        $lineItems = [];

        foreach ($salesOrder->getItems() as $salesOrderItem) {
            $product = $salesOrderItem->getProduct();
            $productVariant = $this->getProductVariant($salesOrderItem);
            $productBrand = false;
            $categoryName = $this->getCategoryName($salesOrderItem);
            $totalBeforeTaxesAndDiscounts = $salesOrderItem->getOriginalPrice() * $salesOrderItem->getQtyOrdered();
            $weightInGrams = 0;

            if ($product) {
                $productBrand = $product->getAttributeText('manufacturer');
                $weightInGrams = $this->getWeightInGrams($product);
            }

            /* @var LineItemInterface $lineItem */
            $lineItem = $this->lineItemFactory->create();

            $lineItem->setId((string)$salesOrderItem->getItemId());
            $lineItem->setProductName($salesOrderItem->getName());
            $lineItem->setProductId((string)$salesOrderItem->getProductId());

            if ($productVariant) {
                $lineItem->setProductVariantName($productVariant['name']);
                $lineItem->setProductVariantId((string)$productVariant['id']);
            }

            if ($productBrand) {
                $lineItem->setProductBrand($productBrand);
            }

            if ($categoryName) {
                $lineItem->setProductCollection($categoryName);
            }

            $lineItem->setProductCogs((float)$salesOrderItem->getBaseCost());
            $lineItem->setProductGmv((float)$salesOrderItem->getOriginalPrice());
            $lineItem->setProductShippingWeightInGrams($weightInGrams);
            $lineItem->setSku($salesOrderItem->getSku());
            $lineItem->setQuantity((float)$salesOrderItem->getQtyOrdered());
            $lineItem->setDiscounts($this->discountsBuilder->buildFromSalesOrderItem($salesOrderItem));
            $lineItem->setTaxes(
                $this->taxesBuilder->build((int)$salesOrderItem->getOrderId(), $salesOrderItem)
            );
            $lineItem->setTotalAmountBeforeTaxesAndDiscounts($totalBeforeTaxesAndDiscounts);

            $totalAfterTaxesAndDiscounts = $this->calculateTotalAfterTaxesAndDiscounts($lineItem);
            $lineItem->setTotalAmountAfterTaxesAndDiscounts($totalAfterTaxesAndDiscounts ?: 0.0);

            $lineItems[] = $this->snakeToCamel($lineItem->toArray());
        }

        return $lineItems;
    }

    /**
     * Get product variant name and ID.
     *
     * @param SalesOrderItemInterface $salesOrderItem
     *
     * @return array|false
     */
    private function getProductVariant(SalesOrderItemInterface $salesOrderItem)
    {
        $productOptions = $salesOrderItem->getProductOptions();

        if (isset($productOptions['simple_name'], $productOptions['simple_sku'])) {
            return [
                'name' => $productOptions['simple_name'],
                'id' => $productOptions['simple_sku'],
            ];
        }

        return false;
    }

    /**
     * Get the highest level category name.
     *
     * @param SalesOrderItemInterface $salesOrderItem
     *
     * @return string|null
     */
    private function getCategoryName(SalesOrderItemInterface $salesOrderItem): ?string
    {
        $product = $salesOrderItem->getProduct();

        if (!$product) {
            return null;
        }

        $categoryIds = $product->getCategoryIds();
        $categoryNames = [];

        foreach ($categoryIds as $categoryId) {
            try {
                $category = $this->categoryRepository->get($categoryId);
            } catch (NoSuchEntityException $e) {
                continue;
            }

            $categoryLevel = $category->getLevel();
            $categoryName = $category->getName();
            $categoryNames[$categoryLevel] = $categoryName;
        }

        if (!empty($categoryNames)) {
            krsort($categoryNames);

            return reset($categoryNames);
        }

        return null;
    }

    /**
     * Get product weight in grams.
     *
     * @param Product $product
     *
     * @return float
     */
    private function getWeightInGrams(Product $product): float
    {
        $productWeightInKgs = 0.00;
        $weightUnit = $this->config->getWeightUnit();
        $productWeight = (float)$product->getWeight();

        if ($productWeight) {
            // Convert LBS to KGS if unit is LBS
            if ($weightUnit === Config::WEIGHT_UNIT_LBS) {
                $productWeightInKgs = $this->convertLbsToKgs($productWeight);
            }

            return $productWeightInKgs * 1000;
        }

        return $productWeightInKgs;
    }

    /**
     * Convert lbs to kgs.
     *
     * @param float $weightLbs
     *
     * @return float
     */
    private function convertLbsToKgs(float $weightLbs): float
    {
        $conversionFactor = 0.45359237;
        $weightInKgs = $weightLbs * $conversionFactor;

        return round($weightInKgs, 3);
    }

    /**
     * Calculate line item total after taxes and discounts.
     *
     * @param LineItemInterface $lineItem
     *
     * @return float
     */
    private function calculateTotalAfterTaxesAndDiscounts(LineItemInterface $lineItem): float
    {
        $taxAmount = 0;
        $discountAmount = 0;
        $quantity = $lineItem->getQuantity();
        $productGmv = $lineItem->getProductGmv() * $quantity;

        foreach ($lineItem->getTaxes() as $lineItemTax) {
            $taxAmount += $lineItemTax['taxAmount'] * $quantity;
        }

        foreach ($lineItem->getDiscounts() as $lineItemDiscount) {
            $discountAmount += $lineItemDiscount['discountAmount'] * $quantity;
        }

        return $productGmv - $taxAmount - $discountAmount;
    }
}

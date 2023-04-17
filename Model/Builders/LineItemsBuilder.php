<?php
declare(strict_types=1);
/**
 * Copyright © ict. All rights reserved.
 * https://ict.lv/
 */

namespace ICT\Klar\Model\Builders;

use ICT\Klar\Api\Data\DiscountInterface;
use ICT\Klar\Api\Data\DiscountInterfaceFactory;
use ICT\Klar\Api\Data\LineItemInterface;
use ICT\Klar\Api\Data\LineItemInterfaceFactory;
use ICT\Klar\Model\AbstractApiRequestParamsBuilder;
use Magento\Catalog\Api\CategoryRepositoryInterface;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\Intl\DateTimeFactory;
use Magento\Sales\Api\Data\OrderInterface as SalesOrderInterface;
use Magento\Sales\Api\Data\OrderItemInterface as SalesOrderItemInterface;

class LineItemsBuilder extends AbstractApiRequestParamsBuilder
{
    private LineItemInterfaceFactory $lineItemFactory;

    private CategoryRepositoryInterface $categoryRepository;

    private DiscountInterfaceFactory $discountFactory;

    private TaxesBuilder $taxesBuilder;

    /**
     * LineItemsBuilder constructor.
     *
     * @param DateTimeFactory $dateTimeFactory
     * @param LineItemInterfaceFactory $lineItemFactory
     * @param CategoryRepositoryInterface $categoryRepository
     * @param DiscountInterfaceFactory $discountFactory
     * @param TaxesBuilder $taxesBuilder
     */
    public function __construct(
        DateTimeFactory $dateTimeFactory,
        LineItemInterfaceFactory $lineItemFactory,
        CategoryRepositoryInterface $categoryRepository,
        DiscountInterfaceFactory $discountFactory,
        TaxesBuilder $taxesBuilder
    ) {
        parent::__construct($dateTimeFactory);
        $this->lineItemFactory = $lineItemFactory;
        $this->categoryRepository = $categoryRepository;
        $this->discountFactory = $discountFactory;
        $this->taxesBuilder = $taxesBuilder;
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
            $rowTotal = (float)$salesOrderItem->getRowTotalInclTax();

            if ($product) {
                $productBrand = $product->getAttributeText('manufacturer');
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

            $lineItem->setSku($salesOrderItem->getSku());
            $lineItem->setQuantity((float)$salesOrderItem->getQtyOrdered());
            $lineItem->setDiscounts($this->getDiscounts($salesOrderItem));
            $lineItem->setTaxes(
                $this->taxesBuilder->build((int)$salesOrderItem->getOrderId(), (int)$salesOrderItem->getId())
            );
            $lineItem->setTotalAmountBeforeTaxesAndDiscounts($salesOrderItem->getPrice());
            $lineItem->setTotalAmountAfterTaxesAndDiscounts($rowTotal ?: 0.0);

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
     * Get product discounts.
     *
     * @param SalesOrderItemInterface $salesOrderItem
     *
     * @return array
     */
    private function getDiscounts(SalesOrderItemInterface $salesOrderItem): array
    {
        $discountAmount = (float)$salesOrderItem->getDiscountAmount();

        if ($discountAmount) {
            /* @var DiscountInterface $discount */
            $discount = $this->discountFactory->create();

            $discount->setTitle(DiscountInterface::DEFAULT_DISCOUNT_TITLE);
            $discount->setDiscountAmount($discountAmount);

            return [$this->snakeToCamel($discount->toArray())];
        }

        return [];
    }
}

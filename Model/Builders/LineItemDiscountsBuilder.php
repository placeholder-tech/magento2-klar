<?php
declare(strict_types=1);
/**
 * Copyright © ict. All rights reserved.
 * https://ict.lv/
 */

namespace ICT\Klar\Model\Builders;

use ICT\Klar\Api\Data\DiscountInterface;
use ICT\Klar\Api\Data\DiscountInterfaceFactory;
use ICT\Klar\Model\AbstractApiRequestParamsBuilder;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\Intl\DateTimeFactory;
use Magento\Sales\Api\Data\OrderItemInterface as SalesOrderItemInterface;
use Magento\SalesRule\Api\Data\RuleInterface;
use Magento\SalesRule\Api\RuleRepositoryInterface;
use Magento\SalesRule\Model\RuleFactory;

class LineItemDiscountsBuilder extends AbstractApiRequestParamsBuilder
{
    private DiscountInterfaceFactory $discountFactory;
    private RuleRepositoryInterface $salesRuleRepository;
    private RuleFactory $ruleFactory;

    /**
     * LineItemDiscountsBuilder constructor.
     *
     * @param DateTimeFactory $dateTimeFactory
     * @param DiscountInterfaceFactory $discountFactory
     * @param RuleRepositoryInterface $salesRuleRepository
     * @param RuleFactory $ruleFactory
     */
    public function __construct(
        DateTimeFactory $dateTimeFactory,
        DiscountInterfaceFactory $discountFactory,
        RuleRepositoryInterface $salesRuleRepository,
        RuleFactory $ruleFactory
    ) {
        parent::__construct($dateTimeFactory);
        $this->discountFactory = $discountFactory;
        $this->salesRuleRepository = $salesRuleRepository;
        $this->ruleFactory = $ruleFactory;
    }

    /**
     * Build line item discounts array from sales order item.
     *
     * @param SalesOrderItemInterface $salesOrderItem
     *
     * @return array
     */
    public function buildFromSalesOrderItem(SalesOrderItemInterface $salesOrderItem): array
    {
        $discounts = [];
        $discountAmount = (float)$salesOrderItem->getDiscountAmount();

        if ($discountAmount && $salesOrderItem->getAppliedRuleIds()) {
            $ruleIds = explode(',', $salesOrderItem->getAppliedRuleIds());

            foreach ($ruleIds as $ruleId) {
                $discount = $this->buildRuleDiscount(
                    (int)$ruleId,
                    (float)$salesOrderItem->getPriceInclTax()
                );

                if (!empty($discount)) {
                    $discounts[] = $discount;
                }
            }
        }

        $price = (float)$salesOrderItem->getPriceInclTax();
        $originalPrice = (float)$salesOrderItem->getOriginalPrice();

        if ($price < $originalPrice) {
            $discounts[] = $this->buildSpecialPriceDiscount($price, $originalPrice);
        }

        return $discounts;
    }

    /**
     * Build discount array from sales rule.
     *
     * @param int $ruleId
     * @param float $baseItemPrice
     *
     * @return array
     */
    private function buildRuleDiscount(int $ruleId, float $baseItemPrice): array
    {
        try {
            $salesRule = $this->salesRuleRepository->getById($ruleId);
        } catch (NoSuchEntityException|LocalizedException $e) {
            // Rule doesn't exist, manual calculation is not possible.
            return [];
        }

        if (!(float)$salesRule->getDiscountAmount()) {
            return [];
        }

        /* @var DiscountInterface $discount */
        $discount = $this->discountFactory->create();

        $discount->setTitle($salesRule->getName());
        $discount->setDescriptor($salesRule->getDescription());

        if ($salesRule->getCouponType() === RuleInterface::COUPON_TYPE_SPECIFIC_COUPON) {
            $couponCode = $this->ruleFactory->create()->load($ruleId)->getCouponCode();

            $discount->setIsVoucher(true);
            $discount->setVoucherCode($couponCode);
        }

        if ($salesRule->getSimpleAction() === RuleInterface::DISCOUNT_ACTION_BY_PERCENT) {
            $discountPercent = $salesRule->getDiscountAmount() / 100;
            $discount->setDiscountAmount($baseItemPrice * $discountPercent);
        }

        if ($salesRule->getSimpleAction() === RuleInterface::DISCOUNT_ACTION_FIXED_AMOUNT) {
            $discount->setDiscountAmount((float)$salesRule->getDiscountAmount());
        }

        return $this->snakeToCamel($discount->toArray());
    }

    /**
     * Build discount array for special price.
     *
     * @param float $price
     * @param float $originalPrice
     *
     * @return array
     */
    private function buildSpecialPriceDiscount(float $price, float $originalPrice): array
    {
        /* @var DiscountInterface $discount */
        $discount = $this->discountFactory->create();

        $discount->setTitle(DiscountInterface::SPECIAL_PRICE_DISCOUNT_TITLE);
        $discount->setDescriptor(DiscountInterface::SPECIAL_PRICE_DISCOUNT_DESCRIPTOR);
        $discount->setDiscountAmount($originalPrice - $price);

        return $this->snakeToCamel($discount->toArray());
    }
}

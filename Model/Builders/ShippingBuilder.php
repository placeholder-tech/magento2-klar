<?php
declare(strict_types=1);
/**
 * Copyright © ict. All rights reserved.
 * https://ict.lv/
 */

namespace ICT\Klar\Model\Builders;

use ICT\Klar\Api\Data\DiscountInterface;
use ICT\Klar\Api\Data\DiscountInterfaceFactory;
use ICT\Klar\Api\Data\ShippingInterface;
use ICT\Klar\Api\Data\ShippingInterfaceFactory;
use ICT\Klar\Model\AbstractApiRequestParamsBuilder;
use Magento\Directory\Model\CountryFactory;
use Magento\Framework\Intl\DateTimeFactory;
use Magento\Sales\Api\Data\OrderInterface as SalesOrderInterface;

class ShippingBuilder extends AbstractApiRequestParamsBuilder
{
    private ShippingInterfaceFactory $shippingFactory;
    private DiscountInterfaceFactory $discountFactory;
    private TaxesBuilder $taxesBuilder;
    private CountryFactory $countryFactory;

    /**
     * ShippingBuilder constructor.
     *
     * @param DateTimeFactory $dateTimeFactory
     * @param ShippingInterfaceFactory $shippingFactory
     * @param DiscountInterfaceFactory $discountFactory
     * @param TaxesBuilder $taxesBuilder
     * @param CountryFactory $countryFactory
     */
    public function __construct(
        DateTimeFactory $dateTimeFactory,
        ShippingInterfaceFactory $shippingFactory,
        DiscountInterfaceFactory $discountFactory,
        TaxesBuilder $taxesBuilder,
        CountryFactory $countryFactory
    ) {
        parent::__construct($dateTimeFactory);
        $this->shippingFactory = $shippingFactory;
        $this->discountFactory = $discountFactory;
        $this->taxesBuilder = $taxesBuilder;
        $this->countryFactory = $countryFactory;
    }

    /**
     * Build shipping from sales order.
     *
     * @param SalesOrderInterface $salesOrder
     *
     * @return array
     */
    public function buildFromSalesOrder(SalesOrderInterface $salesOrder): array
    {
        $shippingAddress = $salesOrder->getShippingAddress();
        /* @var ShippingInterface $shipping */
        $shipping = $this->shippingFactory->create();

        if ($shippingAddress) {
          $shipping->setCity($shippingAddress->getCity());
          $shipping->setProvinceOrState($shippingAddress->getRegion());
          $shipping->setCountryCodeIso3Letter($this->getCountryCodeIso3Letter($shippingAddress->getCountryId()));
          $shipping->setCountryCodeIso2Letter($shippingAddress->getCountryId());
          $shipping->setZipOrPostalCode($shippingAddress->getPostcode());
        }

        $shippingAmount = $salesOrder->getShippingInclTax();
        $shippingTaxAmount = $salesOrder->getShippingTaxAmount();
        $shippingDiscountAmount = $salesOrder->getShippingDiscountAmount();
        $shippingAmountAfterTaxAndDiscount = $shippingAmount - $shippingTaxAmount - $shippingDiscountAmount;
        $shipping->setCurrencyCodeIso3Letter($salesOrder->getOrderCurrencyCode());
        $shipping->setProviderDescriptor($salesOrder->getShippingDescription());
        $shipping->setShippingTotalAmountBeforeTaxAndDiscounts((float)$shippingAmount);
        $shipping->setDiscounts($this->getDiscounts($salesOrder));
        $shipping->setTaxes($this->getTaxes((int)$salesOrder->getEntityId()));
        $shipping->setShippingTotalAmountAfterTaxAndDiscounts($shippingAmountAfterTaxAndDiscount);

        return $this->snakeToCamel($shipping->toArray());
    }

    /**
     * Get country ISO 3 code.
     *
     * @param string $countryId
     *
     * @return string
     */
    private function getCountryCodeIso3Letter(string $countryId): string
    {
        return $this->countryFactory->create()->loadByCode($countryId)->getData('iso3_code');
    }

    /**
     * Get shipping discounts from sales order.
     *
     * @param SalesOrderInterface $salesOrder
     *
     * @return array
     */
    private function getDiscounts(SalesOrderInterface $salesOrder): array
    {
        $discountAmount = (float)$salesOrder->getShippingDiscountAmount();

        if ($discountAmount) {
            /* @var DiscountInterface $discount */
            $discount = $this->discountFactory->create();

            $discount->setTitle(DiscountInterface::DEFAULT_DISCOUNT_TITLE);
            $discount->setDiscountAmount($discountAmount);

            return [$this->snakeToCamel($discount->toArray())];
        }

        return [];
    }

    /**
     * Get shipping taxes.
     *
     * @param int $orderId
     *
     * @return array
     */
    private function getTaxes(int $orderId): array
    {
        return $this->taxesBuilder->build(
            $orderId,
            null,
            TaxesBuilder::TAXABLE_ITEM_TYPE_SHIPPING
        );
    }
}

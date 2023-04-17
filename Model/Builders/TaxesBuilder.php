<?php
declare(strict_types=1);
/**
 * Copyright © ict. All rights reserved.
 * https://ict.lv/
 */

namespace ICT\Klar\Model\Builders;

use ICT\Klar\Api\Data\TaxInterface;
use ICT\Klar\Api\Data\TaxInterfaceFactory;
use ICT\Klar\Model\AbstractApiRequestParamsBuilder;
use Magento\Framework\Intl\DateTimeFactory;
use Magento\Sales\Model\ResourceModel\Order\Tax\Item as TaxItemResource;

class TaxesBuilder extends AbstractApiRequestParamsBuilder
{
    public const TAXABLE_ITEM_TYPE_PRODUCT = 'product';
    public const TAXABLE_ITEM_TYPE_SHIPPING = 'shipping';

    private TaxItemResource $taxItemResource;

    private TaxInterfaceFactory $taxFactory;

    /**
     * TaxesBuilder constructor.
     *
     * @param DateTimeFactory $dateTimeFactory
     * @param TaxItemResource $taxItemResource
     * @param TaxInterfaceFactory $taxFactory
     */
    public function __construct(
        DateTimeFactory $dateTimeFactory,
        TaxItemResource $taxItemResource,
        TaxInterfaceFactory $taxFactory
    ) {
        parent::__construct($dateTimeFactory);
        $this->taxItemResource = $taxItemResource;
        $this->taxFactory = $taxFactory;
    }

    /**
     * Get taxes from sales order by type.
     *
     * @param int $orderId
     * @param int|null $orderItemId
     * @param string $taxableItemType
     *
     * @return array
     */
    public function build(
        int $orderId,
        int $orderItemId = null,
        string $taxableItemType = self::TAXABLE_ITEM_TYPE_PRODUCT
    ): array {
        $taxes = [];
        $taxItems = $this->taxItemResource->getTaxItemsByOrderId($orderId);

        foreach ($taxItems as $taxItem) {
            if ($taxItem['taxable_item_type'] === self::TAXABLE_ITEM_TYPE_PRODUCT &&
                (int)$taxItem['item_id'] !== $orderItemId) {
                continue;
            }

            if ($taxItem['taxable_item_type'] === $taxableItemType) {
                /* @var TaxInterface $tax */
                $tax = $this->taxFactory->create();

                $tax->setTitle($taxItem['title']);
                $tax->setTaxRate((float)$taxItem['tax_percent']);
                $tax->setTaxAmount((float)$taxItem['real_amount']);

                $taxes[$taxableItemType][] = $this->snakeToCamel($tax->toArray());
            }
        }

        if (!empty($taxes)) {
            return $taxes[$taxableItemType];
        }

        return $taxes;
    }
}

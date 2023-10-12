<?php
declare(strict_types=1);
/**
 * Copyright © ict. All rights reserved.
 * https://ict.lv/
 */

namespace ICT\Klar\Model\Builders;

use Magento\Sales\Api\Data\OrderInterface as SalesOrderInterface;
use ICT\Klar\Model\AbstractApiRequestParamsBuilder;
use ICT\Klar\Api\Data\OptionalIdentifiersInterfaceFactory;
use Magento\Framework\Intl\DateTimeFactory;

class OptionalIdentifiersBuilder extends AbstractApiRequestParamsBuilder
{
    private OptionalIdentifiersInterfaceFactory $optionalIdentifiersFactory;

    /**
     * CustomerBuilder builder.
     *
     * @param DateTimeFactory $dateTimeFactory
     * @param OptionalIdentifiersInterfaceFactory $optionalIdentifiersFactorybin
     */
    public function __construct(
        DateTimeFactory $dateTimeFactory,
        OptionalIdentifiersInterfaceFactory $optionalIdentifiersFactory,
    ) {
        parent::__construct($dateTimeFactory);
        $this->optionalIdentifiersFactory = $optionalIdentifiersFactory;
    }

    /**
     * Build customer from sales order.
     *
     * @param SalesOrderInterface $salesOrder
     *
     * @return array
     */
    public function buildFromSalesOrder(SalesOrderInterface $salesOrder): array
    {
        $optionalIdentifiers = $this->optionalIdentifiersFactory->create();
        $optionalIdentifiers->setGoogleAnalyticsTransactionId($salesOrder->getIncrementId());

        return $this->snakeToCamel($optionalIdentifiers->toArray());
    }
}

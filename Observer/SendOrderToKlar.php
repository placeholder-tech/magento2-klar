<?php
declare(strict_types=1);
/**
 * Copyright © ict. All rights reserved.
 * https://ict.lv/
 */

namespace ICT\Klar\Observer;

use ICT\Klar\Api\Data\ApiInterface;
use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;

class SendOrderToKlar implements ObserverInterface
{
    private ApiInterface $api;

    /**
     * SendOrderToKlar constructor.
     *
     * @param ApiInterface $api
     */
    public function __construct(ApiInterface $api)
    {
        $this->api = $api;
    }

    /**
     * Validate and send order to Klar on save.
     *
     * @param Observer $observer
     *
     * @return void
     */
    public function execute(Observer $observer): void
    {
        $order = $observer->getEvent()->getOrder();

        if ($order->getId()) {
            $salesOrder = $this->api->getOrder((int)$order->getId());

            if ($salesOrder) {
                $this->api->validateAndSend($salesOrder);
            }
        }
    }
}

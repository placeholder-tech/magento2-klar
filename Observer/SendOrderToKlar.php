<?php
declare(strict_types=1);
/**
 * Copyright © ict. All rights reserved.
 * https://ict.lv/
 */

namespace ICT\Klar\Observer;

use ICT\Klar\Queue\OrderPublisher;
use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;

use Magento\Sales\Api\Data\OrderInterface;

class SendOrderToKlar implements ObserverInterface
{
    private OrderPublisher $orderPublisher;

    /**
     * @param OrderPublisher $orderPublisher
     */
    public function __construct(
        OrderPublisher $orderPublisher
    ) {
        $this->orderPublisher = $orderPublisher;
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
        /** @var OrderInterface $order */
        $order = $observer->getEvent()->getOrder();

        if ($order->getId()) {
            $this->orderPublisher->publish([$order->getId()]);
        }
    }
}

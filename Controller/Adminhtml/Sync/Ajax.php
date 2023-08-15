<?php
declare(strict_types=1);
/**
 * Copyright © ict. All rights reserved.
 * https://ict.lv/
 */

namespace ICT\Klar\Controller\Adminhtml\Sync;

use ICT\Klar\Queue\OrderPublisher;
use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\Controller\Result\JsonFactory;

class Ajax extends Action
{
    private OrderPublisher $orderPublisher;
    private JsonFactory $jsonFactory;

    /**
     * @param Context $context
     * @param OrderPublisher $orderPublisher
     * @param JsonFactory $jsonFactory
     */
    public function __construct(
        Context $context,
        OrderPublisher $orderPublisher,
        JsonFactory $jsonFactory
    ) {
        parent::__construct($context);
        $this->orderPublisher = $orderPublisher;
        $this->jsonFactory = $jsonFactory;
    }

    /**
     * {@inheritDoc}
     */
    public function execute()
    {
        $this->orderPublisher->publish($this->orderPublisher->getAllIds());
        return $this->jsonFactory->create()->setData(['success' => true, 'message' => __('Scheduled')]);
    }

}

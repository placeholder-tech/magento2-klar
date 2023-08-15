<?php
declare(strict_types=1);
/**
 * Copyright © ict. All rights reserved.
 * https://ict.lv/
 */

namespace ICT\Klar\Plugin;

use Magento\Framework\MessageQueue\EnvelopeInterface;
use Magento\MysqlMq\Model\Driver\Queue;

class QueueRejectPlugin
{
    /**
     * @param Queue $subject
     * @param EnvelopeInterface $envelope
     * @param bool $requeue
     * @param string|null $rejectionMessage
     * @return array
     */
    public function beforeReject(Queue $subject, EnvelopeInterface $envelope, $requeue = true, $rejectionMessage = null): array
    {
        if ($rejectionMessage == '#NEED_TO_RETRY#') {
            $requeue = true;
        }
        return [$envelope, $requeue, $rejectionMessage];
    }
}

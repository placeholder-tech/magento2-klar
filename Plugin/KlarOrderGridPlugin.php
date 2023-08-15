<?php
declare(strict_types=1);
/**
 * Copyright © ict. All rights reserved.
 * https://ict.lv/
 */

namespace ICT\Klar\Plugin;

use Magento\Framework\Exception\LocalizedException;
use Magento\Sales\Model\ResourceModel\Order\Grid\Collection;

class KlarOrderGridPlugin
{
    /**
     * @param Collection $subject
     * @param bool $printQuery
     * @param bool $logQuery
     * @return array
     * @throws LocalizedException
     */
    public function beforeLoad(Collection $subject, $printQuery = false, $logQuery = false): array
    {
        if (!$subject->isLoaded()) {
            $primaryKey = $subject->getResource()->getIdFieldName();
            $tableName = $subject->getResource()->getTable('klar_order_attributes');

            $subject->getSelect()->joinLeft(
                $tableName,
                $tableName . '.order_id = main_table.' . $primaryKey,
                ['klar_sync' => 'sync']
            );
        }

        return [$printQuery, $logQuery];
    }
}

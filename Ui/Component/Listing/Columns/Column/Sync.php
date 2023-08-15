<?php
declare(strict_types=1);
/**
 * Copyright © ict. All rights reserved.
 * https://ict.lv/
 */

namespace ICT\Klar\Ui\Component\Listing\Columns\Column;

use Magento\Ui\Component\Listing\Columns\Column;

class Sync extends Column
{
    /**
     * {@inheritDoc}
     */
    public function prepareDataSource(array $dataSource)
    {
        if (isset($dataSource['data']['items'])) {
            foreach ($dataSource['data']['items'] as & $item) {
                if (isset($item['klar_sync'])) {
                    if ($item['klar_sync']) {
                        $item['klar_sync'] = __('Yes');
                    } else {
                        $item['klar_sync'] = __('Failed');
                    }
                } else {
                    $item['klar_sync'] = __('No');
                }
            }
        }

        return $dataSource;
    }
}

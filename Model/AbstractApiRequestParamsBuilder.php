<?php
declare(strict_types=1);
/**
 * Copyright © ict. All rights reserved.
 * https://ict.lv/
 */

namespace ICT\Klar\Model;

use Magento\Framework\Intl\DateTimeFactory;

abstract class AbstractApiRequestParamsBuilder
{
    private DateTimeFactory $dateTimeFactory;

    /**
     * AbstractApiRequestParamsBuilder constructor.
     *
     * @param DateTimeFactory $dateTimeFactory
     */
    public function __construct(
        DateTimeFactory $dateTimeFactory
    ) {
        $this->dateTimeFactory = $dateTimeFactory;
    }

    /**
     * Convert snake case to camel case.
     *
     * @param array $data
     *
     * @return array
     */
    protected function snakeToCamel(array $data): array
    {
        $result = [];

        foreach ($data as $key => $value) {
            $newKey = lcfirst(str_replace('_', '', ucwords($key, '_')));
            $result[$newKey] = $value;
        }

        return $result;
    }

    /**
     * Get timestamp from date time string.
     *
     * @param string $dateTime
     *
     * @return int
     */
    protected function getTimestamp(string $dateTime): int
    {
        if ($dateTime === '' | !$dateTime) {
            return $this->dateTimeFactory->create()->getTimestamp();
        }

        return $this->dateTimeFactory->create($dateTime)->getTimestamp();
    }
}

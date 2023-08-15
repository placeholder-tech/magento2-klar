<?php
declare(strict_types=1);
/**
 * Copyright © ict. All rights reserved.
 * https://ict.lv/
 */

namespace ICT\Klar\Api\Data;

interface ApiInterface
{
    public const ORDERS_STATUS_PATH = '/orders/status';
    public const ORDERS_VALIDATE_PATH = '/orders/validate';
    public const ORDERS_JSON_PATH = '/orders/json';
    public const ORDER_STATUS_VALID = 'VALID';
    public const ORDER_STATUS_INVALID = 'INVALID';
    public const STATUS_OK = 201;
    public const STATUS_BAD_REQUEST = 400;
    public const BATCH_SIZE = 1000;

    /**
     * Get Klar orders status.
     *
     * @return array
     */
    public function getStatus(): array;

    /**
     * Validate orders and send to Klar.
     *
     * @param int[] $salesOrders
     *
     * @return bool
     */
    public function validateAndSend(array $ids): bool;
}

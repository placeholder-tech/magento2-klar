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

    /**
     * Get order by order ID.
     *
     * @param int $orderId
     *
     * @return false|\Magento\Sales\Api\Data\OrderInterface
     */
    public function getOrder(int $orderId);

    /**
     * Get Klar orders status.
     *
     * @return array
     */
    public function getStatus(): array;

    /**
     * Validate order and send to Klar.
     *
     * @param \Magento\Sales\Api\Data\OrderInterface $salesOrder
     *
     * @return void
     */
    public function validateAndSend(\Magento\Sales\Api\Data\OrderInterface $salesOrder): void;
}

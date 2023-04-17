<?php
declare(strict_types=1);
/**
 * Copyright © ict. All rights reserved.
 * https://ict.lv/
 */

namespace ICT\Klar\Model;

use Exception;
use ICT\Klar\Api\Data\ApiInterface;
use ICT\Klar\Helper\Config;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\HTTP\Client\Curl;
use Magento\Sales\Api\Data\OrderInterface as SalesOrderInterface;
use Magento\Sales\Api\OrderRepositoryInterface as SalesOrderRepositoryInterface;
use Psr\Log\LoggerInterface as PsrLoggerInterface;

class Api implements ApiInterface
{
    private Curl $curl;

    private Config $config;

    private PsrLoggerInterface $logger;

    private ApiRequestParamsBuilder $paramsBuilder;

    private string $requestData;

    private SalesOrderRepositoryInterface $salesOrderRepository;

    /**
     * Api constructor.
     *
     * @param Curl $curl
     * @param Config $config
     * @param PsrLoggerInterface $logger
     * @param ApiRequestParamsBuilder $paramsBuilder
     * @param SalesOrderRepositoryInterface $salesOrderRepository
     */
    public function __construct(
        Curl $curl,
        Config $config,
        PsrLoggerInterface $logger,
        ApiRequestParamsBuilder $paramsBuilder,
        SalesOrderRepositoryInterface $salesOrderRepository
    ) {
        $this->requestData = '';
        $this->curl = $curl;
        $this->config = $config;
        $this->logger = $logger;
        $this->paramsBuilder = $paramsBuilder;
        $this->salesOrderRepository = $salesOrderRepository;
    }

    /**
     * Get order by order ID.
     *
     * @param int $orderId
     *
     * @return false|SalesOrderInterface
     */
    public function getOrder(int $orderId)
    {
        if ($this->config->getIsEnabled()) {
            try {
                return $this->salesOrderRepository->get($orderId);
            } catch (NoSuchEntityException $e) {
                return false;
            }
        }

        return false;
    }

    /**
     * Validate order and send to Klar.
     *
     * @param SalesOrderInterface $salesOrder
     *
     * @return void
     */
    public function validateAndSend(SalesOrderInterface $salesOrder): void
    {
        if ($this->config->getIsEnabled() && $this->validate($salesOrder)) {
            $this->json($salesOrder);
        }
    }

    /**
     * Make order validate request.
     *
     * @param SalesOrderInterface $salesOrder
     *
     * @return bool
     */
    private function validate(SalesOrderInterface $salesOrder): bool
    {
        $this->logger->info(__('Validating order "#%1".', $salesOrder->getIncrementId()));

        if (!$this->requestData) {
            $this->setRequestData($salesOrder);
        }

        $this->getCurlClient()->post(
            $this->getRequestUrl(self::ORDERS_VALIDATE_PATH, true),
            $this->requestData
        );

        if ($this->getCurlClient()->getStatus() === self::STATUS_OK) {
            return $this->handleSuccess($salesOrder->getIncrementId());
        }

        if ($this->getCurlClient()->getStatus() === self::STATUS_BAD_REQUEST) {
            return $this->handleError($salesOrder->getIncrementId());
        }

        $this->logger->info(__('Failed to validate order "#%1".', $salesOrder->getIncrementId()));

        return false;
    }

    /**
     * Set request data.
     *
     * @param SalesOrderInterface $salesOrder
     *
     * @return void
     */
    private function setRequestData(SalesOrderInterface $salesOrder): void
    {
        try {
            $this->requestData = json_encode(
                [$this->paramsBuilder->buildFromSalesOrder($salesOrder)],
                JSON_THROW_ON_ERROR
            );
        } catch (Exception $e) {
            $this->logger->info(__('Error building params: %1', $e->getMessage()));
        }
    }

    /**
     * Get CURL client.
     *
     * @return Curl
     */
    private function getCurlClient(): Curl
    {
        $this->curl->setHeaders($this->getHeaders());

        return $this->curl;
    }

    /**
     * Get request headers.
     *
     * @return string[]
     */
    private function getHeaders(): array
    {
        return [
            'Content-Type' => 'application/json',
            'Authorization' => 'Bearer ' . $this->getApiToken(),
        ];
    }

    /**
     * Get API token.
     *
     * @return string
     */
    private function getApiToken(): string
    {
        return $this->config->getApiToken();
    }

    /**
     * Get request endpoint URL.
     *
     * @param string $path
     * @param bool $includeVersion
     *
     * @return string
     */
    private function getRequestUrl(string $path, bool $includeVersion = false): string
    {
        if ($includeVersion) {
            $baseUrl = $this->config->getApiUrl();
            $version = $this->config->getApiVersion();

            return $baseUrl . '/' . $version . $path;
        }

        return $this->config->getApiUrl() . $path;
    }

    /**
     * Get Klar orders status.
     *
     * @return array
     */
    public function getStatus(): array
    {
        return $this->status();
    }

    /**
     * Make order status API request.
     *
     * @return array
     */
    private function status(): array
    {
        $this->getCurlClient()->get($this->getRequestUrl(self::ORDERS_STATUS_PATH));

        if ($this->getCurlClient()->getStatus() === 200) {
            try {
                return json_decode(
                    $this->getCurlClient()->getBody(),
                    true,
                    512,
                    JSON_THROW_ON_ERROR
                );
            } catch (Exception $e) {
                $this->logger->error(__('Orders status error: %1', $e->getMessage()));
            }
        }

        return [__('Error fetching orders status.')];
    }

    /**
     * Handle success.
     *
     * @param string $incrementId
     *
     * @return bool
     */
    private function handleSuccess(string $incrementId): bool
    {
        $body = $this->getCurlBody();

        if (isset($body['status']) && $body['status'] === self::ORDER_STATUS_VALID) {
            $this->logger->info(__('Order "#%1" is valid and can be sent to Klar.', $incrementId));

            return true;
        }

        return false;
    }

    /**
     * Get curl request response body.
     *
     * @return array
     */
    private function getCurlBody(): array
    {
        try {
            return json_decode(
                $this->getCurlClient()->getBody(),
                true,
                512,
                JSON_THROW_ON_ERROR
            );
        } catch (Exception $e) {
            $this->logger->info(__('Error getting body from request response: %1', $e->getMessage()));
        }

        return [];
    }

    /**
     * Handle error.
     *
     * @param string $incrementId
     *
     * @return bool
     */
    private function handleError(string $incrementId): bool
    {
        $body = $this->getCurlBody();

        if (isset($body['status'], $body['errors']) && $body['status'] === self::ORDER_STATUS_INVALID) {
            foreach ($body['errors'] as $errorMessage) {
                $this->logger->info($errorMessage);
            }

            $this->logger->info(__('Failed to validate order "#%1":', $incrementId));

            return false;
        }

        return false;
    }

    /**
     * Make order json request.
     *
     * @param SalesOrderInterface $salesOrder
     *
     * @return void
     */
    private function json(SalesOrderInterface $salesOrder): void
    {
        $this->logger->info(__('Sending order "#%1".', $salesOrder->getIncrementId()));

        if (!$this->requestData) {
            $this->setRequestData($salesOrder);
        }

        $this->getCurlClient()->post(
            $this->getRequestUrl(self::ORDERS_JSON_PATH, true),
            $this->requestData
        );

        if ($this->getCurlClient()->getStatus() === self::STATUS_OK) {
            $this->logger->info(__('Order "#%1" successfully sent to Klar.', $salesOrder->getIncrementId()));
        } else {
            $this->logger->info(__('Failed to send order "#%1".', $salesOrder->getIncrementId()));
        }
    }
}

<?php
declare(strict_types=1);
/**
 * Copyright © ict. All rights reserved.
 * https://ict.lv/
 */

namespace ICT\Klar\Queue;

use Exception;
use ICT\Klar\Model\Api;
use Magento\AsynchronousOperations\Api\Data\OperationInterface;
use Magento\Framework\DB\Adapter\AdapterInterface;
use Magento\Framework\Serialize\Serializer\Json;
use Magento\Framework\App\ResourceConnection;

class OrderQueue
{
    private Api $api;
    private Json $jsonSerializer;
    private AdapterInterface $connection;

    /**
     * @param Api $api
     * @param Json $jsonSerializer
     * @param ResourceConnection $resourceConnection
     */
    public function __construct(
        Api $api,
        Json $jsonSerializer,
        ResourceConnection $resourceConnection
    ) {
        $this->api = $api;
        $this->jsonSerializer = $jsonSerializer;
        $this->connection = $resourceConnection->getConnection();
    }

    /**
     * @param OperationInterface $operation
     * @return void
     * @throws Exception
     */
    public function process(OperationInterface $operation): void
    {
        $serializedData = $operation->getSerializedData();
        $ids = $this->jsonSerializer->unserialize($serializedData);

        try {
            $resultValue = (int) $result = $this->api->validateAndSend($ids);

            $values = [];
            foreach ($ids as $id) {
                $values[] = "({$id}, {$resultValue})";
            }
            $values = implode(',', $values);

            $tableName = $this->connection->getTableName('klar_order_attributes');
            $query = "INSERT INTO {$tableName} (order_id, sync) VALUES {$values} ON DUPLICATE KEY UPDATE sync = {$resultValue}";
            $this->connection->query($query);
        } catch (Exception $exception) {
            $result = false;
        }

        if (!$result) {
            throw new Exception('#NEED_TO_RETRY#');
        }
    }
}

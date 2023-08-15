<?php
declare(strict_types=1);
/**
 * Copyright © ict. All rights reserved.
 * https://ict.lv/
 */

namespace ICT\Klar\Queue;

use DateTime;
use ICT\Klar\Model\Api;
use Magento\AsynchronousOperations\Api\Data\OperationInterfaceFactory;
use Magento\Framework\App\ResourceConnection;
use Magento\Framework\DB\Adapter\AdapterInterface;
use Magento\Framework\MessageQueue\PublisherInterface;
use Magento\Framework\Bulk\OperationInterface;
use Magento\Framework\Serialize\Serializer\Json;

class OrderPublisher
{
    private OperationInterfaceFactory $operationFactory;
    private PublisherInterface $publisher;
    private Json $jsonSerializer;
    private AdapterInterface $connection;

    /**
     * @param PublisherInterface $publisher
     * @param OperationInterfaceFactory $operationFactory
     * @param Json $jsonSerializer
     * @param ResourceConnection $resourceConnection
     */
    public function __construct(
        PublisherInterface $publisher,
        OperationInterfaceFactory $operationFactory,
        Json $jsonSerializer,
        ResourceConnection $resourceConnection
    ) {
        $this->operationFactory = $operationFactory;
        $this->publisher = $publisher;
        $this->jsonSerializer = $jsonSerializer;
        $this->connection = $resourceConnection->getConnection();
    }

    /**
     * @return int[]
     */
    public function getAllIds(?DateTime $fromDate = null): array
    {
        $bind = [];

        $select = $this->connection->select();
        $select->from(['e' => $this->connection->getTableName('sales_order')], [])
            ->columns(['entity_id']);
        if ($fromDate) {
            $select->where('e.created_at >= :from');
            $bind = ['from' => $fromDate->format('Y-m-d 00:00:00')];
        }

        $rows = $this->connection->fetchAssoc($select, $bind);
        return array_keys($rows);
    }

    /**
     * @param int[] $ids
     * @return void
     */
    public function publish(array $ids): void
    {
        $chunks = array_chunk($ids, Api::BATCH_SIZE);
        foreach ($chunks as $chunk) {
            $operation = $this->operationFactory->create();
            $operation->setSerializedData(
                $this->jsonSerializer->serialize(
                    $chunk
                )
            );
            $operation->setTopicName('klar.order.synchronization');
            $operation->setStatus(OperationInterface::STATUS_TYPE_OPEN);

            $this->publisher->publish('klar.order.synchronization', $operation);
        }
    }
}

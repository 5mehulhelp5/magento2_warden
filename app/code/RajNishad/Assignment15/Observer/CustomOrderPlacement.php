<?php

namespace RajNishad\Assignment15\Observer;

use Magento\Framework\Event\ObserverInterface;
use Magento\Framework\Event\Observer;
use Magento\Framework\App\ResourceConnection;

class CustomOrderPlacement implements ObserverInterface
{
    protected $resource;
    protected $logger;

    public function __construct(ResourceConnection $resource, \Psr\Log\LoggerInterface $logger)
    {
        $this->resource = $resource;
        $this->logger = $logger;
    }

    public function execute(Observer $observer)
    {
        $order = $observer->getEvent()->getOrder();
        $this->logger->info('Order Placed: ' . $order->getIncrementId());
        $groupId = $order->getCustomerGroupId();
        $grandTotal = $order->getGrandTotal();

        $connection = $this->resource->getConnection();
        $table = $this->resource->getTableName('raj_assignment15_group_sales');

        // Check if record exists
        $select = $connection->select()
            ->from($table, ['entity_id', 'total_sales'])
            ->where('customer_group_id = ?', $groupId);

        $row = $connection->fetchRow($select);

        if ($row) {
            $newTotal = $row['total_sales'] + $grandTotal;
            $connection->update(
                $table,
                ['total_sales' => $newTotal],
                ['entity_id = ?' => $row['entity_id']]
            );
        } else {
            $connection->insert(
                $table,
                ['customer_group_id' => $groupId, 'total_sales' => $grandTotal]
            );
        }
    }
}

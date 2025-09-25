<?php

namespace RajNishad\Assignment15\Observer;

use Magento\Framework\Event\ObserverInterface;
use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ManagerInterface as EventManager;

class OrderPlaceAfter implements ObserverInterface
{
    protected $eventManager;

    // You can change this to any group you want to track (e.g., Wholesale group id)
    //+-------------------+---------------------+
    //| customer_group_id | customer_group_code |
    //+-------------------+---------------------+
    //|                 0 | NOT LOGGED IN       |
    //|                 1 | General             |
    //|                 2 | Wholesale           |
    //|                 3 | Retailer            |
    // 1 for roni_cost@example.com
    const TARGET_CUSTOMER_GROUP_ID = 1;

    public function __construct(EventManager $eventManager)
    {
        $this->eventManager = $eventManager;
    }

    public function execute(Observer $observer)
    {
        $order = $observer->getEvent()->getOrder();
        $customerGroupId = $order->getCustomerGroupId();

        if ($customerGroupId == self::TARGET_CUSTOMER_GROUP_ID) {
            $this->eventManager->dispatch(
                'custom_order_placement',
                ['order' => $order]
            );
        }
    }
}

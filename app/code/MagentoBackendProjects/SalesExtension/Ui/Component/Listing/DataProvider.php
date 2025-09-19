<?php

namespace MagentoBackendProjects\SalesExtension\Ui\Component\Listing;

use Magento\Sales\Model\ResourceModel\Order\CollectionFactory;
use Magento\Ui\DataProvider\AbstractDataProvider;

class DataProvider extends AbstractDataProvider
{
    protected $collection;

    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        CollectionFactory $collectionFactory,
        array $meta = [],
        array $data = []
    ) {
        $this->collection = $collectionFactory->create();
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
    }

    public function getData()
    {
        // Convert collection into the format UI component expects
        $items = [];
        foreach ($this->collection as $order) {
            $items[] = [
                'entity_id'      => $order->getEntityId(),
                'customer_name'  => $order->getCustomerFirstname() . ' ' . $order->getCustomerLastname(),
                'created_at'     => $order->getCreatedAt(),
                'grand_total'    => $order->getGrandTotal(),
            ];
        }

        foreach ($this->collection as $order) {
            error_log(print_r($order->getData(), true)); // dump all available keys
        }


        return [
            'totalRecords' => $this->collection->getSize(),
            'items'        => $items
        ];
    }
}

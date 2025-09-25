<?php

namespace Test\EAV\Model;

use Magento\Catalog\Model\ResourceModel\Product\CollectionFactory;

class Temp
{
    protected $productCollectionFactory;

    public function __construct(
        CollectionFactory $productCollectionFactory,
    ) {
        $this->productCollectionFactory = $productCollectionFactory;
    }

    public function getAllProducts()
    {
        $collection = $this->productCollectionFactory->create();

        return $collection;
    }
}

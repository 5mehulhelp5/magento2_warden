<?php


namespace Mastering\SampleModule\Block;

use Magento\Framework\View\Element\Template;
use Mastering\SampleModule\Model\ResourceModel\Item\Collection;
// Appending the "Factory" suffix to any class makes magento auto-generate a factory for us when doing `setup:di:compile`
use Mastering\SampleModule\Model\ResourceModel\Item\CollectionFactory;

class Hello extends Template
{
    private $collectionFactory;

    public function __construct(
        Template\Context $context,
        CollectionFactory $collectionFactory,
        // this data here can be accessed in templates using magic methods with the convention of get<ArrayKey>
        // the data here is passed on layout configuration for the block using arguments. Thus allowing the same block to be reusable and customizable
        array $data = []
    ) {
        parent::__construct($context, $data);
        $this->collectionFactory = $collectionFactory;
    }

    /**
     * @return \Mastering\SampleModule\Model\Item[]
     */
    public function getItems()
    {
        /** @var Collection $collection */
        $collection = $this->collectionFactory->create();
        return $collection->getItems();
    }
}

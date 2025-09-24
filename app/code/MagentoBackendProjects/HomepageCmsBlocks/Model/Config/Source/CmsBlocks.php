<?php

namespace MagentoBackendProjects\HomepageCmsBlocks\Model\Config\Source;

use Magento\Cms\Model\ResourceModel\Block\CollectionFactory;

class CmsBlocks implements \Magento\Framework\Option\ArrayInterface
{
    protected $collectionFactory;

    public function __construct(CollectionFactory $collectionFactory)
    {
        $this->collectionFactory = $collectionFactory;
    }

    public function toOptionArray()
    {
        $options = [];
        $collection = $this->collectionFactory->create();

        foreach ($collection as $block) {
            $options[] = [
                'value' => $block->getIdentifier(),
                'label' => $block->getTitle()
            ];
        }

        return $options;
    }
}

<?php

/**
 * Copyright 2024 Adobe
 * All Rights Reserved.
 */

namespace RajNishad\RatingFilter\Plugin\Model\Layer;

use Magento\Catalog\Model\Layer\FilterableAttributeListInterface;
use Magento\Framework\ObjectManagerInterface;
use RajNishad\RatingFilter\Model\Layer\Filter\Rating as RatingFilter;

class FilterList
{
    /**
     * @var ObjectManagerInterface
     */
    private $objectManager;

    /**
     * Constructor
     *
     * @param ObjectManagerInterface $objectManager
     */
    public function __construct(ObjectManagerInterface $objectManager)
    {
        $this->objectManager = $objectManager;
    }

    /**
     * Adds our custom rating filter to the filter list.
     *
     * @param \Magento\Catalog\Model\Layer\FilterList $subject
     * @param array $filters
     * @param \Magento\Catalog\Model\Layer $layer
     * @return array
     */
    public function afterGetFilters(
        \Magento\Catalog\Model\Layer\FilterList $subject,
        array $filters,
        \Magento\Catalog\Model\Layer $layer
    ): array {
        // Add our custom filter to the list
        $filters[] = $this->objectManager->create(RatingFilter::class, ['layer' => $layer]);
        return $filters;
    }
}

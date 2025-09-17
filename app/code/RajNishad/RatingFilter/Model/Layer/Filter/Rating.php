<?php

/**
 * Copyright 2024 Adobe
 * All Rights Reserved.
 */

namespace RajNishad\RatingFilter\Model\Layer\Filter;

use Magento\Catalog\Model\Layer\Filter\AbstractFilter;
use Magento\Framework\App\RequestInterface;
use Magento\Framework\Exception\LocalizedException;

class Rating extends AbstractFilter
{
    /**
     * @var \Magento\Framework\DB\Adapter\AdapterInterface
     */
    private $connection;

    /**
     * The request parameter key for the rating filter
     */
    public const RATING_REQUEST_VAR = 'rating';

    /**
     * Constructor
     *
     * @param \Magento\Catalog\Model\Layer\Filter\ItemFactory $filterItemFactory
     * @param \Magento\Store\Model\StoreManagerInterface $storeManager
     * @param \Magento\Catalog\Model\Layer $layer
     * @param \Magento\Catalog\Model\Layer\Filter\Item\DataBuilder $itemDataBuilder
     * @param \Magento\Framework\App\ResourceConnection $resource
     * @param array $data
     */
    public function __construct(
        \Magento\Catalog\Model\Layer\Filter\ItemFactory $filterItemFactory,
        \Magento\Store\Model\StoreManagerInterface $storeManager,
        \Magento\Catalog\Model\Layer $layer,
        \Magento\Catalog\Model\Layer\Filter\Item\DataBuilder $itemDataBuilder,
        \Magento\Framework\App\ResourceConnection $resource,
        array $data = []
    ) {
        parent::__construct($filterItemFactory, $storeManager, $layer, $itemDataBuilder, $data);
        $this->_requestVar = self::RATING_REQUEST_VAR;
        $this->connection = $resource->getConnection();
    }

    /**
     * Applies the rating filter to the product collection.
     *
     * @param RequestInterface $request
     * @return $this
     * @throws LocalizedException
     */
    public function apply(RequestInterface $request)
    {
        $ratingValue = $request->getParam($this->_requestVar);
        if (empty($ratingValue) || !is_numeric($ratingValue)) {
            return $this;
        }

        // Convert star value to percentage (e.g., 4 stars is 80%)
        $ratingPercentage = (int)$ratingValue * 20;

        $productCollection = $this->getLayer()->getProductCollection();

        // Join the review summary table to filter by rating
        $productCollection->getSelect()->join(
            ['rating_summary' => $productCollection->getTable('review_entity_summary')],
            'e.entity_id = rating_summary.entity_pk_value AND rating_summary.store_id = ' . $this->getStoreId(),
            ['rating_summary' => 'rating_summary.rating_summary']
        )->where('rating_summary.rating_summary >= ?', $ratingPercentage);

        $this->getLayer()->getState()->addFilter(
            $this->_createItem($this->getLabelForValue($ratingValue), $ratingValue)
        );

        return $this;
    }

    /**
     * Get the name of the filter.
     *
     * @return \Magento\Framework\Phrase
     */
    public function getName(): \Magento\Framework\Phrase
    {
        return __('Rating');
    }

    /**
     * Get the filter options data.
     *
     * @return array
     */
    protected function _getItemsData(): array
    {
        $options = [];
        // Define rating options from 5 down to 1
        for ($i = 5; $i >= 1; $i--) {
            $count = $this->getProductsCount($i);
            // Only show the option if there are products with that rating or higher
            if ($count > 0) {
                $options[] = [
                    'label' => $this->getLabelForValue($i),
                    'value' => $i,
                    'count' => $count,
                ];
            }
        }
        return $options;
    }

    /**
     * Gets the product count for a specific rating value.
     *
     * @param int $ratingValue
     * @return int
     */
    protected function getProductsCount(int $ratingValue): int
    {
        // Clone the collection to avoid affecting the main query
        $collection = clone $this->getLayer()->getProductCollection();
        $ratingPercentage = $ratingValue * 20;

        $collection->getSelect()->join(
            ['rating_summary_count' => $collection->getTable('review_entity_summary')],
            'e.entity_id = 
            rating_summary_count.entity_pk_value AND 
            rating_summary_count.store_id = ' . $this->getStoreId(),
            []
        )->where('rating_summary_count.rating_summary >= ?', $ratingPercentage);

        return $collection->getSize();
    }

    /**
     * Helper to create labels for the filter options.
     *
     * @param int $value
     * @return \Magento\Framework\Phrase
     */
    private function getLabelForValue(int $value): \Magento\Framework\Phrase
    {
        if ($value == 5) {
            return __('5 Stars');
        }
        return __('%1 Stars & up', $value);
    }
}

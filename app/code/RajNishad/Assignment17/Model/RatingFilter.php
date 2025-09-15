<?php

/**
 * Copyright 2024 Adobe
 * All Rights Reserved.
 */

namespace RajNishad\Assignment17\Model;

use Magento\Catalog\Model\Layer\Filter\AbstractFilter;
use Magento\Review\Model\ResourceModel\Review\CollectionFactory as ReviewCollectionFactory;
use Magento\Catalog\Model\Layer;
// Import the missing classes
use Magento\Store\Model\StoreManagerInterface;
use Magento\Catalog\Model\Layer\Filter\ItemFactory;
use Magento\Catalog\Model\Layer\Filter\Item\DataBuilder;

class RatingFilter extends AbstractFilter
{
    /**
     * @var $reviewCollectionFactory
     */
    protected $reviewCollectionFactory;

    /**
     * @param ItemFactory $filterItemFactory
     * @param StoreManagerInterface $storeManager
     * @param Layer $layer
     * @param DataBuilder $itemDataBuilder
     * @param ReviewCollectionFactory $reviewCollectionFactory
     * @param array $data
     */
    public function __construct(
        ItemFactory $filterItemFactory,
        StoreManagerInterface $storeManager, // <-- Required by parent
        Layer $layer,
        DataBuilder $itemDataBuilder,        // <-- Required by parent
        ReviewCollectionFactory $reviewCollectionFactory,
        array $data = []
    ) {
        $this->reviewCollectionFactory = $reviewCollectionFactory;
        // Pass the required arguments to the parent constructor in the correct order
        parent::__construct(
            $filterItemFactory,
            $storeManager,
            $layer,
            $itemDataBuilder,
            $data
        );
    }

    /**
     * Apply func
     *
     * @param \Magento\Framework\App\RequestInterface $request
     */
    public function apply(\Magento\Framework\App\RequestInterface $request)
    {
        $rating = $request->getParam($this->getRequestVar());
        if (!$rating) {
            return $this;
        }

        // Get the current product collection from the layer
        $productCollection = $this->getLayer()->getProductCollection();
        $productIds = $this->getProductsByRating($rating, $productCollection->getAllIds());

        $productCollection->addFieldToFilter('entity_id', ['in' => $productIds]);

        $this->getLayer()->getState()->addFilter(
            $this->_createItem($rating . ' Stars & Up', $rating)
        );

        return $this;
    }

    /**
     * Getname func
     */
    public function getName()
    {
        return __('Rating');
    }

    /**
     * Getitems func
     */
    public function getItems()
    {
        if (count($this->getItemsData()) > 0) {
            return parent::getItems();
        }
        return [];
    }

    /**
     * GetItemsData func
     */
    protected function _getItemsData()
    {
        $data = [];
        $productIds = $this->getLayer()->getProductCollection()->getAllIds();

        for ($i = 5; $i >= 1; $i--) {
            $count = count($this->getProductsByRating($i, $productIds));
            if ($count > 0) {
                $data[] = [
                    'label' => __('%1 stars & up', $i),
                    'value' => $i,
                    'count' => $count
                ];
            }
        }
        return $data;
    }

    /**
     * Ratings filter
     *
     * @param float $rating
     * @param string $productIdsScope
     */
    protected function getProductsByRating($rating, $productIdsScope)
    {
        if (empty($productIdsScope)) {
            return [0];
        }

        $reviewCollection = $this->reviewCollectionFactory->create()
            ->addStatusFilter(\Magento\Review\Model\Review::STATUS_APPROVED)
            ->addFieldToFilter('entity_pk_value', ['in' => $productIdsScope]);

        $reviewCollection->getSelect()
            ->columns(['avg_rating' => 'AVG(rating_option_vote.value)'])
            ->join(
                ['rating_option_vote' => $reviewCollection->getTable('rating_option_vote')],
                'main_table.review_id = rating_option_vote.review_id',
                []
            )
            ->group('main_table.entity_pk_value')
            ->having('AVG(rating_option_vote.value) >= ?', (float)$rating);

        $productIds = $reviewCollection->getColumnValues('entity_pk_value');
        return $productIds ?: [0];
    }
}

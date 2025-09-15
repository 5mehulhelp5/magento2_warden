<?php

/**
 * Copyright 2024 Adobe
 * All Rights Reserved.
 */

namespace RajNishad\Assignment19\Block;

use Magento\Checkout\Model\Cart;
use Magento\Framework\View\Element\Template;
use Magento\Catalog\Api\ProductRepositoryInterface;
use Magento\Catalog\Helper\Image;
use Magento\Framework\Pricing\Helper\Data as PriceHelper;

class Crosssell extends Template
{
    /**
     * @var Magento\Checkout\Model\Cart $cart
     */
    protected $cart;

    /**
     * @var Magento\Catalog\Api\ProductRepositoryInterface $productRepository
     */
    protected $productRepository;

    /**
     * @var Magento\Catalog\Helper\Image $imageHelper
     */
    protected $imageHelper;

    /**
     * @var Magento\Framework\Pricing\Helper\Data $priceHelper
     */
    protected $priceHelper;

    /**
     * Assignment func
     *
     * @param \Magento\Framework\View\Element\Template\Context $context
     * @param \Magento\Checkout\Model\Cart $cart
     * @param \Magento\Catalog\Api\ProductRepositoryInterface $productRepository
     * @param \Magento\Catalog\Helper\Image $imageHelper
     * @param \Magento\Framework\Pricing\Helper\Data $priceHelper
     * @param array $data
     */
    public function __construct(
        Template\Context $context,
        Cart $cart,
        ProductRepositoryInterface $productRepository,
        Image $imageHelper,
        PriceHelper $priceHelper,
        array $data = []
    ) {
        $this->cart = $cart;
        $this->productRepository = $productRepository;
        $this->imageHelper = $imageHelper;
        $this->priceHelper = $priceHelper;
        parent::__construct($context, $data);
    }

    /**
     * Get Image
     *
     * @param string $product
     * @param number $imageId
     */
    public function getImage($product, $imageId)
    {
        return $this->imageHelper->init($product, $imageId);
    }

    /**
     * Get Currency
     */
    public function getCurrency()
    {
        return $this->priceHelper;
    }

    /**
     * Get cross-sell products for all cart items (limit 2 each)
     */
    public function getCrosssellProducts()
    {
        $items = $this->cart->getQuote()->getAllItems();
        $crosssellProducts = [];

        foreach ($items as $item) {
            $product = $this->productRepository->getById($item->getProductId());
            $crosssell = $product->getCrossSellProducts();

            $limited = array_slice($crosssell, 0, 2);
            foreach ($limited as $p) {
                $crosssellProducts[$p->getId()] = $p; // avoid duplicates
            }
        }

        return $crosssellProducts;
    }
}

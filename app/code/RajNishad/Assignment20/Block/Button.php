<?php

/**
 * Copyright 2024 Adobe
 * All Rights Reserved.
 */

namespace RajNishad\Assignment20\Block;

use Magento\Framework\View\Element\Template;
use Magento\Catalog\Model\Product;
use Magento\InventorySalesApi\Api\GetProductSalableQtyInterface;

/**
 * Class Button
 *
 * Displays "Call For Availability" button when product is out of stock
 */
class Button extends Template
{
    /**
     * @var GetProductSalableQtyInterface
     */
    protected $salableQty;

    /**
     * Button constructor.
     *
     * @param Template\Context $context
     * @param GetProductSalableQtyInterface $salableQty
     * @param array $data
     */
    public function __construct(
        Template\Context $context,
        GetProductSalableQtyInterface $salableQty,
        array $data = []
    ) {
        $this->salableQty = $salableQty;
        parent::__construct($context, $data);
    }

    /**
     * Check if "Call For Availability" button should be shown
     *
     * @param Product $product
     * @return bool
     */
    public function shouldShowCallButton(Product $product): bool
    {
        try {
            $websiteId = $this->_storeManager->getStore()->getWebsiteId();
            $qty = $this->salableQty->execute($product->getSku(), $websiteId);
            return $qty <= 0;
        } catch (\Exception $e) {
            return false;
        }
    }

    /**
     * Get URL of the contact page
     *
     * @return string
     */
    public function getContactUrl(): string
    {
        return $this->getUrl('contact');
    }

    /**
     * Get current product
     *
     * @return Product|null
     */
    public function getProduct(): ?Product
    {
        if ($this->getData('product')) {
            return $this->getData('product');
        }

        if ($this->getParentBlock() && method_exists($this->getParentBlock(), 'getProduct')) {
            return $this->getParentBlock()->getProduct();
        }

        return null;
    }
}

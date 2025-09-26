<?php

namespace MagentoBackendProjects\CatalogDiscount\Observer;

use Magento\Framework\Event\ObserverInterface;
use Magento\Framework\Event\Observer;

class MarkProductDetail implements ObserverInterface
{
    public function execute(Observer $observer)
    {
        $product = $observer->getEvent()->getProduct();
        $product->setData('is_product_detail', true);
    }
}

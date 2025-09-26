<?php

namespace MagentoBackendProjects\CatalogDiscount\Plugin;

use Magento\Catalog\Model\Product;
use Magento\Customer\Model\Session as CustomerSession;
use MagentoBackendProjects\CatalogDiscount\Helper\Data;

class ApplyDiscount
{
    protected $customerSession;
    protected $helper;

    public function __construct(
        CustomerSession $customerSession,
        Data $helper
    ) {
        $this->customerSession = $customerSession;
        $this->helper = $helper;
    }

    public function afterGetFinalPrice($result, $finalPrice, Product $subject)
    {
        $discountGroup = $this->helper->getCustomerGroup();
        $discountPercent = $this->helper->getDiscountPercent();

        if (!$this->customerSession->isLoggedIn()) {
            return $finalPrice;
        }

        $currentGroupId = $this->customerSession->getCustomerGroupId();

        // Apply discount only if matches and > 0
        if ($discountGroup && $currentGroupId == $discountGroup && $discountPercent > 0) {
            // Apply only on product detail page
            if ($subject->getData('is_product_detail')) {
                $finalPrice = $finalPrice - ($finalPrice * $discountPercent / 100);
            }
        }
        return $finalPrice;
    }
}

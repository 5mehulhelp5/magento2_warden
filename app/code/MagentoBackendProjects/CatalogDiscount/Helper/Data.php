<?php

namespace MagentoBackendProjects\CatalogDiscount\Helper;

use Magento\Framework\App\Helper\AbstractHelper;
use Magento\Store\Model\ScopeInterface;

class Data extends AbstractHelper
{
    const XML_PATH_GROUP = 'catalogdiscount/general/customer_group';
    const XML_PATH_PERCENT = 'catalogdiscount/general/discount_percent';

    public function getCustomerGroup()
    {
        return $this->scopeConfig->getValue(self::XML_PATH_GROUP, ScopeInterface::SCOPE_STORE);
    }

    public function getDiscountPercent()
    {
        return (float)$this->scopeConfig->getValue(self::XML_PATH_PERCENT, ScopeInterface::SCOPE_STORE);
    }
}

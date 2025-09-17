<?php

/**
 * Copyright 2024 Adobe
 * All Rights Reserved.
 */

namespace RajNishad\Assignment24\Helper;

use Magento\Framework\App\Helper\AbstractHelper;
use Magento\Store\Model\ScopeInterface;

class Data extends AbstractHelper
{
    /**
     * @var string XML path for sales email config
     * @var string XML path for payment methods config
     */
    public const XML_PATH_SALES_EMAIL = 'sales_email/general/async_sending';
    public const XML_PATH_PAYMENT_METHODS = 'payment/general/active';

    /**
     * Get sales email config value
     */
    public function getSalesEmailConfig()
    {
        return $this->scopeConfig->getValue(
            self::XML_PATH_SALES_EMAIL,
            ScopeInterface::SCOPE_STORE
        );
    }

    /**
     * Get payment methods config value
     */
    public function getPaymentMethodsConfig()
    {
        return $this->scopeConfig->getValue(
            self::XML_PATH_PAYMENT_METHODS,
            ScopeInterface::SCOPE_STORE
        );
    }
}

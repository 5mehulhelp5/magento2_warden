<?php

/**
 * Copyright 2024 Adobe
 * All Rights Reserved.
 */

namespace RajNishad\Assignment24\Block;

use Magento\Framework\View\Element\Template;
use RajNishad\Assignment24\Helper\Data;

class Config extends Template
{
    /**
     * @var Data $helper
     */
    protected $helper;

    /**
     * Assign helper and context
     *
     * @param Template\Context $context
     * @param Data $helper
     * @param array $data
     */
    public function __construct(
        Template\Context $context,
        Data $helper,
        array $data = []
    ) {
        $this->helper = $helper;
        parent::__construct($context, $data);
    }

    /**
     * Get config data from helper
     */
    public function getConfigData()
    {
        return [
            'sales_email' => $this->helper->getSalesEmailConfig(),
            'payment_methods' => $this->helper->getPaymentMethodsConfig(),
        ];
    }
}

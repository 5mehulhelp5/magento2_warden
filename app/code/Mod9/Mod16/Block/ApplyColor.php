<?php

/**
 * Copyright 2024 Adobe
 * All Rights Reserved.
 */

namespace Mod9\Mod16\Block;

use Magento\Framework\View\Element\Template;
use Magento\Framework\App\Config\ScopeConfigInterface;

class ApplyColor extends Template
{
    /**
     * @var protected $scopeConfig
     */
    protected $scopeConfig;

    /**
     * Assignment.
     *
     * @param Template\Context $context
     * @param ScopeConfigInterface $scopeConfig
     * @param array $data
     */
    public function __construct(
        Template\Context $context,
        ScopeConfigInterface $scopeConfig,
        array $data = []
    ) {
        $this->scopeConfig = $scopeConfig;
        parent::__construct($context, $data);
    }

    /**
     * Sets backround color
     */
    public function getBackgroundColor()
    {
        return $this->scopeConfig->getValue(
            'mod16/general/background_color',
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE
        );
    }
}

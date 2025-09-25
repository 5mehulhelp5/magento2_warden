<?php

namespace Mastering\SampleModule\Model;

use Magento\Framework\App\Config\ScopeConfigInterface;

class Config
{
    private $config;

    public function __construct(ScopeConfigInterface $config)
    {
        $this->config = $config;
    }

    public function isEnabled()
    {
        return $this->config->getValue("mastering/general/enabled");
    }
}

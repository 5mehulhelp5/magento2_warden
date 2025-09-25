<?php

namespace RajNishad\Mod9\Controller\Index;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;
use Magento\Framework\App\Config\ScopeConfigInterface;

class Display extends Action
{
    protected $scopeConfig;
    protected $resultPageFactory;

    public function __construct(
        Context $context,
        ScopeConfigInterface $scopeConfig,
        PageFactory $resultPageFactory
    ) {
        $this->scopeConfig = $scopeConfig;
        $this->resultPageFactory = $resultPageFactory;
        parent::__construct($context);
    }

    public function execute()
    {
        $isEnabled = $this->scopeConfig->getValue('mod9/mod9/enable', \Magento\Store\Model\ScopeInterface::SCOPE_STORE);

        if ($isEnabled) {
            $text = $this->scopeConfig->getValue('mod9/mod9/text_to_display', \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
            echo "<h1>" . $text . "</h1>";
        } else {
            echo "<h1>Module is disabled</h1>";
        }
        exit;
    }
}

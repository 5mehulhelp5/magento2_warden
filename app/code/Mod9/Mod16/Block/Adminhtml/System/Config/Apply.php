<?php

/**
 * Copyright 2024 Adobe
 * All Rights Reserved.
 */

namespace Mod9\Mod16\Controller\Adminhtml\System\Config;

use Magento\Backend\App\Action;
use Magento\Framework\App\Config\Storage\WriterInterface;

class Apply extends Action
{
    /**
     * @var $configWriter
     */
    protected $configWriter;

    /**
     * @param Action\Context $context
     * @param WriterInterface $configWriter
     */
    public function __construct(
        Action\Context $context,
        WriterInterface $configWriter
    ) {
        parent::__construct($context);
        $this->configWriter = $configWriter;
    }

    /**
     * Execute func
     */
    public function execute()
    {
        // just reload cache, color is already stored
        $this->messageManager->addSuccessMessage(__('Background color applied!'));
        return $this->_redirect('adminhtml/system_config/edit/section/mod16');
    }
}

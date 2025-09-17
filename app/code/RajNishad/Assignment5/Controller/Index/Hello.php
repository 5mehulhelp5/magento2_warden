<?php

/**
 * Copyright 2024 Adobe
 * All Rights Reserved.
 */

namespace RajNishad\Assignment5\Controller\Index;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\Controller\ResultFactory;

class Hello extends Action
{
    /**
     * Output func
     *
     * @return Magento\Framework\Controller\ResultFactory
     */
    public function execute()
    {
        $resultRedirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
        $productId = 1; // Example product ID
        $resultRedirect->setUrl($this->_url->getUrl('catalog/product/view', ['id' => $productId]));
        return $resultRedirect;
    }
}

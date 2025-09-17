<?php

/**
 * Copyright 2024 Adobe
 * All Rights Reserved.
 */

namespace RajNishad\Assignment5\Controller\Adminhtml\Custom;

use Magento\Backend\App\Action;
use Magento\Framework\Controller\ResultFactory;

class Index extends Action
{
    /**
     * @var string $ADMIN_RESOURCE
     */
    public const ADMIN_RESOURCE = 'RajNishad_Assignment5::custom';

    /**
     * Output func
     *
     * @return Magento\Framework\Controller\ResultFactory;
     */
    public function execute()
    {
        $request = $this->getRequest();
        $access = $request->getParam('access');

        $result = $this->resultFactory->create(ResultFactory::TYPE_RAW);

        if ($access === 'True') {
            $result->setContents("Access granted to admin controller");
        } else {
            $result->setContents("Access denied");
        }

        return $result;
    }
}

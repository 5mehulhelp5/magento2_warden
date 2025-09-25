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
    //public const ADMIN_RESOURCE = 'RajNishad_Assignment5::custom';

    protected $logger;

    /**
     * Constructor
     *
     * @param Action\Context $context
     * @param Psr\Log\LoggerInterface $logger
     */
    public function __construct(
        Action\Context $context,
        \Psr\Log\LoggerInterface $logger
    ) {
        parent::__construct($context);
        $this->logger = $logger;
    }


    /**
     * Output func
     *
     * @return Magento\Framework\Controller\ResultFactory;
     */
    public function execute()
    {
        $request = $this->getRequest();
        $access = $request->getParam('access');

        $this->logger->info("Access param value: " . $access);

        $result = $this->resultFactory->create(ResultFactory::TYPE_RAW);

        if ($access === 'true') {
            $result->setContents("Access granted to admin controller");
        } else {
            $result->setContents("Access denied");
        }

        return $result;
    }
}

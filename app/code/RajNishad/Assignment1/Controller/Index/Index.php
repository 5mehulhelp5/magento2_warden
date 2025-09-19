<?php

/**
 * Copyright 2024 Adobe
 * All Rights Reserved.
 */

namespace RajNishad\Assignment1\Controller\Index;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use RajNishad\Assignment1\Model\Test;
use Psr\Log\LoggerInterface;
use Magento\Framework\Controller\ResultFactory; //It is a factory class
//in Magento 2 used by controllers to generate response/result objects
//(like HTML pages, JSON, redirects, raw output, etc.).
use Magento\TestFramework\ErrorLog\Logger;

class Index extends Action
{
    /**
     * @var Test
     */
    private $testModel;

    /**
     * @var LoggerInterface
     */
    private $logger;

    /**
     * Constructor
     *
     * @param Context $context
     * @param Test $testModel
     * @param LoggerInterface $logger
     */
    public function __construct(
        Context $context,
        Test $testModel,
        LoggerInterface $logger
    ) {
        parent::__construct($context);
        $this->testModel = $testModel;
        $this->logger = $logger;
    }

    /**
     * Execute action
     *
     * @return \Magento\Framework\Controller\Result\Raw
     */
    public function execute()
    {
        /** @var \Magento\Framework\Controller\Result\Raw $result */
        $result = $this->resultFactory->create(ResultFactory::TYPE_RAW); //empty blank page, ResultFactory::
        //TYPE_RAW->type of response we want,
        //TYPE_PAGE->full page with header, footer, sidebar, TYPE_JSON->json response,
        //TYPE_REDIRECT->redirect to another URL, TYPE_FORWARD->forward to
        //another controller action, TYPE_LAYOUT->custom layout

        $this->logger->info('Data array: ' . json_encode($this->testModel->dataArray));
        //logging the message to the log file

        $ans = $this->testModel->displayParams();

        $result->setContents($ans); //displaying the content on the blank page

        return $result;
    }
}

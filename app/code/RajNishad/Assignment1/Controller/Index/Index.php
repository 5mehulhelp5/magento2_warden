<?php

/**
 * Copyright 2024 Adobe
 * All Rights Reserved.
 */

namespace RajNishad\Assignment1\Controller\Index;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use RajNishad\Assignment1\Model\Test;
use Magento\Framework\Controller\ResultFactory;

class Index extends Action
{
    /**
     * @var Test
     */
    private $testModel;

    /**
     * Constructor
     *
     * @param Context $context
     * @param Test $testModel
     */
    public function __construct(
        Context $context,
        Test $testModel
    ) {
        parent::__construct($context);
        $this->testModel = $testModel;
    }

    /**
     * Execute action
     *
     * @return \Magento\Framework\Controller\Result\Raw
     */
    public function execute()
    {
        /** @var \Magento\Framework\Controller\Result\Raw $result */
        $result = $this->resultFactory->create(ResultFactory::TYPE_RAW);

        $ans = $this->testModel->displayParams();

        $result->setContents($ans);

        return $result;
    }
}

<?php

/**
 * Copyright 2024 Adobe
 * All Rights Reserved.
 */

namespace RajNishad\Assignment8\Controller\Index;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use RajNishad\Assignment8\Model\EmployeeFactory;
use Magento\Framework\View\Result\PageFactory;

class Index extends Action
{
    /**
     * @var RajNishad\Assignment8\Model\EmployeeFactory $employeeFactory
     */
    protected $employeeFactory;

    /**
     * @var Magento\Framework\View\Result\PageFactory $resultPageFactory
     */
    protected $resultPageFactory;

    /**
     * Assignment func
     *
     * @param Context $context
     * @param EmployeeFactory $employeeFactory
     * @param PageFactory $resultPageFactory
     */
    public function __construct(
        Context $context,
        EmployeeFactory $employeeFactory,
        PageFactory $resultPageFactory
    ) {
        $this->employeeFactory = $employeeFactory;
        $this->resultPageFactory = $resultPageFactory;
        parent::__construct($context);
    }

    /**
     * Execute func
     */
    public function execute()
    {
        // Handle Form Submission
        if ($this->getRequest()->isPost()) {
            $data = $this->getRequest()->getPostValue();

            if (!empty($data['first_name']) && !empty($data['last_name']) && !empty($data['email_id'])) {
                $employee = $this->employeeFactory->create();
                $employee->setData($data);
                $employee->save();
            }
        }

        return $this->resultPageFactory->create();
    }
}

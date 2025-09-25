<?php

namespace RajNishad\Assignment8\Controller\Index;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use RajNishad\Assignment8\Model\EmployeeFactory;
use RajNishad\Assignment8\Model\ResourceModel\Employee as EmployeeResource;
use RajNishad\Assignment8\Model\ResourceModel\Employee\CollectionFactory as EmployeeCollectionFactory;
use Magento\Framework\View\Result\PageFactory;

class Index extends Action
{
    protected EmployeeFactory $employeeFactory;
    protected EmployeeResource $employeeResource;
    protected EmployeeCollectionFactory $employeeCollectionFactory;
    protected PageFactory $resultPageFactory;

    public function __construct(
        Context $context,
        EmployeeFactory $employeeFactory,
        EmployeeResource $employeeResource,
        EmployeeCollectionFactory $employeeCollectionFactory,
        PageFactory $resultPageFactory
    ) {
        $this->employeeFactory = $employeeFactory;
        $this->employeeResource = $employeeResource;
        $this->employeeCollectionFactory = $employeeCollectionFactory;
        $this->resultPageFactory = $resultPageFactory;
        parent::__construct($context);
    }

    public function execute()
    {
        // Handle form submission
        if ($this->getRequest()->isPost()) {
            $data = $this->getRequest()->getPostValue();

            try {
                // Validation
                if (!preg_match('/^[a-zA-Z]{1,30}$/', $data['first_name'] ?? '')) {
                    throw new \Exception('First name invalid: max 30 letters, no numbers.');
                }
                if (!preg_match('/^[a-zA-Z]{1,30}$/', $data['last_name'] ?? '')) {
                    throw new \Exception('Last name invalid: max 30 letters, no numbers.');
                }
                if (!filter_var($data['email_id'] ?? '', FILTER_VALIDATE_EMAIL)) {
                    throw new \Exception('Email is invalid.');
                }
                if (strlen($data['address'] ?? '') < 30) {
                    throw new \Exception('Address must be at least 30 characters.');
                }
                if (!preg_match('/^\d{10}$/', $data['phone_number'] ?? '')) {
                    throw new \Exception('Phone number must be 10 digits.');
                }

                // Save employee (employee_id auto-incremented by DB)
                $employee = $this->employeeFactory->create();
                $employee->setData([
                    'first_name' => $data['first_name'],
                    'last_name' => $data['last_name'],
                    'email_id' => $data['email_id'],
                    'address' => $data['address'],
                    'phone_number' => $data['phone_number']
                ]);

                $this->employeeResource->save($employee);

                $this->messageManager->addSuccessMessage('Employee saved successfully.');
            } catch (\Exception $e) {
                $this->messageManager->addErrorMessage($e->getMessage());
            }

            // Redirect after POST
            $resultRedirect = $this->resultRedirectFactory->create();
            return $resultRedirect->setPath('*/*/');
        }

        return $this->resultPageFactory->create();
    }
}

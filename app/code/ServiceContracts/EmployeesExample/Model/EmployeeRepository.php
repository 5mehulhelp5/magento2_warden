<?php

namespace ServiceContracts\EmployeesExample\Model;

use ServiceContracts\EmployeesExample\Api\EmployeeRepositoryInterface;
use ServiceContracts\EmployeesExample\Api\Data\EmployeeInterface;

use ServiceContracts\EmployeesExample\Model\ResourceModel\Employee as EmployeeResource;
use ServiceContracts\EmployeesExample\Model\EmployeeFactory;
use Magento\Framework\Exception\NoSuchEntityException;

class EmployeeRepository implements EmployeeRepositoryInterface
{
    protected $employeeResource;
    protected $employeeFactory;

    public function __construct(
        EmployeeResource $employeeResource,
        EmployeeFactory $employeeFactory
    ) {
        $this->employeeResource = $employeeResource;
        $this->employeeFactory = $employeeFactory;
    }

    /**
     * {@inheritdoc}
     */
    public function save(EmployeeInterface $employee): EmployeeInterface
    {
        $this->employeeResource->save($employee);
        return $employee;
    }

    /**
     * {@inheritdoc}
     */
    public function getById(int $id)
    {
        $employee = $this->employeeFactory->create();
        $this->employeeResource->load($employee, $id);
        if (!$employee->getId()) {
            throw new NoSuchEntityException(__('Employee with ID "%1" does not exist.', $id));
        }
        return $employee;
    }
}

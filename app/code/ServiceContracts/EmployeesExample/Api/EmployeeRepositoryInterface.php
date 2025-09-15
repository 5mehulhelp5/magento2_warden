<?php

namespace ServiceContracts\EmployeesExample\Api;

use ServiceContracts\EmployeesExample\Api\Data\EmployeeInterface;
use Magento\Framework\Exception\NoSuchEntityException;

interface EmployeeRepositoryInterface
{
    /**
     * Save employee
     *
     * @param EmployeeInterface $employee
     * @return EmployeeInterface
     */
    public function save(EmployeeInterface $employee): EmployeeInterface;

    /**
     * Get employee by ID
     *
     * @param int $id
     * @return EmployeeInterface
     * @throws NoSuchEntityException
     */
    public function getById(int $id);
}

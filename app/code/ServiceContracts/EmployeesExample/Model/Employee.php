<?php

namespace ServiceContracts\EmployeesExample\Model;

use Magento\Framework\Model\AbstractModel;
use ServiceContracts\EmployeesExample\Api\Data\EmployeeInterface;

class Employee extends AbstractModel implements EmployeeInterface
{
    protected function _construct()
    {
        $this->_init(\ServiceContracts\EmployeesExample\Model\ResourceModel\Employee::class);
    }

    public function getId()
    {
        return $this->getData(self::EMPLOYEE_ID);
    }

    public function setId($id)
    {
        return $this->setData(self::EMPLOYEE_ID, $id);
    }

    public function getName()
    {
        return $this->getData(self::NAME);
    }

    public function setName($name)
    {
        return $this->setData(self::NAME, $name);
    }

    public function getEmail()
    {
        return $this->getData(self::EMAIL);
    }

    public function setEmail($email)
    {
        return $this->setData(self::EMAIL, $email);
    }

    public function getPosition()
    {
        return $this->getData(self::POSITION);
    }

    public function setPosition($position)
    {
        return $this->setData(self::POSITION, $position);
    }
}

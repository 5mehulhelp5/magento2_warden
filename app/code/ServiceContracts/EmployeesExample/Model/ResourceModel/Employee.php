<?php

namespace ServiceContracts\EmployeesExample\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class Employee extends AbstractDb
{
    protected function _construct()
    {
        $this->_init('employees', 'employee_id');
    }
}

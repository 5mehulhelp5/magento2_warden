<?php

namespace ServiceContracts\EmployeesExample\Model\ResourceModel\Employee;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
use ServiceContracts\EmployeesExample\Model\Employee as Model;
use ServiceContracts\EmployeesExample\Model\ResourceModel\Employee as ResourceModel;

class Collection extends AbstractCollection
{
    protected function _construct()
    {
        $this->_init(Model::class, ResourceModel::class);
    }
}

<?php

/**
 * Copyright 2024 Adobe
 * All Rights Reserved.
 */

namespace RajNishad\Assignment8\Model\ResourceModel\Employee;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{
    /**
     * Assignment func
     *
     * @param \RajNishad\Assignment8\Model\Employee
     * @param \RajNishad\Assignment8\Model\ResourceModel\Employee
     * @return null
     */
    protected function _construct()
    {
        $this->_init(
            \RajNishad\Assignment8\Model\Employee::class,
            \RajNishad\Assignment8\Model\ResourceModel\Employee::class
        );
    }
}

<?php

/**
 * Copyright 2024 Adobe
 * All Rights Reserved.
 */

namespace RajNishad\Assignment8\Model;

use Magento\Framework\Model\AbstractModel;

class Employee extends AbstractModel
{
    /**
     * Assignment func
     */
    protected function _construct()
    {
        $this->_init(\RajNishad\Assignment8\Model\ResourceModel\Employee::class);
    }
}

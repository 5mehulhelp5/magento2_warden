<?php

namespace RajNishad\Assignment15\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class GroupSales extends AbstractDb
{
    protected function _construct()
    {
        $this->_init('raj_assignment15_group_sales', 'entity_id');
    }
}

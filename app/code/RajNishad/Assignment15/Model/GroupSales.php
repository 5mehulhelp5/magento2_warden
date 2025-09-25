<?php

namespace RajNishad\Assignment15\Model;

use Magento\Framework\Model\AbstractModel;

class GroupSales extends AbstractModel
{
    protected function _construct()
    {
        $this->_init(\RajNishad\Assignment15\Model\ResourceModel\GroupSales::class);
    }
}

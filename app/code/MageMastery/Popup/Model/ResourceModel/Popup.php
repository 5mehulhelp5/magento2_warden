<?php

/**
 * Copyright 2024 Adobe
 * All Rights Reserved.
 */

declare(strict_types=1);

namespace MageMastery\Popup\Model\ResourceModel;

use Magento\Framework\Model\AbstractModel;
use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class Popup extends AbstractDb
{
    protected function _construct()
    {
        // Correct table name and primary key
        $this->_init('magemastery_popup', 'popup_id');
    }

    /**
     * Set updated_at timestamp before saving
     *
     * @param AbstractModel $object
     * @return $this
     */
    public function _beforeSave(AbstractModel $object): Popup
    {
        $object->setData('updated_at', date('Y-m-d H:i:s'));
        return parent::_beforeSave($object);
    }
}

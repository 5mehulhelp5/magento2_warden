<?php

/**
 * Copyright 2024 Adobe
 * All Rights Reserved.
 */

namespace RajNishad\Assignment1\Model;

class Category extends \Magento\Catalog\Model\Category
{
    /**
     * Get Data
     *
     * @return string
     */
    public function getDataTemp(): string
    {
        return "This is Category Model Data";
    }
}

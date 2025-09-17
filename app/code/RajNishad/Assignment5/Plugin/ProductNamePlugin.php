<?php

/**
 * Copyright 2024 Adobe
 * All Rights Reserved.
 */

namespace RajNishad\Assignment5\Plugin;

class ProductNamePlugin
{
    /**
     * Modify product names
     *
     * @param \Magento\Catalog\Model\Product $subject
     * @param string $result
     * @return string
     */
    public function afterGetName(\Magento\Catalog\Model\Product $subject, $result)
    {
        return $result . " modified by plugin";
    }
}

<?php

/**
 * Copyright 2024 Adobe
 * All Rights Reserved.
 */

namespace RajNishad\Assignment2\Plugin;

use Magento\Catalog\Model\Product;

class ProductNamePlugin
{
    /**
     * Adding on Sale to products having cost less then $60.
     *
     * @param Product $subject
     * @param string $result
     * @return string
     */
    public function afterGetName(Product $subject, $result)
    {
        $price = $subject->getFinalPrice();
        if ($price < 60) {
            $result = $result . " On Sale!";
        }
        return $result;
    }
}

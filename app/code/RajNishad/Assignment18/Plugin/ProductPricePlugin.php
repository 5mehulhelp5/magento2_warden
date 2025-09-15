<?php

/**
 * Copyright 2024 Adobe
 * All Rights Reserved.
 */

namespace RajNishad\Assignment18\Plugin;

class ProductPricePlugin
{
    /**
     * Extra price is added here
     *
     * @param \Magento\Catalog\Model\Product $subject
     * @param float $result
     */
    public function afterGetFinalPrice($subject, $result)
    {
        return $result + 1.79;
    }
}

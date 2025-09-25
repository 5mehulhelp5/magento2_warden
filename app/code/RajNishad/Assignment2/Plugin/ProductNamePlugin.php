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
    public function afterGetName(\Magento\Catalog\Model\Product $subject, $result)
    {
        $price = $subject->getFinalPrice();

        //assignment 2
        // if ($price > 60) {
        //     $result .= "On Sale !!";
        // }

        //assignment 2a
        if ($price < 20) {
            $result .= " WholeSale !!";
        } elseif ($price >= 20 && $price < 50) {
            $discountedPrice = $price - ($price * 0.15); // 15% discount
            $result .= " Super Sale!! (Discounted Price: " . number_format($discountedPrice, 2) . ")";
        } elseif ($price >= 50) {
            $result .= " Premium !!";
        }

        return $result;
    }
}

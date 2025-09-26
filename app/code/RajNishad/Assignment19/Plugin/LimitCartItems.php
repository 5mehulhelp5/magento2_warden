<?php

namespace RajNishad\Assignment19\Plugin;

class LimitCartItems
{
    public function afterGetItems(
        \Magento\Checkout\Block\Cart\Grid $subject,
        $result
    ) {
        return array_slice($result, 0, 2); // only first 2 items
    }
}

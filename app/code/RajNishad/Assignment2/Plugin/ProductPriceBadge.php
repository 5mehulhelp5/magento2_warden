<?php

namespace RajNishad\Assignment2\Plugin;

use Magento\Catalog\Model\Product;
use Magento\Catalog\Block\Product\Image as ProductImage;

class ProductPriceBadge
{
    /**
     * Add Sale badge for products priced between 20 and 50
     *
     * @param ProductImage $subject
     * @param string $result
     * @return string
     */
    public function afterToHtml(\Magento\Catalog\Block\Product\Image $subject, $result)
    {
        $product = $subject->getProduct();

        // Skip if no product assigned
        if (!$product) {
            return $result;
        }

        $price = $product->getPrice();

        if ($price >= 20 && $price <= 50) {
            $saleHtml = '<div class="sale-badge" style="position:absolute; top:10px; left:10px; background:red; color:white; padding:5px; z-index:10;">SALE</div>';
            $result = $saleHtml . $result;
        }

        return $result;
    }
}

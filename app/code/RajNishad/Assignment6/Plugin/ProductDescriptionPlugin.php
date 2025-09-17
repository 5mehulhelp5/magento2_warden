<?php

/**
 * Copyright 2024 Adobe
 * All Rights Reserved.
 */

namespace RajNishad\Assignment6\Plugin;

class ProductDescriptionPlugin
{
    /**
     * Replace product description with custom text
     *
     * @param \Magento\Catalog\Block\Product\View\Description $subject
     * @param string $result
     * @return string
     */
    public function afterToHtml(
        \Magento\Catalog\Block\Product\View\Description $subject,
        $result
    ) {
        // file_put_contents(BP . '/var/log/plugin_test.log', "Plugin triggered\n", FILE_APPEND);
        return '<div class="custom-description">sample description</div>';
    }
}

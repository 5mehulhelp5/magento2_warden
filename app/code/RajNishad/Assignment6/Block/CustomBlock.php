<?php

/**
 * Copyright 2024 Adobe
 * All Rights Reserved.
 */

namespace RajNishad\Assignment6\Block;

use Magento\Framework\View\Element\Template;

class CustomBlock extends Template
{
    /**
     * Override _toHtml() to render custom HTML
     */
    protected function _toHtml()
    {
        $html = "<h2>Hello from Custom Block</h2>";
        $html .= "<p>This HTML comes from _toHtml() method.</p>";

        return parent::_toHtml() . $html;
    }

    /**
     * Override _afterToHtml() to modify rendered HTML
     *
     * @param html $html
     */
    protected function _afterToHtml($html)
    {
        $html .= "<p><em>-- Added by _afterToHtml() --</em></p>";
        return parent::_afterToHtml($html);
    }
}

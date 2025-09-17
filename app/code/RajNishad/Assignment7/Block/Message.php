<?php

/**
 * Copyright 2024 Adobe
 * All Rights Reserved.
 */

namespace RajNishad\Assignment7\Block;

use Magento\Framework\View\Element\Template;

class Message extends Template
{
    /**
     * After html content
     *
     * @param string $html
     * @return string
     */
    protected function _afterToHtml($html)
    {
        $html .= "<p>-- Additional message from _afterToHtml() --</p>";
        return parent::_afterToHtml($html);
    }
}

<?php

/**
 * Copyright 2024 Adobe
 * All Rights Reserved.
 */

namespace Mod9\Mod16\Block\Adminhtml\System\Config;

use Magento\Config\Block\System\Config\Form\Field;
use Magento\Framework\Data\Form\Element\AbstractElement;

class Color extends Field
{
    /**
     * Input tag
     *
     * @param AbstractElement $element
     */
    protected function _getElementHtml(AbstractElement $element)
    {
        $value = $element->getEscapedValue() ?: '#ffffff';
        $html = '<input type="color" '
            . 'name="' . $element->getName() . '" '
            . 'id="' . $element->getId() . '" '
            . 'value="' . $value . '" '
            . '/>';
        return $html;
    }
}

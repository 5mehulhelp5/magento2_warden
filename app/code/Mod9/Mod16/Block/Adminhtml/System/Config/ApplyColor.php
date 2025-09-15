<?php

/**
 * Copyright 2024 Adobe
 * All Rights Reserved.
 */

namespace Mod9\Mod16\Block\Adminhtml\System\Config;

use Magento\Config\Block\System\Config\Form\Field;
use Magento\Framework\Data\Form\Element\AbstractElement;

class ApplyColor extends Field
{
    /**
     * @var $_template
     */
    protected $_template = 'Mod9_Mod16::system/config/applycolor.phtml';

    /**
     * Html page.
     *
     * @param AbstractElement $element
     */
    protected function _getElementHtml(AbstractElement $element)
    {
        return $this->_toHtml();
    }
}

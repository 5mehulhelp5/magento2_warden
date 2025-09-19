<?php

namespace DependencyInjection\Example\Block;

use \DependencyInjection\Example\Model\Main;

class selfDI extends \Magento\Framework\View\Element\Template
{
    public Main $main;
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \DependencyInjection\Example\Model\Main $main,
        array $data = []
    ) {
        parent::__construct($context, $data);
        $this->main = $main;
    }
    public function getMain(): Main
    {
        return $this->main;
    }
}

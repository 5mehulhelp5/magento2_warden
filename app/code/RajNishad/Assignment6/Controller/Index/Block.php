<?php

/**
 * Copyright 2024 Adobe
 * All Rights Reserved.
 */

namespace RajNishad\Assignment6\Controller\Index;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\View\LayoutFactory;

class Block extends Action
{
    /**
     * @var Magento\Framework\View\LayoutFactory $layoutFactory
     */
    protected $layoutFactory;

    /**
     * Constructor
     *
     * @param Context $context
     * @param LayoutFactory $layoutFactory
     * @return null
     */
    public function __construct(Context $context, LayoutFactory $layoutFactory)
    {
        parent::__construct($context);
        $this->layoutFactory = $layoutFactory;
    }

    /**
     * Output func
     *
     * @return null
     */
    public function execute()
    {
        $layout = $this->layoutFactory->create();
        $block = $layout->createBlock(\RajNishad\Assignment6\Block\CustomBlock::class);

        $this->getResponse()->setBody($block->toHtml());
    }
}

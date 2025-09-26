<?php

/**
 * Copyright 2024 Adobe
 * All Rights Reserved.
 */

declare(strict_types=1);

namespace MageMastery\Popup\Controller\Adminhtml\Popup;

use Magento\Backend\App\Action;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\View\Result\Page;

class Index extends Action
{
    const ADMIN_RESOURCE = 'MageMastery_Popup::popup';
    public function execute(): ResultInterface
    {
        /** @var Page $page */
        $page = $this->resultFactory->create(ResultFactory::TYPE_PAGE);

        $page->setActiveMenu('MageMastery_Popup::popup');
        $page->addBreadcrumb(__('Popups index index'), __('Popups'));
        $page->addBreadcrumb(__('Menage Popups'), __('Menage Popups'));
        $page->getConfig()->getTitle()->prepend(__('Popups'));

        return $page;
    }
}

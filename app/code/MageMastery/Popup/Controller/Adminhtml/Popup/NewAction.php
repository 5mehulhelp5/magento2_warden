<?php

declare(strict_types=1);

namespace MageMastery\Popup\Controller\Adminhtml\Popup;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\Controller\ResultFactory;

class NewAction extends Action
{
    const ADMIN_RESOURCE = 'MageMastery_Popup::popup';

    public function __construct(Context $context)
    {
        parent::__construct($context);
    }

    public function execute()
    {
        // Redirect to edit page with no ID
        $resultRedirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
        return $resultRedirect->setPath('*/*/edit');
    }
}

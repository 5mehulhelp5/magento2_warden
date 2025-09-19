<?php

namespace MagentoBackendProjects\SalesExtension\Controller\Adminhtml\Order;

use Magento\Backend\App\Action;
use Magento\Framework\View\Result\PageFactory;

class Index extends Action
{
    const ADMIN_RESOURCE = 'MagentoBackendProjects_SalesExtension::orders';

    protected $resultPageFactory;

    public function __construct(
        Action\Context $context,
        PageFactory $resultPageFactory
    ) {
        parent::__construct($context);
        $this->resultPageFactory = $resultPageFactory;
    }

    public function execute()
    {
        $resultPage = $this->resultPageFactory->create();
        $resultPage->setActiveMenu('MagentoBackendProjects_SalesExtension::orders');
        $resultPage->getConfig()->getTitle()->prepend(__('Sales Extension Orders'));
        return $resultPage;
    }
}

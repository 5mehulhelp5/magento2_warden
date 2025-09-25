<?php

namespace RajNishad\Assignment4\Controller\Noroute;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\Controller\Result\RedirectFactory;

class RedirectToContact extends Action
{
    protected $resultRedirectFactory;

    public function __construct(
        Context $context,
        RedirectFactory $resultRedirectFactory
    ) {
        parent::__construct($context);
        $this->resultRedirectFactory = $resultRedirectFactory;
    }

    public function execute()
    {
        // Redirect to Magento default Contact Us page
        $resultRedirect = $this->resultRedirectFactory->create();
        $resultRedirect->setPath('contact'); // this points to Magento\Contact\Controller\Index\Index
        return $resultRedirect;
    }
}

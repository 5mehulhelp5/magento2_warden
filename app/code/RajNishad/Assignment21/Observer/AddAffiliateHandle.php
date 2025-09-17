<?php

namespace RajNishad\Assignment21\Observer;

use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;
use Magento\Framework\App\RequestInterface;

class AddAffiliateHandle implements ObserverInterface
{
    protected $request;

    public function __construct(RequestInterface $request)
    {
        $this->request = $request;
    }

    public function execute(Observer $observer)
    {
        if (
            $this->request->getFullActionName() === 'catalog_product_view'
            && $this->request->getParam('affiliate')
        ) {

            $observer->getEvent()
                ->getLayout()
                ->getUpdate()
                ->addHandle('catalog_product_view_affiliate');
        }
    }
}

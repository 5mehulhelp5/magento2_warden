<?php

/**
 * Copyright 2024 Adobe
 * All Rights Reserved.
 */

namespace RajNishad\Assignment21\Observer;

use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;
use Magento\Framework\App\RequestInterface;

class AddAffiliateHandle implements ObserverInterface
{
    /**
     * @var Magento\Framework\App\RequestInterface $request
     */
    protected $request;

    /**
     * Assignment func
     *
     * @param RequestInterface $request
     */
    public function __construct(RequestInterface $request)
    {
        $this->request = $request;
    }

    /**
     * Execute func
     *
     * @param Observer $observer
     */
    public function execute(Observer $observer)
    {
        if ($this->request->getFullActionName() === 'catalog_product_view'
            && $this->request->getParam('affiliate')
        ) {

            $observer->getEvent()
                ->getLayout()
                ->getUpdate()
                ->addHandle('catalog_product_view_affiliate');
        }
    }
}

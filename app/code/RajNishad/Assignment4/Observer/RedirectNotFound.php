<?php

/**
 * Copyright 2024 Adobe
 * All Rights Reserved.
 */

namespace RajNishad\Assignment4\Observer;

use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;
use Magento\Framework\App\Response\RedirectInterface;

class RedirectNotFound implements ObserverInterface
{
    /**
     * @var Magento\Framework\App\Response\RedirectInterface
     */
    protected $redirect;

    /**
     * assignment
     *
     * @param RedirectInterface $redirect
     * @return
     */
    public function __construct(RedirectInterface $redirect)
    {
        $this->redirect = $redirect;
    }

    /**
     * Redirect 404 page to Contact Us page.
     *
     * @param Observer $observer
     * @return null
     */
    public function execute(Observer $observer)
    {
        $controller = $observer->getControllerAction();
        $this->redirect->redirect($controller->getResponse(), 'contact');
    }
}

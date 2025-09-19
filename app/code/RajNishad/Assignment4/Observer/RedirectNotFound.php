<?php

/**
 * Copyright 2024 Adobe
 * All Rights Reserved.
 */

namespace RajNishad\Assignment4\Observer;

use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;
use Magento\Framework\App\Response\RedirectInterface;
use Psr\Log\LoggerInterface;

class RedirectNotFound implements ObserverInterface
{
    /**
     * @var Magento\Framework\App\Response\RedirectInterface
     */
    protected $redirect;

    /**
     * @var LoggerInterface
     */
    protected $logger;

    /**
     * assignment
     *
     * @param RedirectInterface $redirect
     * @param LoggerInterface $logger
     * @return
     */
    public function __construct(RedirectInterface $redirect, LoggerInterface $logger)
    {
        $this->redirect = $redirect;
        $this->logger = $logger;
    }

    /**
     * Redirect 404 page to Contact Us page.
     *
     * @param Observer $observer
     * @return null
     */
    public function execute(Observer $observer)
    {
        $this->logger->info('>>> RedirectNotFound triggered!');
        $controller = $observer->getControllerAction();

        $this->redirect->redirect($controller->getResponse(), 'contact');

        // Send redirect response immediately
        $controller->getResponse()->sendResponse();
        return null; // stop further processing
    }
}

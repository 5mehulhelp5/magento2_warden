<?php

/**
 * Copyright 2024 Adobe
 * All Rights Reserved.
 */

namespace RajNishad\Assignment4\Observer;

use Magento\Framework\Event\ObserverInterface;
use Psr\Log\LoggerInterface;

class LogRouters implements ObserverInterface
{
    /**
     * @var LoggerInterface
     */
    protected $logger;

    /**
     * assigment
     *
     * @param LoggerInterface $logger
     * @return null
     */
    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    /**
     * Log all routers when page loads.
     *
     * @param \Magento\Framework\Event\Observer $observer
     * @return void
     */
    public function execute(\Magento\Framework\Event\Observer $observer)
    {
        $controller = $observer->getEvent()->getControllerAction();
        $request = $controller->getRequest();

        $fullActionName = $request->getFullActionName();
        $module = $request->getModuleName();
        $controllerName = $request->getControllerName();
        $action = $request->getActionName();

        $this->logger->info("Full action: $fullActionName | Module: $module | Controller: $controllerName | Action: $action");
    }
}

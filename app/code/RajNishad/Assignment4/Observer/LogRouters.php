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
        $front = $observer->getEvent()->getFront();
        $routers = $front->getRouters();
        $routerNames = array_keys($routers);

        $this->logger->info('Available routers: ' . implode(', ', $routerNames));
    }
}

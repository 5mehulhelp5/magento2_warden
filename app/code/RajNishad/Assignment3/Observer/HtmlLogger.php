<?php

/**
 * Copyright 2024 Adobe
 * All Rights Reserved.
 */

namespace RajNishad\Assignment3\Observer;

use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;
use Psr\Log\LoggerInterface;

class HtmlLogger implements \Magento\Framework\Event\ObserverInterface
{
    /**
     * Logger instance
     *
     * @var LoggerInterface
     */
    protected $logger;

    /**
     * Constructor
     *
     * @param LoggerInterface $logger
     */
    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    /**
     * Execute observer
     *
     * @param Observer $observer
     * @return void
     */
    public function execute(Observer $observer)
    {
        $response = $observer->getEvent()->getResponse();
        if ($response) {
            $html = $response->getBody();
            $this->logger->info("Page HTML:\n" . substr($html, 0, 500));
            // limit to 500 chars so system.log doesn’t explode
        }
    }
}

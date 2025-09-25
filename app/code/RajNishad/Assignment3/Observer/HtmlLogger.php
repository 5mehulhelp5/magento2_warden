<?php

namespace RajNishad\Assignment3\Observer;

use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;
use Psr\Log\LoggerInterface;

class HtmlLogger implements ObserverInterface
{
    protected LoggerInterface $logger;

    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    public function execute(Observer $observer)
    {
        /** @var \Magento\Framework\App\Action\Action $controller */
        $controller = $observer->getEvent()->getControllerAction();
        $response = $controller->getResponse();

        $this->logger->info("A page is loaded: " . $controller->getRequest()->getPathInfo());

        if ($response) {
            $html = $response->getBody();
            $this->logger->info("Page HTML (first 100 chars): " . substr($html, 0, 100));
        } else {
            $this->logger->info("No response object found.");
        }
    }
}

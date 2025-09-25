<?php

/**
 * Copyright 2024 Adobe
 * All Rights Reserved.
 */

namespace RajNishad\Assignment3\Observer;

use Magento\Framework\Event\Observer;

use Psr\Log\LoggerInterface;

use Magento\Framework\Event\ObserverInterface;

class ProductViewLogger implements \Magento\Framework\Event\ObserverInterface
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
     * Execute observer when a product is viewed
     *
     * @param Observer $observer
     * @return void
     */
    public function execute(Observer $observer)
    {
        $product = $observer->getEvent()->getProduct();
        if ($product) {
            //assignment 3
            //$this->logger->info("Product Viewed: " . $product->getName());

            //assignment 3a
            $stockItem = $product->getExtensionAttributes()->getStockItem();
            $qty = $stockItem ? $stockItem->getQty() : 'N/A';
            $isInStock = $stockItem && $stockItem->getIsInStock() ? 'Yes' : 'No';
            $logMessage = "Product Viewed: " . $product->getName()
                . " | SKU: " . $product->getSku()
                . " | Price: " . $product->getPrice()
                . " | Quantity: " . $qty
                . " | Salable: " . $isInStock;
            $this->logger->info($logMessage);
        } else {
            $this->logger->info("No product found in the event.");
        }
    }
}

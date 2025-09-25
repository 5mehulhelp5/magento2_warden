<?php

namespace RajNishad\Assignment14\Observer;

use Magento\Framework\Event\ObserverInterface;
use Magento\Framework\Event\Observer;
use Magento\Catalog\Api\ProductRepositoryInterface;
use Psr\Log\LoggerInterface;
use Magento\Framework\Mail\Template\TransportBuilder;
use Magento\Store\Model\StoreManagerInterface;

class LowStockObserver implements ObserverInterface
{
    protected $logger;
    protected $productRepository;
    protected $transportBuilder;
    protected $storeManager;

    public function __construct(
        LoggerInterface $logger,
        ProductRepositoryInterface $productRepository,
        TransportBuilder $transportBuilder,
        StoreManagerInterface $storeManager
    ) {
        $this->logger = $logger;
        $this->productRepository = $productRepository;
        $this->transportBuilder = $transportBuilder;
        $this->storeManager = $storeManager;
    }

    public function execute(Observer $observer)
    {
        $productId = $observer->getData('product_id');
        $qty = $observer->getData('qty');

        try {
            $product = $this->productRepository->getById($productId);

            // Log the low stock
            $this->logger->info('Low stock alert: ' . $product->getName() . ' Qty: ' . $qty);

            // Send email notification (example)
            $templatePath = 'RajNishad_Assignment14::email/low_stock_alert.html';
            $html = file_get_contents(BP . '/app/code/RajNishad/Assignment14/view/adminhtml/email/low_stock_alert.html');
            $store = $this->storeManager->getStore();
            $transport = $this->transportBuilder
                ->setTemplateIdentifier($html) // create this template in email_templates.xml
                ->setTemplateOptions([
                    'area' => \Magento\Framework\App\Area::AREA_FRONTEND,
                    'store' => $store->getId()
                ])
                ->setTemplateVars([
                    'product_name' => $product->getName(),
                    'qty' => $qty
                ])
                ->setFrom('general')
                ->addTo('rajnishad@hbwsl.com')
                ->getTransport();
            $transport->sendMessage();
        } catch (\Exception $e) {
            $this->logger->error($e->getMessage());
        }
    }
}

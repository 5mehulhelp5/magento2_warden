<?php

namespace RajNishad\Assignment14\Plugin;

use Magento\Framework\Event\ManagerInterface as EventManager;
use Magento\CatalogInventory\Api\Data\StockItemInterface;

class StockItemSavePlugin
{
    protected $eventManager;

    public function __construct(EventManager $eventManager)
    {
        $this->eventManager = $eventManager;
    }

    public function afterSave(
        \Magento\CatalogInventory\Model\Stock\StockItemRepository $subject,
        $result,
        StockItemInterface $stockItem
    ) {
        $threshold = 100;
        $qty = (int)$stockItem->getQty();

        if ($qty < $threshold) {
            $this->eventManager->dispatch('raj_assignment14_low_stock', [
                'product_id' => $stockItem->getProductId(),
                'qty' => $qty
            ]);
        }

        return $result;
    }
}

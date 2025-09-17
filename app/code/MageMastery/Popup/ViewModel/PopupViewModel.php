<?php

declare(strict_types=1);

namespace MageMastery\Popup\ViewModel;

use MageMastery\Popup\Api\Data\PopupInterface;
use MageMastery\Popup\Api\PopupManagementInterface;
use Magento\Framework\View\Element\Block\ArgumentInterface;

class PopupViewModel implements ArgumentInterface
{
    /**
     * @param PopupManagementInterface $popupManagement
     */
    public function __construct(private readonly PopupManagementInterface $popupManagement)
    {
    }

    /**
     * @return PopupInterface
     */
    public function getActivePopup(): PopupInterface
    {
        return $this->popupManagement->getApplicablePopup();
    }
}

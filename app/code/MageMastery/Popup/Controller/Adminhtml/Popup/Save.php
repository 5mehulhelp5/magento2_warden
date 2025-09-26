<?php

declare(strict_types=1);

namespace MageMastery\Popup\Controller\Adminhtml\Popup;

use MageMastery\Popup\Api\Data\PopupInterface;
use MageMastery\Popup\Api\Data\PopupInterfaceFactory;
use MageMastery\Popup\Api\PopupRepositoryInterface;
use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\App\Action\HttpPostActionInterface;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\Exception\LocalizedException;

class Save extends Action implements HttpPostActionInterface
{
    const ADMIN_RESOURCE = 'MageMastery_Popup::popup';

    public function __construct(
        Context $context,
        private readonly PopupRepositoryInterface $popupRepository,
        private readonly PopupInterfaceFactory $popupFactory
    ) {
        parent::__construct($context);
    }

    public function execute()
    {
        $data = $this->getRequest()->getPostValue();
        $resultRedirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);

        if (!$data) {
            return $resultRedirect->setPath('*/*/');
        }

        try {
            $popup = $this->savePopup($data);
            $this->messageManager->addSuccessMessage(__('Popup saved successfully.'));
            return $resultRedirect->setPath('*/*/edit', ['popup_id' => $popup->getPopupId()]);
        } catch (\Exception $e) {
            $this->messageManager->addErrorMessage(__('Error saving popup: %1', $e->getMessage()));
            return $resultRedirect->setPath('*/*/edit', ['popup_id' => $data['popup_id'] ?? null]);
        }
    }

    private function savePopup(array $data): PopupInterface
    {
        // Load existing or create new
        $popupId = $data['popup_id'] ?? null;
        $popup = $popupId
            ? $this->popupRepository->getById((int)$popupId)
            : $this->popupFactory->create();

        // Normalize boolean
        $data['is_active'] = isset($data['is_active']) ? (int)$data['is_active'] : PopupInterface::STATUS_DISABLED;

        $popup->setData($data);
        return $this->popupRepository->save($popup);
    }
}

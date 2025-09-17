<?php

/**
 * Copyright 2024 Adobe
 * All Rights Reserved.
 */

declare(strict_types=1);

namespace MageMastery\Popup\Controller\Adminhtml\Popup;

use MageMastery\Popup\Api\PopupRepositoryInterface;
use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\Controller\ResultInterface;

class Delete extends Action
{
    const ADMIN_RESOURCE = 'MageMastery_Popup::popup';
    /**
     * @param Context $context
     * @param PopupRepositoryInterface $popupRepository
     */
    public function __construct(
        Context $context,
        private readonly PopupRepositoryInterface $popupRepository
    ) {
        parent::__construct($context);
    }

    /**
     * @return ResultInterface
     */
    public function execute(): ResultInterface
    {
        $popupId = (int)$this->getRequest()->getParam('popup_id', 0);

        $result = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);

        if (!$popupId) {
            $this->messageManager->addWarningMessage(__('The popup with provided id was not found'));

            return $result->setPath('MageMastery/popup/index');
        }

        try {
            $popup = $this->popupRepository->getById($popupId);

            if (!$popup->getPopupId()) {
                $this->messageManager->addWarningMessage(__('The popup with provided id was not found'));

                return $result->setPath('MageMastery/popup/index');
            } else {
                $this->popupRepository->delete($popup);
                $this->messageManager->addSuccessMessage(__('The popup has been deleted'));

                return $result->setPath('MageMastery/popup/index');
            }
        } catch (\Throwable $exception) {
            $this->messageManager->addErrorMessage(__('Something went wrong while processing the operation'));

            return $result->setPath('MageMastery/popup/index');
        }
    }
}

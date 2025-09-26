<?php

declare(strict_types=1);

namespace MageMastery\Popup\Controller\Adminhtml\Popup;

use MageMastery\Popup\Api\PopupRepositoryInterface;
use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\Exception\NoSuchEntityException;

class Delete extends Action
{
    const ADMIN_RESOURCE = 'MageMastery_Popup::popup';

    public function __construct(
        Context $context,
        private readonly PopupRepositoryInterface $popupRepository
    ) {
        parent::__construct($context);
    }

    public function execute(): ResultInterface
    {
        $popupId = (int) $this->getRequest()->getParam('popup_id', 0);
        $result = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);

        if (!$popupId) {
            $this->messageManager->addWarningMessage(__('The popup ID was not provided.'));
            return $result->setPath('*/*/');
        }

        try {
            $popup = $this->popupRepository->getById($popupId);
            $this->popupRepository->delete($popup);
            $this->messageManager->addSuccessMessage(__('The popup has been deleted.'));
        } catch (NoSuchEntityException $e) {
            $this->messageManager->addWarningMessage(__('The popup does not exist.'));
        } catch (\Throwable $e) {
            $this->messageManager->addErrorMessage(__('Something went wrong while processing the operation.'));
        }

        return $result->setPath('*/*/');
    }
}

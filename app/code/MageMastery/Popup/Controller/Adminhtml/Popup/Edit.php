<?php

declare(strict_types=1);

namespace MageMastery\Popup\Controller\Adminhtml\Popup;

use MageMastery\Popup\Api\PopupRepositoryInterface;
use MageMastery\Popup\Api\Data\PopupInterfaceFactory;
use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\View\Result\Page;
use Magento\Framework\Exception\NoSuchEntityException;

class Edit extends Action
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
        /** @var Page $page */
        $page = $this->resultFactory->create(ResultFactory::TYPE_PAGE);

        $popupId = (int) $this->getRequest()->getParam('popup_id');
        if ($popupId) {
            try {
                $popup = $this->popupRepository->getById($popupId);
                if (!$popup->getPopupId()) {
                    $this->messageManager->addErrorMessage(__('This popup no longer exists.'));
                    return $this->resultFactory->create(ResultFactory::TYPE_REDIRECT)->setPath('*/*/');
                }
            } catch (NoSuchEntityException $e) {
                $this->messageManager->addErrorMessage(__('This popup no longer exists.'));
                return $this->resultFactory->create(ResultFactory::TYPE_REDIRECT)->setPath('*/*/');
            }
        } else {
            $popup = $this->popupFactory->create();
        }

        $page->setActiveMenu('MageMastery_Popup::popup');
        $page->addBreadcrumb(__('Popups'), __('Popups'));
        $page->getConfig()->getTitle()->prepend($popup->getPopupId() ? $popup->getName() : __('New Popup'));

        return $page;
    }
}

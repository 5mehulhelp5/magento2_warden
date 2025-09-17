<?php

declare(strict_types=1);

namespace MageMastery\Popup\Service;

use MageMastery\Popup\Api\Data\PopupInterface;
use MageMastery\Popup\Api\PopupRepositoryInterface;
use MageMastery\Popup\Model\PopupFactory;
use MageMastery\Popup\Model\ResourceModel\Popup as PopupResource;
use Magento\Framework\Exception\AlreadyExistsException;
use Magento\Framework\Exception\NoSuchEntityException;

class PopupRepository implements PopupRepositoryInterface
{
    /**
     * @param PopupResource $popupResource
     * @param PopupFactory $popupFactory
     */
    public function __construct(
        private readonly PopupResource $popupResource,
        private readonly PopupFactory $popupFactory
    )
    {
    }

    /**
     * @param PopupInterface $popup
     * @return void
     * @throws \Exception
     */
    public function delete(PopupInterface $popup): void
    {
        $this->popupResource->delete($popup);
    }

    /**
     * @param PopupInterface $popup
     * @return void
     * @throws AlreadyExistsException
     */
    public function save(PopupInterface $popup): void
    {
        $this->popupResource->save($popup);
    }

    /**
     * @param int $popupId
     * @return PopupInterface
     * @throws NoSuchEntityException
     */
    public function getById(int $popupId): PopupInterface
    {
        $popup = $this->popupFactory->create();
        $this->popupResource->load($popup, $popupId);
        if (!$popup->getId()){
            throw new NoSuchEntityException(__('The popup with id %1 does not exists.', $popupId));
        }

        return $popup;
    }
}

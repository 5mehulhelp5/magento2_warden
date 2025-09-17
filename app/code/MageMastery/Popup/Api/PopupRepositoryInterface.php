<?php

/**
 * Copyright 2024 Adobe
 * All Rights Reserved.
 */

declare(strict_types=1);

namespace MageMastery\Popup\Api;

use MageMastery\Popup\Api\Data\PopupInterface;
use Magento\Framework\Exception\NoSuchEntityException;

interface PopupRepositoryInterface
{
    /**
     * @param PopupInterface $popup
     * @return void
     */
    public function delete(PopupInterface $popup): void;
    /**
     * @param PopupInterface $popup
     * @return void
     */
    public function save(PopupInterface $popup): void;

    /**
     * @param int $popupId
     * @return PopupInterface
     * @throws NoSuchEntityException
     */
    public function getById(int $popupId): PopupInterface;
}

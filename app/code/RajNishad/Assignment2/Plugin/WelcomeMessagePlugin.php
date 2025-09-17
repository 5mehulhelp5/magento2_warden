<?php

/**
 * Copyright 2024 Adobe
 * All Rights Reserved.
 */

namespace RajNishad\Assignment2\Plugin;

class WelcomeMessagePlugin
{
    /**
     * Updating Header
     *
     * @param \Magento\Theme\Block\Html\Header $subject
     * @param string $result
     * @return string
     */
    public function afterGetWelcome(
        \Magento\Theme\Block\Html\Header $subject,
        $result
    ) {
        return "Welcome to Raj's Store!";
    }
}

<?php

/**
 * Copyright 2024 Adobe
 * All Rights Reserved.
 */

namespace RajNishad\Assignment2\Plugin;

class BreadcrumbPlugin
{
    /**
     * Add "Hummingbird" before each breadcrumb label.
     *
     * @param \Magento\Theme\Block\Html\Breadcrumbs $subject
     * @param string $crumbName
     * @param array $crumbInfo
     * @return array
     */
    public function beforeAddCrumb(
        \Magento\Theme\Block\Html\Breadcrumbs $subject,
        $crumbName,
        array $crumbInfo
    ) {
        if (isset($crumbInfo['label'])) {
            $crumbInfo['label'] = "Hummingbird " . $crumbInfo['label'];
        }
        return [$crumbName, $crumbInfo];
    }
}

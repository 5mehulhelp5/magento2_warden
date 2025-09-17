<?php

/**
 * Copyright 2024 Adobe
 * All Rights Reserved.
 */

declare(strict_types=1);

namespace RajNishad\Checkout\Block;

use Magento\Checkout\Block\Checkout\LayoutProcessorInterface;
use Magento\Framework\Stdlib\ArrayManager;

class LayoutProcessor implements LayoutProcessorInterface
{
    /**
     * @var ArrayManager
     */
    protected $arrayManager;

    /**
     * Constructor function
     *
     * @param ArrayManager $arrayManager
     */
    public function __construct(ArrayManager $arrayManager)
    {
        $this->arrayManager = $arrayManager;
    }

    /**
     * Process
     *
     * @param array $jsLayout
     * @return array
     */
    public function process($jsLayout)
    {
        $customFieldsetPath =
            'components/checkout/children/steps/children/contact-step
            /children/contact/children/contact-fieldset/children';

        // Do nothing if our custom step doesn't exist in the layout
        if (!$this->arrayManager->exists($customFieldsetPath, $jsLayout)) {
            return $jsLayout;
        }

        $customFields = [
            'firstname' => $this->getFieldConfig('firstname', 'First Name', 100),
            'lastname' => $this->getFieldConfig('lastname', 'Last Name', 110),
            'telephone' => $this->getFieldConfig('telephone', 'Telephone', 120)
        ];

        // Use ArrayManager to safely merge our fields into the layout
        $jsLayout = $this->arrayManager->merge($customFieldsetPath, $jsLayout, $customFields);

        return $jsLayout;
    }

    /**
     * Helper method to generate the configuration for a form field.
     *
     * @param string $fieldCode
     * @param string $label
     * @param int $sortOrder
     * @return array
     */
    private function getFieldConfig(string $fieldCode, string $label, int $sortOrder): array
    {
        return [
            'component' => 'Magento_Ui/js/form/element/abstract',
            'config' => [
                'customScope' => 'contact.data',
                'template' => 'ui/form/field',
                'elementTmpl' => 'ui/form/element/input',
                'tooltip' => [
                    'description' => 'This is a custom field.',
                ],
            ],
            'dataScope' => 'contact.data.' . $fieldCode,
            'label' => __($label),
            'provider' => 'checkoutProvider',
            'sortOrder' => $sortOrder,
            'validation' => [
                'required-entry' => true
            ],
            'visible' => true,
        ];
    }
}

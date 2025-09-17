<?php

/**
 * Copyright 2024 Adobe
 * All Rights Reserved.
 */

namespace RajNishad\Assignment1\Model;

use Magento\Catalog\Api\Data\CategoryInterface;

class Test
{
    /**
     * @var CategoryInterface
     */
    private $category;

    /**
     * @var array
     */
    private $dataArray;

    /**
     * @var string
     */
    private $stringParam;

    /**
     * Constructor
     *
     * @param CategoryInterface $category
     * @param array $dataArray
     * @param string $stringParam
     */
    public function __construct(
        CategoryInterface $category,
        array $dataArray = [],
        string $stringParam = ''
    ) {
        $this->category = $category;
        $this->dataArray = $dataArray;
        $this->stringParam = $stringParam;
    }

    /**
     * Display parameters
     *
     * @return void
     */
    public function displayParams()
    {
        $arrayContent = "<ul>\n";
        foreach ($this->dataArray as $key => $value) {
            $arrayContent .= "<li><strong>{$key}:</strong> {$value}</li>\n";
        }
        $arrayContent .= "</ul>";

        $ans = "<h3>String Parameter:</h3>\n<p>" . $this->stringParam . "</p>\n"
            . "<h3>Array Parameter:</h3>\n" . $arrayContent;

        return $ans;
    }
}

<?php

/**
 * Copyright 2024 Adobe
 * All Rights Reserved.
 */

namespace RajNishad\Assignment4\Setup\Patch\Data;

use Magento\Framework\Setup\Patch\DataPatchInterface;
use Magento\UrlRewrite\Model\UrlRewriteFactory;

class AddContactRewrite implements DataPatchInterface
{
    /**
     * @var Magento\UrlRewrite\Model\UrlRewriteFactory
     */
    protected $urlRewriteFactory;

    /**
     * assignment
     *
     * @param UrlRewriteFactory $urlRewriteFactory
     * @return null
     */
    public function __construct(UrlRewriteFactory $urlRewriteFactory)
    {
        $this->urlRewriteFactory = $urlRewriteFactory;
    }

    /**
     * Modifying redirects
     *
     * @return null
     */
    public function apply()
    {
        $rewrite = $this->urlRewriteFactory->create();
        $rewrite->setStoreId(1)
            ->setIsSystem(0)
            ->setIdPath('contactus_custom')
            ->setRequestPath('contactuspage.html')
            ->setTargetPath('contact')
            ->save();
    }

    /**
     * Dependency
     *
     * @return array
     */
    public static function getDependencies()
    {
        return [];
    }

    /**
     * Aliases
     *
     * @return array
     */
    public function getAliases()
    {
        return [];
    }
}

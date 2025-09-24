<?php

namespace MagentoBackendProjects\HomepageCmsBlocks\Block\Homepage;

use Magento\Framework\View\Element\Template;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Cms\Model\Template\FilterProvider;

class CmsBlocks extends Template
{
    protected $scopeConfig;
    protected $filterProvider;

    public function __construct(
        Template\Context $context,
        ScopeConfigInterface $scopeConfig,
        FilterProvider $filterProvider,
        array $data = []
    ) {
        parent::__construct($context, $data);
        $this->scopeConfig = $scopeConfig;
        $this->filterProvider = $filterProvider;
    }

    public function getSelectedBlocks()
    {
        $blocks = $this->scopeConfig->getValue(
            'general/homepage_cms_blocks/selected_blocks',
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE
        );

        if (!$blocks) {
            return [];
        }

        return explode(',', $blocks); // because multiselect stores as comma-separated
    }

    public function renderBlock($identifier)
    {
        $block = $this->_layout->createBlock(\Magento\Cms\Block\Block::class);
        if ($block) {
            $block->setBlockId($identifier);
            return $block->toHtml();
        }
        return '';
    }
}

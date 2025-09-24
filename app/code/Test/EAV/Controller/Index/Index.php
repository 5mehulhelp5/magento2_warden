<?php

namespace Test\EAV\Controller\Index;

class Index extends \Magento\Framework\App\Action\Action
{
    /**
     * @var \Magento\Framework\View\Result\PageFactory
     */
    protected $_pageFactory;

    protected $temp;

    /**
     * @param \Magento\Framework\App\Action\Context $context
     */
    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $pageFactory,
        \Test\EAV\Model\Temp $temp
    ) {
        $this->_pageFactory = $pageFactory;
        $this->temp = $temp;
        return parent::__construct($context);
    }
    /**
     * View page action
     *
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        $page = $this->_pageFactory->create();
        print_r($this->temp->getAllProducts()->getData());
        return;
        $page->getConfig()->getTitle()->set("eav");
        return $page;
    }
}

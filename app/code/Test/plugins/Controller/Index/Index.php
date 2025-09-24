<?php

namespace Test\plugins\Controller\Index;

class Index extends \Magento\Framework\App\Action\Action
{
    /**
     * @var \Magento\Framework\View\Result\PageFactory
     */
    protected $_pageFactory;
    protected $code;
    /**
     * @param \Magento\Framework\App\Action\Context $context
     */
    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $pageFactory,
        \Test\plugins\Model\temp $temp
    ) {
        $this->_pageFactory = $pageFactory;
        $this->code = $temp->getcode("4985729847090190107");
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
        $page->getConfig()->getTitle()->set($this->code);
        return $page;
    }
}

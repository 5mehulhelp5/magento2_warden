<?php


namespace Mastering\SampleModule\Controller\Adminhtml\Item;


use Magento\Backend\App\Action;
use Magento\Framework\App\ResponseInterface;
use Mastering\SampleModule\Model\ItemFactory;

class Save extends \Magento\Backend\App\Action
{
    /**
     * @var ItemFactory
     */
    private $itemFactory;

    public function __construct(Action\Context $context, ItemFactory $itemFactory)
    {
        parent::__construct($context);
        $this->itemFactory = $itemFactory;
    }

    /**
     * @inheritDoc
     */
    public function execute()
    {
        $this->itemFactory
            ->create()
            ->setData($this->getRequest()->getPostValue()["general"])
            ->save();
        return $this->resultRedirectFactory->create()->setPath("mastering/index/index");
    }
}

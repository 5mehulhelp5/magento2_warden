<?php

namespace ControllerBlockLayoutTemplate\Example\Controller\Index;

use Magento\Framework\App\Action\Action; // /home/rajnishad/Desktop/magento/vendor/magento/framework/App/Action/Action.php 
use Magento\Framework\App\Action\Context; // /home/rajnishad/Desktop/magento/vendor/magento/framework/App/Action/Context.php
use Magento\Framework\View\Result\PageFactory; // /home/rajnishad/Desktop/magento/vendor/magento/framework/View/Result/PageFactory.php
// /home/rajnishad/Desktop/magento/generated/code/ControllerBlockLayoutTemplate/Example/Controller/Index/Index/Interceptor.php since it is factory be can see it in generated code

class Index extends Action
{
    protected $pageFactory;

    public function __construct(Context $context, PageFactory $pageFactory)
    {
        parent::__construct($context); //parent is a php feature to call constructor of parent class. 
        //so __construct of Action class will be called.
        //the parent class Action needs Context object in its constructor. so we need to pass $context to parent constructor
        //else parent constructor will not execute and we will get error.


        $this->pageFactory = $pageFactory; //
    }

    /**
     * https://app.raj-magento2.test/example/index/index when this URL is hit, magento looks for "example" as frontname in etc/frontend/routes.xml. 
     * once that happens Routes request to Controller\Index\Index::execute(). this function will be executed
     * $this->pageFactory->create() will look for layout file in view/frontend/layout/example_index_index.xml
     * 
     */
    public function execute()
    {
        return $this->pageFactory->create(); //this function will look for layout file in view/frontend/layout/example_index_index.xml
    }
}






//===================newer way
// namespace ControllerBlockLayoutTemplate\Example\Controller\Index;

// use Magento\Framework\App\Action\HttpGetActionInterface;
// use Magento\Framework\View\Result\PageFactory;

// class Index implements HttpGetActionInterface
// {
//     protected $pageFactory;

//     public function __construct(PageFactory $pageFactory)
//     {
//         $this->pageFactory = $pageFactory;
//     }

//     public function execute()
//     {
//         return $this->pageFactory->create();
//     }
// }

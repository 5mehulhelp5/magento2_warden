<?php

/**
 * Copyright 2024 Adobe
 * All Rights Reserved.
 */

namespace RajNishad\Assignment4\Controller;

use Magento\Framework\App\ActionFactory;
use Magento\Framework\App\RouterInterface;
use Magento\Framework\App\RequestInterface;

class Router implements RouterInterface
{
    /**
     * @var Magento\Framework\App\ActionFactory
     */
    protected $actionFactory;

    /**
     * assignment
     *
     * @param ActionFactory $actionFactory
     * @return null
     */
    public function __construct(ActionFactory $actionFactory)
    {
        $this->actionFactory = $actionFactory;
    }

    /**
     * Match "FrontnameControllernameAction" → "frontname/controllername/action"
     *
     * @param RequestInterface $request
     * @return null
     */
    public function match(RequestInterface $request)
    {
        $path = trim($request->getPathInfo(), '/');

        if (preg_match('/^([A-Za-z]+)([A-Za-z]+)([A-Za-z]+)$/', $path, $matches)
            && !in_array($path, ['contact', 'checkout', 'customer'])
        ) {
            $frontName = strtolower($matches[1]);
            $controller = strtolower($matches[2]);
            $action = strtolower($matches[3]);

            $request->setModuleName($frontName)
                ->setControllerName($controller)
                ->setActionName($action);

            return $this->actionFactory->create(
                \Magento\Framework\App\Action\Forward::class,
                ['request' => $request]
            );
        }
        return null;
    }
}

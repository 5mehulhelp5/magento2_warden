<?php

namespace RajNishad\Assignment4\Router;

use Magento\Framework\App\ActionFactory;
use Magento\Framework\App\RequestInterface;
use Magento\Framework\App\RouterInterface;
use Magento\Framework\App\ResponseInterface;

class CamelCaseRouter implements RouterInterface
{
    protected $actionFactory;
    protected $response;
    protected $logger;

    public function __construct(
        ActionFactory $actionFactory,
        ResponseInterface $response,
        \Psr\Log\LoggerInterface $logger
    ) {
        $this->actionFactory = $actionFactory;
        $this->response = $response;
        $this->logger = $logger;
    }

    public function match(RequestInterface $request)
    {
        $pathInfo = trim($request->getPathInfo(), '/'); // e.g. Assignment4IndexIndex
        $this->logger->info('>>> CamelCaseRouter triggered: ' . $pathInfo);

        if (strpos($pathInfo, '/') !== false) {
            return null;
        }

        $redirectPath = strtolower($pathInfo[0]);
        for ($i = 1; $i < strlen($pathInfo); $i++) {
            $char = $pathInfo[$i];
            if (ctype_upper($char)) {
                $redirectPath .= '/' . strtolower($char);
            } else {
                $redirectPath .= $char;
            }
        }

        $this->logger->info('>>> Redirecting to: ' . $redirectPath);

        // Redirect browser to normalized path
        $this->response->setRedirect('/' . ltrim($redirectPath, '/'));
        $request->setDispatched(true);

        return $this->actionFactory->create(
            \Magento\Framework\App\Action\Redirect::class,
            ['request' => $request]
        );
    }
}

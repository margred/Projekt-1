<?php

namespace HAWMS\http;

use HAWMS\controller\UserRegistrationController;
use HAWMS\view\ViewRenderer;
use HAWMS\view\ViewResolver;

class Dispatcher
{
    private $requestHandler;
    private $viewResolver;
    private $viewRenderer;

    /**
     * Dispatcher constructor.
     * @param RequestHandler $requestHandler
     * @param ViewResolver $viewResolver
     * @param ViewRenderer $viewRenderer
     */
    public function __construct(RequestHandler $requestHandler, ViewResolver $viewResolver, ViewRenderer $viewRenderer)
    {
        $this->requestHandler = $requestHandler;
        $this->viewResolver = $viewResolver;
        $this->viewRenderer = $viewRenderer;
    }

    public function dispatch(Request $request, Response $response)
    {
        $viewModel = $this->requestHandler->handle($request, $response);
        $view = $this->viewResolver->resolveView($viewModel->getViewName());
        $body = $this->viewRenderer->render($view, $viewModel->getModel());
        $response->setBody($body);
        return $response;
    }
}

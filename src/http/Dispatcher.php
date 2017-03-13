<?php

namespace HAWMS\http;

use HAWMS\controller\UserRegistrationController;
use HAWMS\view\ViewRenderer;
use HAWMS\view\ViewResolver;

class Dispatcher
{
    private $viewResolver;
    private $viewRenderer;
    /**
     * @var UserRegistrationController
     */
    private $userRegistrationController;

    /**
     * Dispatcher constructor.
     * @param ViewResolver $viewResolver
     * @param ViewRenderer $viewRenderer
     * @param UserRegistrationController $userRegistrationController
     */
    public function __construct(ViewResolver $viewResolver, ViewRenderer $viewRenderer, UserRegistrationController $userRegistrationController)
    {
        $this->viewResolver = $viewResolver;
        $this->viewRenderer = $viewRenderer;
        $this->userRegistrationController = $userRegistrationController;
    }

    public function dispatch(Request $request, Response $response)
    {
        $viewModel = $this->userRegistrationController->register();
        $view = $this->viewResolver->resolveView($viewModel->getViewName());
        $body = $this->viewRenderer->render($view, $viewModel->getModel());
        $response->setBody($body);
        return $response;
    }
}

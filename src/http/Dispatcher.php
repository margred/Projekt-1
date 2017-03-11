<?php

namespace HAWMS\http;

use HAWMS\controller\UserRegistrationController;
use HAWMS\view\ViewModelRenderer;

class Dispatcher
{
    /**
     * @var ViewModelRenderer
     */
    private $viewModelRenderer;
    /**
     * @var UserRegistrationController
     */
    private $userRegistrationController;

    /**
     * Dispatcher constructor.
     * @param ViewModelRenderer $viewModelRenderer
     * @param UserRegistrationController $userRegistrationController
     */
    public function __construct(ViewModelRenderer $viewModelRenderer, UserRegistrationController $userRegistrationController)
    {
        $this->viewModelRenderer = $viewModelRenderer;
        $this->userRegistrationController = $userRegistrationController;
    }

    public function dispatch(Request $request, Response $response)
    {
        $viewModel = $this->userRegistrationController->register();
        $this->viewModelRenderer->render($viewModel, $request, $response);
    }
}

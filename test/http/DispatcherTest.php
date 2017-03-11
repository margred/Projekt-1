<?php

use HAWMS\controller\UserRegistrationController;
use HAWMS\http\Dispatcher;
use HAWMS\http\Request;
use HAWMS\http\Response;
use HAWMS\view\ViewModelRenderer;
use PHPUnit\Framework\TestCase;

class DispatcherTest extends TestCase
{
    private $dispatcher;
    private $userRegistrationController;
    private $viewModelRenderer;

    protected function setUp()
    {
        $this->viewModelRenderer = $this->createMock(ViewModelRenderer::class);
        $this->userRegistrationController = $this->createMock(UserRegistrationController::class);
        $this->dispatcher = new Dispatcher($this->viewModelRenderer, $this->userRegistrationController);
    }

    public function testShouldDispatchRequest()
    {
        $request = $this->createMock(Request::class);
        $response = $this->createMock(Response::class);
        $viewModel = new \HAWMS\controller\ViewModel('aView');
        $this->userRegistrationController->method('register')
            ->willReturn($viewModel);
        $this->viewModelRenderer->expects($this->once())
            ->method('render')
            ->with($viewModel, $request, $response);

        $this->dispatcher->dispatch($request, $response);
    }
}

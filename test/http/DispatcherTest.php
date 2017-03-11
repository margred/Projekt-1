<?php

use HAWMS\controller\UserRegistrationController;
use HAWMS\http\Dispatcher;
use HAWMS\http\Request;
use HAWMS\http\Response;
use HAWMS\view\View;
use HAWMS\view\ViewRenderer;
use HAWMS\view\ViewResolver;
use PHPUnit\Framework\TestCase;

class DispatcherTest extends TestCase
{
    /**
     * @var ViewResolver
     */
    private $viewResolver;

    /**
     * @var ViewRenderer
     */
    private $viewRenderer;

    /**
     * @var UserRegistrationController
     */
    private $userRegistrationController;

    /**
     * @var Dispatcher
     */
    private $dispatcher;

    protected function setUp()
    {
        $this->userRegistrationController = $this->createMock(UserRegistrationController::class);
        $this->viewResolver = $this->createMock(ViewResolver::class);
        $this->viewRenderer = $this->createMock(ViewRenderer::class);
        $this->dispatcher = new Dispatcher($this->viewResolver, $this->viewRenderer, $this->userRegistrationController);
    }

    public function testShouldDispatchRequest()
    {
        $viewModel = new \HAWMS\controller\ViewModel('aView');
        $view = new View(dirname(__DIR__) . '/template/test.php');
        $expectedResponseBody = 'A rendered view';
        $this->userRegistrationController->method('register')
            ->willReturn($viewModel);
        $this->viewResolver->expects($this->once())
            ->method('resolveView')
            ->with($viewModel->getViewName())
            ->willReturn($view);
        $this->viewRenderer->expects($this->once())
            ->method('render')
            ->with($view, $viewModel->getModel())
            ->willReturn($expectedResponseBody);

        $response = $this->dispatcher->dispatch(new Request(), new Response());

        $this->assertEquals($expectedResponseBody, $response->getBody());
    }
}

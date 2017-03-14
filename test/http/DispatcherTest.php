<?php

use HAWMS\controller\UserRegistrationController;
use HAWMS\http\Dispatcher;
use HAWMS\http\Request;
use HAWMS\http\RequestHandler;
use HAWMS\http\Response;
use HAWMS\view\View;
use HAWMS\view\ViewRenderer;
use HAWMS\view\ViewResolver;
use PHPUnit\Framework\TestCase;

class DispatcherTest extends TestCase
{
    /**
     * @var RequestHandler
     */
    private $requestHandler;

    /**
     * @var ViewResolver
     */
    private $viewResolver;

    /**
     * @var ViewRenderer
     */
    private $viewRenderer;

    /**
     * @var Dispatcher
     */
    private $dispatcher;

    protected function setUp()
    {
        $this->requestHandler = $this->createMock(RequestHandler::class);
        $this->viewResolver = $this->createMock(ViewResolver::class);
        $this->viewRenderer = $this->createMock(ViewRenderer::class);
        $this->dispatcher = new Dispatcher($this->requestHandler, $this->viewResolver, $this->viewRenderer);
    }

    public function testShouldDispatchRequest()
    {
        $request = new Request();
        $response = new Response();
        $viewModel = new \HAWMS\controller\ViewModel('aView', [
            'foo' => 'bar'
        ]);
        $view = new View(dirname(__DIR__) . '/template/test.php');
        $expectedResponseBody = 'A rendered view';
        $this->requestHandler->expects($this->once())
            ->method('handle')
            ->with($request, $response)
            ->willReturn($viewModel);
        $this->viewResolver->expects($this->once())
            ->method('resolveView')
            ->with($viewModel->getViewName())
            ->willReturn($view);
        $this->viewRenderer->expects($this->once())
            ->method('render')
            ->with($view, $viewModel->getModel())
            ->willReturn($expectedResponseBody);

        $response = $this->dispatcher->dispatch($request, $response);

        $this->assertEquals($expectedResponseBody, $response->getBody());
    }
}

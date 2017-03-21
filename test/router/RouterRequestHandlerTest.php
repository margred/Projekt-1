<?php

use HAWMS\controller\ViewModel;
use HAWMS\http\ControllerInvoker;
use HAWMS\http\Request;
use HAWMS\http\Response;
use HAWMS\routing\Router;
use HAWMS\routing\RouterRequestHandler;

class RouterRequestHandlerTest extends \PHPUnit\Framework\TestCase
{
    private $router;
    private $controllerInvoker;
    private $routerRequestHandler;

    protected function setUp()
    {
        $this->router = $this->createMock(Router::class);
        $this->controllerInvoker = $this->createMock(ControllerInvoker::class);
        $this->routerRequestHandler = new RouterRequestHandler($this->router, $this->controllerInvoker);
    }

    public function testShouldInvokeControllerAction()
    {
        $request = new Request();
        $response = new Response();
        $params = [
            'controller' => 'TestController',
            'action' => 'index'
        ];
        $expectedViewModel = new ViewModel('aView');
        $this->router->expects($this->once())
            ->method('route')
            ->with($this->identicalTo($request))
            ->willReturn($params);
        $this->controllerInvoker->expects($this->once())
            ->method('invoke')
            ->with($params, $request, $response)
            ->willReturn($expectedViewModel);

        $actualViewModel = $this->routerRequestHandler->handle($request, $response);

        $this->assertSame($expectedViewModel, $actualViewModel);
    }
}

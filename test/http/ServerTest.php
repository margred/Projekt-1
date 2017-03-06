<?php

use HAWMS\Application;
use HAWMS\http\Request;
use HAWMS\http\RequestFactory;
use HAWMS\http\Response;
use HAWMS\http\ResponseFactory;
use HAWMS\http\ResponseSender;
use HAWMS\http\Server;
use HAWMS\http\ServerContext;

class ServerTest extends \PHPUnit\Framework\TestCase
{
    private $serverContext;
    private $application;
    private $requestFactory;
    private $responseFactory;
    private $responseSender;
    private $server;

    protected function setUp()
    {
        $this->serverContext = $this->createMock(ServerContext::class);
        $this->requestFactory = $this->createMock(RequestFactory::class);
        $this->serverContext->method('getRequestFactory')
            ->willReturn($this->requestFactory);
        $this->responseFactory = $this->createMock(ResponseFactory::class);
        $this->serverContext->method('getResponseFactory')
            ->willReturn($this->responseFactory);
        $this->responseSender = $this->createMock(ResponseSender::class);
        $this->serverContext->method('getResponseSender')
            ->willReturn($this->responseSender);
        $this->application = $this->createMock(Application::class);
        $this->server = new Server($this->serverContext, $this->application);
    }

    public function testShouldRunApplication()
    {
        $request = $this->createMock(Request::class);
        $response = $this->createMock(Response::class);
        $this->application->expects($this->once())
            ->method('run')
            ->with($this->identicalTo($request), $this->identicalTo($response))
            ->willReturn($this->createMock(Response::class));

        $this->server->run($request, $response);
    }

    public function testShouldSendReturnedResponse()
    {
        $response = $this->createMock(Response::class);
        $expectedResponse = $this->createMock(Response::class);
        $this->application->expects($this->once())
            ->method('run')
            ->with($this->isInstanceOf(Request::class), $this->identicalTo($response))
            ->willReturn($expectedResponse);
        $this->responseSender->expects($this->once())
            ->method('send')
            ->with($this->identicalTo($expectedResponse));

        $this->server->run($this->createMock(Request::class), $response);
    }

    public function test_WhenRequestIsNull_ShouldCreateRequest()
    {
        $createdRequest = $this->createMock(Request::class);
        $this->requestFactory->expects($this->once())
            ->method('createRequest')
            ->willReturn($createdRequest);

        $this->application->method('run')
            ->with($createdRequest, $this->anything())
            ->will($this->returnArgument(1));
        $this->server->run(null, $this->createMock(Response::class));
    }

    public function test_WhenResponseIsNull_ShouldCreateResponse()
    {
        $createdResponse = $this->createMock(Response::class);
        $this->responseFactory->expects($this->once())
            ->method('createResponse')
            ->willReturn($createdResponse);
        $this->application->method('run')
            ->with($this->anything(), $createdResponse)
            ->will($this->returnArgument(1));
        $this->server->run($this->createMock(Request::class), null);
    }
}

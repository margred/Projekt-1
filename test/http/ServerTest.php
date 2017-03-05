<?php

use HAWMS\Application;
use HAWMS\http\Request;
use HAWMS\http\Response;
use HAWMS\http\ResponseSender;
use HAWMS\http\Server;

class ServerTest extends \PHPUnit\Framework\TestCase
{
    private $application;
    private $responseSender;
    private $server;

    protected function setUp()
    {
        $this->application = $this->createMock(Application::class);
        $this->responseSender = $this->createMock(ResponseSender::class);
        $this->server = new Server($this->application, $this->responseSender);
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

    public function testShouldReturnedSendResponse()
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
}

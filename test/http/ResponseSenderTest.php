<?php

use HAWMS\http\HeaderSender;
use HAWMS\http\Response;
use HAWMS\http\ResponseSender;

class ResponseSenderTest extends \PHPUnit\Framework\TestCase
{
    private $headerSender;
    private $responseSender;

    protected function setUp()
    {
        $this->headerSender = $this->createMock(HeaderSender::class);
        $this->responseSender = new ResponseSender($this->headerSender);

    }

    public function testShouldSendStatus()
    {
        $response = $this->createMock(Response::class);
        $response->method("getStatusCode")
            ->willReturn(200);
        $response->method("getStatusReasonPhrase")
            ->willReturn("OK");

        $this->headerSender->expects($this->once())
            ->method('send')
            ->with('HTTP/1.1 200 OK');
        $this->responseSender->send($response);
    }

    public function testShouldFlushResponse()
    {
        $response = $this->createMock(Response::class);

        $response->expects($this->once())
            ->method('flush');
        $this->responseSender->send($response);
    }

}

<?php

use HAWMS\http\Response;
use HAWMS\http\ResponseFactory;

class ResponseFactoryTest extends \PHPUnit\Framework\TestCase
{
    public function testShouldCreateResponseInstance()
    {
        $responseFactory = new ResponseFactory();

        $this->assertInstanceOf(Response::class, $responseFactory->createResponse());
    }
}

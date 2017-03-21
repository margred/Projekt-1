<?php

use HAWMS\http\Response;

class ResponseTest extends \PHPUnit\Framework\TestCase
{
    private $response;

    protected function setUp()
    {
        $this->response = new Response();
    }

    public function testShouldSetStatusOk()
    {
        $this->assertEquals(200, $this->response->getStatusCode());
        $this->assertEquals('OK', $this->response->getStatusReasonPhrase());
    }

    public function testShouldOutputResponseBody()
    {
        $expectedOutput = 'A response body';
        $this->response->setBody($expectedOutput);

        ob_start();
        $this->response->flush();
        $actualOutput = ob_get_clean();

        $this->assertEquals($expectedOutput, $actualOutput);
    }
}

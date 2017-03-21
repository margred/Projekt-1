<?php

use HAWMS\http\Request;
use PHPUnit\Framework\TestCase;

class RequestTest extends TestCase
{
    public function testShouldSetCorrectFields()
    {
        $params = [
            'hello' => 'world'
        ];
        $body = [
            'foo' => 'bar'
        ];
        $method = 'GET';
        $request = new Request([
            'params' => $params,
            'body' => $body,
            'method' => $method
        ]);

        $this->assertEquals($params, $request->getParams());
        $this->assertEquals($body, $request->getBody());
        $this->assertEquals($method, $request->getMethod());
    }

    public function testShouldIgnoreUndefinexIndices()
    {
        $request = new Request();

        $this->assertNotNull($request->getParams());
        $this->assertEmpty($request->getParams());
        $this->assertNotNull($request->getBody());
        $this->assertEmpty($request->getBody());
    }

    public function testWhenRequestMethodIsPost_ShouldReturnTrue()
    {
        $request = new Request([
            'method' => 'POST'
        ]);

        $this->assertTrue($request->isPost());
    }
}

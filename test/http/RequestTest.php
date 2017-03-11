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
        $request = new Request([
            'params' => $params,
            'body' => $body
        ]);

        $this->assertEquals($params, $request->getParams());
        $this->assertEquals($body, $request->getBody());
    }

    public function testShouldIgnoreUndefinexIndices()
    {
        $request = new Request();

        $this->assertNotNull($request->getParams());
        $this->assertEmpty($request->getParams());
        $this->assertNotNull($request->getBody());
        $this->assertEmpty($request->getBody());
    }
}

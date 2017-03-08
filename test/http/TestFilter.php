<?php

namespace HAWMS\test\http;

use HAWMS\http\Filter;
use HAWMS\http\FilterChain;
use HAWMS\http\Request;
use HAWMS\http\Response;

class TestFilter implements Filter
{
    private $called = false;

    public function filter(Request $request, Response $response, FilterChain $filterChain)
    {
        $this->called = true;
        $filterChain->filter($request, $response);
    }

    /**
     * @return mixed
     */
    public function isCalled()
    {
        return $this->called;
    }
}

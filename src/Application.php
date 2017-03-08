<?php

namespace HAWMS;

use HAWMS\http\FilterChain;
use HAWMS\http\Request;
use HAWMS\http\Response;

class Application
{
    private $filterChain;

    /**
     * Application constructor.
     */
    public function __construct()
    {
        $this->filterChain = new FilterChain();
        $this->filterChain->addFilter(new SampleFilter());
    }

    /**
     * @param Request $request
     * @param Response $response
     * @return Response
     */
    public function run(Request $request, Response $response)
    {
        return $this->filterChain->filter($request, $response);
    }
}

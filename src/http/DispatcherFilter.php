<?php

namespace HAWMS\http;

class DispatcherFilter implements Filter
{
    private $dispatcher;

    /**
     * DispatcherFilter constructor.
     * @param Dispatcher $dispatcher
     */
    public function __construct(Dispatcher $dispatcher)
    {
        $this->dispatcher = $dispatcher;
    }

    public function filter(Request $request, Response $response, FilterChain $filterChain)
    {
        $this->dispatcher->dispatch($request, $response);
        $filterChain->filter($request, $response);
    }
}

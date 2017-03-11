<?php

use HAWMS\http\Dispatcher;
use HAWMS\http\DispatcherFilter;
use HAWMS\http\FilterChain;
use HAWMS\http\Request;
use HAWMS\http\Response;
use PHPUnit\Framework\TestCase;

class DispatcherFilterTest extends TestCase
{
    /**
     * @var Dispatcher
     */
    private $dispatcher;
    /**
     * @var DispatcherFilter
     */
    private $dispatcherFilter;

    protected function setUp()
    {
        $this->dispatcher = $this->createMock(Dispatcher::class);
        $this->dispatcherFilter = new DispatcherFilter($this->dispatcher);
    }

    public function testShouldDispatch()
    {
        $request = new Request();
        $response = new Response();
        $this->dispatcher->expects($this->once())
            ->method('dispatch')
            ->with($request, $response);
        $filterChain = $this->createMock(FilterChain::class);
        $filterChain->expects($this->once())
            ->method('filter')
            ->with($request, $response);

        $this->dispatcherFilter->filter($request, $response, $filterChain);
    }
}

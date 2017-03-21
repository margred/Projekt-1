<?php

use HAWMS\http\Filter;
use HAWMS\http\FilterChain;
use HAWMS\http\Request;
use HAWMS\http\Response;
use HAWMS\Test\http\TestFilter;
use PHPUnit\Framework\TestCase;

class FilterChainTest extends TestCase
{
    /**
     * @var FilterChain
     */
    private $filterChain;

    protected function setUp()
    {
        $this->filterChain = new FilterChain();
    }

    public function testShouldCallFilter()
    {
        $request = $this->createMock(Request::class);
        $response = $this->createMock(Response::class);
        $filter = $this->createMock(Filter::class);
        $filter->expects($this->once())
            ->method('filter')
            ->with($request, $response, $this->filterChain);
        $this->filterChain->addFilter($filter);

        $returnedResponse = $this->filterChain->filter($request, $response);

        $this->assertEquals($response, $returnedResponse);
    }


    public function testShouldCallFilters()
    {
        $request = $this->createMock(Request::class);
        $response = $this->createMock(Response::class);
        $filter1 = new TestFilter();
        $filter2 = new TestFilter();
        $this->filterChain->addFilter($filter1);
        $this->filterChain->addFilter($filter2);

        $this->filterChain->filter($request, $response);

        $this->assertTrue($filter1->isCalled());
        $this->assertTrue($filter2->isCalled());
    }

    public function testShouldAddFilterToFilters()
    {
        $filter = $this->createMock(Filter::class);

        $this->filterChain->addFilter($filter);

        $this->assertSame($filter, $this->filterChain->getFilters()[0]);
    }

    public function testShouldAddAllFilterToEndOfFilders()
    {
        $filter = $this->createMock(Filter::class);
        $this->filterChain->addFilter($filter);
        $filters = [
            $this->createMock(Filter::class),
            $this->createMock(Filter::class)
        ];

        $this->filterChain->addAllFilters($filters);

        $this->assertCount(3, $this->filterChain->getFilters());
        $this->assertSame($filter, $this->filterChain->getFilters()[0]);
        $this->assertSame($filters[0], $this->filterChain->getFilters()[1]);
        $this->assertSame($filters[1], $this->filterChain->getFilters()[2]);

    }
}

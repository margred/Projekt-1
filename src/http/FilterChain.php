<?php

namespace HAWMS\http;

class FilterChain
{
    private $filters = [];
    private $nextPosition = 0;

    public function filter($request, $response)
    {
        $currentPosition = $this->nextPosition;
        $this->nextPosition += 1;
        if (isset($this->filters[$currentPosition])) {
            $filter = $this->filters[$currentPosition];
            $filter->filter($request, $response, $this);
        }
        return $response;
    }

    public function addFilter(Filter $filter)
    {
        $this->filters[] = $filter;
    }

    public function addAllFilters($filters)
    {
        $this->filters = array_merge($this->filters, $filters);
    }

    public function getFilters()
    {
        return $this->filters;
    }
}

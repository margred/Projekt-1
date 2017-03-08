<?php

namespace HAWMS\http;

interface Filter
{
    public function filter(Request $request, Response $response, FilterChain $filterChain);
}

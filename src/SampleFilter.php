<?php

namespace HAWMS;

use HAWMS\http\Filter;
use HAWMS\http\FilterChain;
use HAWMS\http\Request;
use HAWMS\http\Response;

class SampleFilter implements Filter
{
    public function filter(Request $request, Response $response, FilterChain $filterChain)
    {
        $sample = new Sample();
        $sample->increase();
        $body = sprintf("Increase Sample: %d<br>", $sample->getNum());
        $sample->increase();
        $body .= sprintf("Increase Sample: %d<br>", $sample->getNum());
        $sample->decrease();
        $body .= sprintf("Decrease Sample: %d<br>", $sample->getNum());
        $body .= sprintf("Result: %d\n", $sample->getNum());
        $response->setBody($body);
        $filterChain->filter($request, $response);
    }
}

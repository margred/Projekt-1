<?php

namespace HAWMS\auth;

class SessionFilter implements \HAWMS\http\Filter
{

    public function filter(\HAWMS\http\Request $request, \HAWMS\http\Response $response, \HAWMS\http\FilterChain $filterChain)
    {
        session_start();
        $filterChain->filter($request, $response);
    }
}

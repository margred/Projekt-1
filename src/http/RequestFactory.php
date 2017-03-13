<?php

namespace HAWMS\http;

class RequestFactory
{

    /**
     * @return Request
     */
    public function createRequest()
    {
        $request = new Request([
            'params' => $_GET,
            'body' => $_POST,
            'method' => isset($_SERVER['REQUEST_METHOD']) ? $_SERVER['REQUEST_METHOD'] : 'GET'
        ]);
        return $request;
    }
}

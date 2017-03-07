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
            'body' => $_POST
        ]);
        return $request;
    }
}

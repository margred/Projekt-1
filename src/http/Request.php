<?php

namespace HAWMS\http;

class Request
{
    private $params;
    private $body;

    /**
     * Request constructor.
     * @param array $data
     */
    public function __construct(array $data = [])
    {
        $this->params = $data['params'];
        $this->body = $data['body'];
    }

    public function getParams()
    {
        return $this->params;
    }

    public function getBody()
    {
        return $this->body;
    }
}

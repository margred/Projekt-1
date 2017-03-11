<?php

namespace HAWMS\http;

class Request
{
    private $params = [];
    private $body = [];

    /**
     * Request constructor.
     * @param array $data
     */
    public function __construct(array $data = [])
    {
        if (isset($data['params'])) {
            $this->params = $data['params'];
        }
        if (isset($data['body'])) {
            $this->body = $data['body'];
        }
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

<?php

namespace HAWMS\http;

class Request
{
    private $params = [];
    private $body = [];
    private $method;

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
        if (isset($data['method'])) {
            $this->method = $data['method'];
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

    public function getMethod()
    {
        return $this->method;
    }

    public function isPost()
    {
        return $this->method == 'POST';
    }
}

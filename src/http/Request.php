<?php

namespace HAWMS\http;

class Request
{
    private $uri;
    private $params = [];
    private $body = [];
    private $method;

    /**
     * Request constructor.
     * @param array $data
     */
    public function __construct(array $data = [])
    {
        if (isset($data['uri'])) {
            $this->uri = $data['uri'];
        }
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

    public function getUri()
    {
        return $this->uri;
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

<?php

namespace HAWMS\http;

class Response
{
    private $statusCode;
    private $statusReasonPhrase;
    private $body;

    public function __construct()
    {
        $this->statusCode = 200;
        $this->statusReasonPhrase = 'OK';
    }

    /**
     * @return int
     */
    public function getStatusCode()
    {
        return $this->statusCode;
    }


    /**
     * @return string
     */
    public function getStatusReasonPhrase()
    {
        return $this->statusReasonPhrase;
    }

    public function setBody(string $body)
    {
        $this->body = $body;
    }

    public function flush()
    {
        echo $this->body;
    }
}

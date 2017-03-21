<?php

namespace HAWMS\http;

class ResponseSender
{
    const HEADER_STATUS_STRING_FORMAT = "HTTP/1.1 %d %s";

    private $headerSender;

    public function __construct(HeaderSender $headerSender)
    {
        $this->headerSender = $headerSender;
    }

    public function send(Response $response)
    {
        $headerString = sprintf(self::HEADER_STATUS_STRING_FORMAT, $response->getStatusCode(), $response->getStatusReasonPhrase());
        $this->headerSender->send($headerString);
        $response->flush();
    }
}

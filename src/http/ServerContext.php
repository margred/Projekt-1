<?php

namespace HAWMS\http;

class ServerContext
{
    /**
     * @return RequestFactory
     */
    public function getRequestFactory()
    {
        return new RequestFactory();
    }

    /**
     * @return ResponseFactory
     */
    public function getResponseFactory()
    {
        return new ResponseFactory();
    }

    /**
     * @return ResponseSender
     */
    public function getResponseSender()
    {
        return new ResponseSender($this->getHeaderSender());
    }

    /**
     * @return HeaderSender
     */
    public function getHeaderSender()
    {
        return new HeaderSender();
    }
}

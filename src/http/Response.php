<?php

namespace HAWMS\http;

interface Response
{
    /**
     * @return int
     */
    public function getStatusCode();


    /**
     * @return string
     */
    public function getStatusReasonPhrase();

    public function flush();
}

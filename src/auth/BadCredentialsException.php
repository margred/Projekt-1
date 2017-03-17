<?php

namespace HAWMS\auth;

use Exception;

class BadCredentialsException extends Exception
{
    public function __construct($message = "", Exception $previous = null)
    {
        parent::__construct($message, 0, $previous);
    }
}

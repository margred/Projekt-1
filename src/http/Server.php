<?php

namespace HAWMS\http;

use HAWMS\Application;

class Server
{
    private $application;
    private $responseSender;

    /**
     * Server constructor.
     */
    public function __construct(Application $application, ResponseSender $responseSender)
    {
        $this->application = $application;
        $this->responseSender = $responseSender;
    }

    public function run(Request $request, Response $response)
    {
        $response = $this->application->run($request, $response);
        $this->responseSender->send($response);
    }
}

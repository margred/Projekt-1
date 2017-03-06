<?php

namespace HAWMS\http;

use HAWMS\Application;

class Server
{
    private $application;
    private $responseSender;

    /**
     * Server constructor.
     * @param ServerContext $context
     * @param Application $application
     */
    public function __construct(ServerContext $context, Application $application)
    {
        $this->application = $application;
        $this->responseSender = $context->getResponseSender();
    }

    public function run(Request $request, Response $response)
    {
        $response = $this->application->run($request, $response);
        $this->responseSender->send($response);
    }
}

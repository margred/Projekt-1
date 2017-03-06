<?php

namespace HAWMS\http;

use HAWMS\Application;

class Server
{
    private $application;
    private $requestFactory;
    private $responseFactory;
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
        $this->requestFactory = $context->getRequestFactory();
        $this->responseFactory = $context->getResponseFactory();
    }

    public function run(Request $request = null, Response $response = null)
    {
        if (!$request) {
            $request = $this->requestFactory->createRequest();
        }
        if (!$response) {
            $response = $this->responseFactory->createResponse();
        }
        $response = $this->application->run($request, $response);
        $this->responseSender->send($response);
    }
}

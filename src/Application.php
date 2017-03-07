<?php

namespace HAWMS;

use HAWMS\http\Request;
use HAWMS\http\Response;

class Application
{

    /**
     * @param Request $request
     * @param Response $response
     * @return Response
     */
    public function run(Request $request, Response $response)
    {
        $sample = new Sample();
        $sample->increase();
        $body = sprintf("Increase Sample: %d<br>", $sample->getNum());
        $sample->increase();
        $body .= sprintf("Increase Sample: %d<br>", $sample->getNum());
        $sample->decrease();
        $body .= sprintf("Decrease Sample: %d<br>", $sample->getNum());
        $body .= sprintf("Result: %d\n", $sample->getNum());
        $response->setBody($body);
        return $response;
    }
}

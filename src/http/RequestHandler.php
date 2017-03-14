<?php

namespace HAWMS\http;

use HAWMS\controller\ViewModel;

interface RequestHandler
{
    /**
     * @param Request $request
     * @param Response $response
     * @return ViewModel
     */
    public function handle(Request $request, Response $response);
}

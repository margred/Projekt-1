<?php

namespace HAWMS;

use HAWMS\controller\UserRegistrationController;
use HAWMS\http\Dispatcher;
use HAWMS\http\DispatcherFilter;
use HAWMS\http\FilterChain;
use HAWMS\http\Request;
use HAWMS\http\Response;
use HAWMS\view\ViewRenderer;
use HAWMS\view\ViewResolver;

class Application
{
    private $filterChain;

    /**
     * Application constructor.
     */
    public function __construct()
    {
        $viewResolver = new ViewResolver(__DIR__ . '/template');
        $viewRenderer = new ViewRenderer();
        $userRegistrationController = new UserRegistrationController();
        $dispatch = new Dispatcher($viewResolver, $viewRenderer, $userRegistrationController);
        $this->filterChain = new FilterChain();
        $this->filterChain->addFilter(new DispatcherFilter($dispatch));
    }

    /**
     * @param Request $request
     * @param Response $response
     * @return Response
     */
    public function run(Request $request, Response $response)
    {
        return $this->filterChain->filter($request, $response);
    }
}

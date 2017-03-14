<?php

namespace HAWMS\routing;

use HAWMS\controller\ViewModel;
use HAWMS\http\ControllerInvoker;
use HAWMS\http\Request;
use HAWMS\http\RequestHandler;
use HAWMS\http\Response;

class RouterRequestHandler implements RequestHandler
{
    /**
     * @var Router
     */
    private $router;
    /**
     * @var ControllerInvoker
     */
    private $controllerInvoker;

    /**
     * RouterRequestHandler constructor.
     * @param Router $router
     * @param ControllerInvoker $controllerInvoker
     */
    public function __construct(Router $router, ControllerInvoker $controllerInvoker)
    {
        $this->router = $router;
        $this->controllerInvoker = $controllerInvoker;
    }

    /**
     * @param Request $request
     * @param Response $response
     * @return ViewModel
     */
    public function handle(Request $request, Response $response)
    {
        $params = $this->router->route($request);
        return $this->controllerInvoker->invoke($params, $request, $response);
    }
}

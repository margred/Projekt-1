<?php

namespace HAWMS\http;

use HAWMS\controller\ViewModel;

class ControllerInvoker
{
    private $controllers;

    /**
     * ControllerInvoker constructor.
     * @param array $controllers
     */
    public function __construct(array $controllers)
    {
        $this->controllers = $controllers;
    }

    /**
     * @param array $params
     * @param Request $request
     * @param Response $response
     * @return ViewModel
     * @throws \Exception
     */
    public function invoke(array $params, Request $request, Response $response)
    {
        if (isset($params['controller'])) {
            $controllerName = $params['controller'];
        } else {
            return new ViewModel('404');
        }
        if (isset($this->controllers[$controllerName])) {
            $controller = $this->controllers[$controllerName];
            $action = $params['action'];
            return $controller->$action($request, $response);
        }
        return new ViewModel('404');
    }
}

<?php

namespace HAWMS\controller;

class ViewModel
{
    private $viewName;
    private $model;

    /**
     * ViewModel constructor.
     * @param $viewName
     * @param $model
     */
    public function __construct(string $viewName, array $model = [])
    {
        $this->viewName = $viewName;
        $this->model = $model;
    }


    /**
     * @return string
     */
    public function getViewName()
    {
        return $this->viewName;
    }


    /**
     * @return array
     */
    public function getModel()
    {
        return $this->model;
    }
}

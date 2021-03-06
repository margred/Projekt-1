<?php

namespace HAWMS\view;

class ViewResolver
{
    const FILE_EXTENSION = '.php';
    private $viewPath;

    /**
     * ViewResolver constructor.
     * @param $viewPath
     */
    public function __construct($viewPath)
    {
        $this->viewPath = $this->normalizeViewPath($viewPath);
    }

    private function normalizeViewPath(string $path)
    {
        if (substr($path, -1) != '/') {
            return $path . '/';
        }
        return $path;
    }

    /**
     * @param string $viewName
     * @return View
     */
    public function resolveView(string $viewName)
    {
        $path = $this->getViewPath() . $viewName . self::FILE_EXTENSION;
        return new View($path);
    }

    public function getViewPath()
    {
        return $this->viewPath;
    }
}

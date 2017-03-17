<?php

namespace HAWMS\view;

class ViewRenderer
{
    private $layoutPath;
    private $content;

    public function render(View $view, array $model = [])
    {
        $this->content = $this->renderView($view, $model);
        if ($this->layoutPath) {
            return $this->renderLayout();
        }
        return $this->content;
    }

    public function setLayoutPath($layoutPath)
    {
        $this->layoutPath = $layoutPath;
    }

    /**
     * @param View $view
     * @param array $model
     * @return string
     */
    private function renderView(View $view, array $model): string
    {
        extract($model);
        ob_start();

        include $view->getPath();

        return ob_get_clean();
    }

    private function renderLayout()
    {
        ob_start();

        include $this->layoutPath;

        return ob_get_clean();
    }

    private function content()
    {
        return $this->content;
    }
}

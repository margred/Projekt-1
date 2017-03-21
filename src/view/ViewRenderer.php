<?php

namespace HAWMS\view;

class ViewRenderer
{
    public function render(View $view, array $model = [])
    {
        extract($model);
        ob_start();

        include $view->getPath();

        return ob_get_clean();
    }
}

<?php

use HAWMS\view\ViewRenderer;

class ViewRendererTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @var ViewRenderer
     */
    private $viewRenderer;

    protected function setUp()
    {
        $this->viewRenderer = new ViewRenderer();
    }

    public function testShouldReturnViewContent()
    {
        $view = new \HAWMS\view\View(dirname(__DIR__) . '/template/test.php');
        $model = [
            'foo' => 'bar'
        ];
        $content = $this->viewRenderer->render($view, $model);

        $this->assertEquals("<h1>bar</h1>\n", $content);
    }

    public function testWhenLayoutPathIsSet_ShouldWrapViewContentInLayout()
    {
        $this->viewRenderer->setLayoutPath(dirname(__DIR__) . '/template/layout.php');
        $view = new \HAWMS\view\View(dirname(__DIR__) . '/template/test.php');
        $model = [
            'foo' => 'bar'
        ];
        $content = $this->viewRenderer->render($view, $model);

        $this->assertEquals("<Layout><h1>bar</h1>\n</Layout>\n", $content);
    }
}

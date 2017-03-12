<?php

use HAWMS\view\ViewResolver;

class ViewResolverTest extends \PHPUnit\Framework\TestCase
{
    const VIEW_PATH = '../template/';

    /**
     * @var ViewResolver
     */
    private $viewResolver;

    protected function setUp()
    {
        $this->viewResolver = new ViewResolver(self::VIEW_PATH);
    }

    public function testShouldSetViewPath()
    {
        $this->assertEquals(self::VIEW_PATH, $this->viewResolver->getViewPath());
    }

    public function testShouldNormalizeViewPath()
    {
        $viewResolver = new ViewResolver('../template');
        $this->assertEquals('../template/', $viewResolver->getViewPath());
    }

    public function testShouldReturnView()
    {
        $viewName = 'aView';
        $view = $this->viewResolver->resolveView($viewName);

        $this->assertNotNull($view);
        $this->assertEquals($this->viewResolver->getViewPath() . $viewName, $view->getPath());
    }
}

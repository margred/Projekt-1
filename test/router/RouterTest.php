<?php

namespace HAWMS\routing;

use HAWMS\http\Request;
use PHPUnit\Framework\TestCase;

class RouterTest extends TestCase
{
    /**
     * @var Router
     */
    private $router;

    protected function setUp()
    {
        $this->router = new Router();
    }

    public function testShouldAddRouteToRoutes()
    {
        $route = new Route('/^\/course\/(\d+)$/', ['controller' => 'course', 'action' => 'view']);

        $this->router->addRoute($route);

        $this->assertContains($route, $this->router->getRoutes());
    }

    public function testWhenRoutePatternMatches_ShouldReturnRouteParams()
    {
        $request = new Request(['uri' => '/course']);
        $route = new Route('/^\/course$/', ['controller' => 'course', 'action' => 'view']);
        $this->router->addRoute($route);

        $actualParams = $this->router->route($request);

        $this->assertEquals($route->getParams(), $actualParams);
    }
}

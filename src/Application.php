<?php

namespace HAWMS;

use HAWMS\controller\LoginController;
use HAWMS\controller\UserRegistrationController;
use HAWMS\http\ControllerInvoker;
use HAWMS\http\Dispatcher;
use HAWMS\http\DispatcherFilter;
use HAWMS\http\FilterChain;
use HAWMS\http\Request;
use HAWMS\http\Response;
use HAWMS\repository\CourseRepository;
use HAWMS\repository\UniversityRepository;
use HAWMS\repository\UserRepository;
use HAWMS\routing\Route;
use HAWMS\routing\Router;
use HAWMS\routing\RouterRequestHandler;
use HAWMS\service\CourseService;
use HAWMS\service\UniversityService;
use HAWMS\service\UserService;
use HAWMS\view\ViewRenderer;
use HAWMS\view\ViewResolver;
use PDO;
use PDOException;

class Application
{
    private $filterChain;

    /**
     * Application constructor.
     */
    public function __construct()
    {
        $routerRequestHandler = new RouterRequestHandler($this->getRouter(), $this->getControllerInvoker());
        $viewResolver = new ViewResolver(__DIR__ . '/template');
        $viewRenderer = new ViewRenderer();
        $viewRenderer->setLayoutPath(__DIR__ . '/template/layout/default.php');
        $dispatch = new Dispatcher($routerRequestHandler, $viewResolver, $viewRenderer);
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

    private function getRouter()
    {
        $router = new Router();
        $router->addRoute(new Route('/\/signup/', [
            'controller' => 'UserRegistrationController',
            'action' => 'register'
        ]));
        $router->addRoute(new Route('/\/login/', [
            'controller' => 'LoginController',
            'action' => 'login'
        ]));
        return $router;
    }

    private function getControllerInvoker()
    {
        $controller = [
            'UserRegistrationController' => $this->getUserRegistrationController(),
            'LoginController' => $this->getLoginController()
        ];
        return new ControllerInvoker($controller);
    }

    private function getUserRegistrationController()
    {
        $connection = $this->getDatabaseConnection();
        $userRepository = new UserRepository($connection);
        $userService = new UserService($userRepository);
        $universityRepository = new UniversityRepository($connection);
        $universityService = new UniversityService($universityRepository);
        $courseRepository = new CourseRepository($connection);
        $courseService = new CourseService($courseRepository);
        return new UserRegistrationController($userService, $universityService, $courseService);
    }

    private function getLoginController()
    {
        return new LoginController();
    }

    public function getDatabaseConnection()
    {
        try {
            $conn = new PDO('pgsql:host=localhost;port=5432;dbname=project1');
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $conn;
        } catch (PDOException $e) {
            echo 'ERROR: ' . $e->getMessage();
        }
    }
}

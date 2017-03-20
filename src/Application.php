<?php

namespace HAWMS;

use HAWMS\auth\EmailPasswordAuthenticationProvider;
use HAWMS\auth\SessionFilter;
use HAWMS\controller\LearningGroupController;
use HAWMS\controller\LoginController;
use HAWMS\controller\UserRegistrationController;
use HAWMS\http\ControllerInvoker;
use HAWMS\http\Dispatcher;
use HAWMS\http\DispatcherFilter;
use HAWMS\http\FilterChain;
use HAWMS\http\Request;
use HAWMS\http\Response;
use HAWMS\repository\CourseRepository;
use HAWMS\repository\LearningGroupRepository;
use HAWMS\repository\LectureRepository;
use HAWMS\repository\UniversityRepository;
use HAWMS\repository\UserRepository;
use HAWMS\routing\Route;
use HAWMS\routing\Router;
use HAWMS\routing\RouterRequestHandler;
use HAWMS\service\CourseService;
use HAWMS\service\LearningGroupService;
use HAWMS\service\LectureService;
use HAWMS\service\PasswordHashEncoder;
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
        $this->filterChain->addFilter(new SessionFilter());
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
        $router->addRoute(new Route('/^\/signup$/', [
            'controller' => 'UserRegistrationController',
            'action' => 'register'
        ]));
        $router->addRoute(new Route('/^\/login$/', [
            'controller' => 'LoginController',
            'action' => 'login'
        ]));
        $router->addRoute(new Route('/^\/learning-group\/add$/', [
            'controller' => 'LearningGroupController',
            'action' => 'add'
        ]));
        $router->addRoute(new Route('/^\/learning-group$/', [
            'controller' => 'LearningGroupController',
            'action' => 'index'
        ]));
        return $router;
    }

    private function getControllerInvoker()
    {
        $passwordEncoder = $this->getPasswordEncoder();
        $connection = $this->getDatabaseConnection();
        $universityService = $this->getUniversityService($connection);
        $courseService = $this->getCourseService($connection);
        $userService = $this->getUserService($connection, $passwordEncoder);
        $lectureService = $this->getLectureService($connection, $userService);
        $learningGroupService = $this->getLearningGroupService($connection, $lectureService, $userService);
        $emailPasswordAuthenticationProvider = new EmailPasswordAuthenticationProvider($userService, $passwordEncoder);
        $controller = [
            'UserRegistrationController' => $this->getUserRegistrationController($userService, $universityService, $courseService),
            'LoginController' => $this->getLoginController($emailPasswordAuthenticationProvider),
            'LearningGroupController' => $this->getLearningGroupController($lectureService, $learningGroupService)
        ];
        return new ControllerInvoker($controller);
    }

    private function getUserRegistrationController(UserService $userService, UniversityService $universityService, CourseService $courseService)
    {
        return new UserRegistrationController($userService, $universityService, $courseService);
    }

    private function getLoginController(EmailPasswordAuthenticationProvider $emailPasswordAuthenticationProvider)
    {
        return new LoginController($emailPasswordAuthenticationProvider);
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

    /**
     * @return PasswordHashEncoder
     */
    private function getPasswordEncoder(): PasswordHashEncoder
    {
        $passwordEncoder = new PasswordHashEncoder();
        return $passwordEncoder;
    }

    /**
     * @param $connection
     * @return UniversityService
     */
    private function getUniversityService($connection): UniversityService
    {
        $universityRepository = new UniversityRepository($connection);
        $universityService = new UniversityService($universityRepository);
        return $universityService;
    }

    /**
     * @param $connection
     * @return CourseService
     */
    private function getCourseService($connection): CourseService
    {
        $courseRepository = new CourseRepository($connection);
        $courseService = new CourseService($courseRepository);
        return $courseService;
    }

    /**
     * @param $connection
     * @param $passwordEncoder
     * @return UserService
     */
    private function getUserService($connection, $passwordEncoder): UserService
    {
        $userRepository = new UserRepository($connection);
        $userService = new UserService($passwordEncoder, $userRepository);
        return $userService;
    }

    private function getLearningGroupController(LectureService $lectureCourseService, LearningGroupService $learningGroupService)
    {
        return new LearningGroupController($lectureCourseService, $learningGroupService);
    }

    private function getLectureService(PDO $connection, UserService $userService)
    {
        $lectureCourseRepository = new LectureRepository($connection);
        return new LectureService($lectureCourseRepository, $userService);
    }

    private function getLearningGroupService(PDO $connection, LectureService $lectureService, UserService $userService)
    {
        $learningGroupRepository = new LearningGroupRepository($connection);
        return new LearningGroupService($learningGroupRepository, $lectureService, $userService);
    }
}

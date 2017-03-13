<?php

namespace HAWMS;

use HAWMS\controller\UserRegistrationController;
use HAWMS\http\Dispatcher;
use HAWMS\http\DispatcherFilter;
use HAWMS\http\FilterChain;
use HAWMS\http\Request;
use HAWMS\http\Response;
use HAWMS\repository\UniversityRepository;
use HAWMS\service\UniversityService;
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
        $viewResolver = new ViewResolver(__DIR__ . '/template');
        $viewRenderer = new ViewRenderer();
        $userRegistrationController = $this->getUserRegistrationController();
        $dispatch = new Dispatcher($viewResolver, $viewRenderer, $userRegistrationController);
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

    private function getUserRegistrationController()
    {
        $connection = $this->getDatabaseConnection();
        $universityRepository = new UniversityRepository($connection);
        $universityService = new UniversityService($universityRepository);
        return new UserRegistrationController($universityService);
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

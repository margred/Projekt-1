<?php

use HAWMS\controller\UserRegistrationController;
use HAWMS\http\Request;
use HAWMS\model\Course;
use HAWMS\model\University;
use HAWMS\model\User;
use HAWMS\service\CourseService;
use HAWMS\service\UniversityService;
use HAWMS\service\UserService;
use PHPUnit\Framework\TestCase;

class UserRegistrationControllerTest extends TestCase
{
    /**
     * @var UserService
     */
    private $userService;

    /**
     * @var UniversityService
     */
    private $universityService;

    /**
     * @var CourseService
     */
    private $courseService;

    /**
     * @var UserRegistrationController
     */
    private $userRegistrationController;

    protected function setUp()
    {
        $this->userService = $this->createMock(UserService::class);
        $this->universityService = $this->createMock(UniversityService::class);
        $this->courseService = $this->createMock(CourseService::class);
        $this->userRegistrationController = new UserRegistrationController(
            $this->userService,
            $this->universityService,
            $this->courseService);
    }

    public function testShouldReturnViewModel()
    {
        $universities = [
            new University(1, 'HAW Hamburg'),
            new University(2, 'University Hamburg')
        ];
        $this->universityService->method('getUniversities')
            ->willReturn($universities);
        $courses = [
            new Course(),
            new Course()
        ];
        $this->courseService->method('getCourses')
            ->willReturn($courses);

        $viewModel = $this->userRegistrationController->register(new Request());

        $this->assertNotNull($viewModel);
        $this->assertEquals('register', $viewModel->getViewName());
        $this->assertEquals([
            'universities' => $universities,
            'courses' => $courses
        ], $viewModel->getModel());
    }

    public function testShouldRegisterUser()
    {
        $body = [
            'email' => 'max.mustermann@example.com',
            'password' => 'secret',
            'firstName' => 'Max',
            'lastName' => 'Mustermann',
            'universityId' => 23,
            'courseId' => 45
        ];
        $request = new Request([
            'body' => $body,
            'method' => 'POST'
        ]);
        $expectedUser = new User();
        $expectedUser->setEmail($body['email']);
        $expectedUser->setPassword($body['password']);
        $expectedUser->setFirstName($body['firstName']);
        $expectedUser->setLastName($body['lastName']);
        $expectedUser->setUniversityId($body['universityId']);
        $expectedUser->setCourseId($body['courseId']);
        $this->userService->expects($this->once())
            ->method('register')
            ->with($this->equalTo($expectedUser));

        $this->userRegistrationController->register($request);
    }
}

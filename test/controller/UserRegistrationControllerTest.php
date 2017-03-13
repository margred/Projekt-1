<?php

use HAWMS\controller\UserRegistrationController;
use HAWMS\model\Course;
use HAWMS\model\University;
use HAWMS\service\CourseService;
use HAWMS\service\UniversityService;
use PHPUnit\Framework\TestCase;

class UserRegistrationControllerTest extends TestCase
{
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
        $this->universityService = $this->createMock(UniversityService::class);
        $this->courseService = $this->createMock(CourseService::class);
        $this->userRegistrationController = new UserRegistrationController($this->universityService, $this->courseService);
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

        $viewModel = $this->userRegistrationController->register();

        $this->assertNotNull($viewModel);
        $this->assertEquals('register', $viewModel->getViewName());
        $this->assertEquals([
            'universities' => $universities,
            'courses' => $courses
        ], $viewModel->getModel());
    }
}

<?php

use HAWMS\controller\UserRegistrationController;
use HAWMS\model\University;
use HAWMS\service\UniversityService;
use PHPUnit\Framework\TestCase;

class UserRegistrationControllerTest extends TestCase
{
    /**
     * @var UniversityService
     */
    private $universityService;

    /**
     * @var UserRegistrationController
     */
    private $userRegistrationController;

    protected function setUp()
    {
        $this->universityService = $this->createMock(UniversityService::class);
        $this->userRegistrationController = new UserRegistrationController($this->universityService);
    }

    public function testShouldReturnViewModel()
    {
        $universities = [
            new University(1, 'HAW Hamburg'),
            new University(2, 'University Hamburg')
        ];
        $this->universityService->method('getUniversities')
            ->willReturn($universities);

        $viewModel = $this->userRegistrationController->register();

        $this->assertNotNull($viewModel);
        $this->assertEquals('register', $viewModel->getViewName());
        $this->assertEquals([
            'universities' => $universities
        ], $viewModel->getModel());
    }
}

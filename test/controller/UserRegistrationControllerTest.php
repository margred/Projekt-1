<?php

use PHPUnit\Framework\TestCase;

class UserRegistrationControllerTest extends TestCase
{
    /**
     * @var UserRegistrationController
     */
    private $userRegistrationController;

    protected function setUp()
    {
        $this->userRegistrationController = new HAWMS\controller\UserRegistrationController();
    }

    public function testShouldReturnViewModel()
    {
        $viewModel = $this->userRegistrationController->register();

        $this->assertNotNull($viewModel);
        $this->assertEquals('register', $viewModel->getViewName());
    }
}

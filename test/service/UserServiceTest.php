<?php

use HAWMS\model\User;
use HAWMS\repository\UserRepository;
use HAWMS\service\UserService;

class UserServiceTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @var UserRepository
     */
    private $userRepository;

    /**
     * @var UserService
     */
    private $userService;

    protected function setUp()
    {
        $this->userRepository = $this->createMock(UserRepository::class);
        $this->userService = new UserService($this->userRepository);
    }

    public function testShouldReturnSavedUser()
    {
        $user = new User();
        $user->setEmail("max.mustermann@example.com");
        $savedUser = new User();
        $this->userRepository->expects($this->once())
            ->method('save')
            ->with($user)
            ->willReturn($savedUser);

        $actualUser = $this->userService->register($user);

        $this->assertSame($savedUser, $actualUser);
    }

    /**
     * @expectedException Exception
     */
    public function testWhenUserFoundByUsername_ShouldThrowException()
    {
        $user = new User();
        $user->setEmail("max.mustermann@example.com");
        $existingUser = new User();
        $this->userRepository->expects($this->once())
            ->method('findOneByEmail')
            ->with($user->getEmail())
            ->willReturn($existingUser);
        $this->userRepository->expects($this->never())
            ->method('save');

        $this->userService->register($user);
    }
}

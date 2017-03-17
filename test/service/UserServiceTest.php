<?php

use HAWMS\model\User;
use HAWMS\repository\UserRepository;
use HAWMS\service\PasswordEncoder;
use HAWMS\service\UserService;

class UserServiceTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @var UserRepository
     */
    private $userRepository;

    /**
     * @var PasswordEncoder
     */
    private $passwordEncoder;

    /**
     * @var UserService
     */
    private $userService;

    protected function setUp()
    {
        $this->passwordEncoder = $this->createMock(PasswordEncoder::class);
        $this->userRepository = $this->createMock(UserRepository::class);
        $this->userService = new UserService($this->passwordEncoder, $this->userRepository);
    }

    public function testShouldReturnSavedUser()
    {
        $user = new User();
        $user->setEmail("max.mustermann@example.com");
        $user->setPassword('secret');
        $savedUser = new User();
        $this->userRepository->expects($this->once())
            ->method('save')
            ->with($user)
            ->willReturn($savedUser);

        $actualUser = $this->userService->register($user);

        $this->assertSame($savedUser, $actualUser);
    }

    public function testShouldEncodePassword()
    {
        $user = new User();
        $user->setEmail("max.mustermann@example.com");
        $user->setPassword('secret');
        $encodedPassword = 'encodedSecret';
        $this->passwordEncoder->expects($this->once())
            ->method('encode')
            ->with($user->getPassword())
            ->willReturn($encodedPassword);
        $this->userRepository->expects($this->once())
            ->method('save')
            ->with($this->callback(function ($user) {
                return $user->getPassword() === 'encodedSecret';
            }));

        $this->userService->register($user);
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

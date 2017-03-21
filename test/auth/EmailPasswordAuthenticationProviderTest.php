<?php

use HAWMS\auth\BadCredentialsException;
use HAWMS\auth\EmailPasswordAuthentication;
use HAWMS\auth\EmailPasswordAuthenticationProvider;
use HAWMS\exception\UserNotFoundException;
use HAWMS\model\User;
use HAWMS\service\PasswordEncoder;
use HAWMS\service\UserService;
use PHPUnit\Framework\TestCase;

class EmailPasswordAuthenticationProviderTest extends TestCase
{
    /**
     * @var UserService
     */
    private $userService;

    /**
     * @var PasswordEncoder
     */
    private $passwordEncoder;

    /**
     * @var EmailPasswordAuthenticationProvider
     */
    private $authenticationProvider;

    protected function setUp()
    {
        $this->userService = $this->createMock(UserService::class);
        $this->passwordEncoder = $this->createMock(PasswordEncoder::class);
        $this->authenticationProvider = new EmailPasswordAuthenticationProvider($this->userService, $this->passwordEncoder);
    }

    public function testShouldReturnUser()
    {
        $authentication = new EmailPasswordAuthentication('max.mustermann@example.com', 'secret');
        $user = new User();
        $user->setPassword('anotherSecret');
        $this->userService->expects($this->once())
            ->method('loadUserByEmail')
            ->with($authentication->getEmail())
            ->willReturn($user);
        $this->passwordEncoder->method('matches')
            ->willReturn(true);

        $actualUser = $this->authenticationProvider->authenticate($authentication);

        $this->assertSame($user, $actualUser);
    }

    public function testWhenUserNotFoundExceptionIsThrown_ShouldThrowBadCredentialsException()
    {
        $authentication = new EmailPasswordAuthentication('max.mustermann@example.com', 'secret');
        $this->userService->method('loadUserByEmail')
            ->will($this->throwException(new UserNotFoundException()));
        $this->expectException(BadCredentialsException::class);

        $this->authenticationProvider->authenticate($authentication);

    }

    public function testWhenPasswordsDontMatch_ShouldThrowBadCredentialsException()
    {
        $authentication = new EmailPasswordAuthentication('max.mustermann@example.com', 'secret');
        $user = new User();
        $user->setPassword('anotherSecret');
        $this->userService->expects($this->once())
            ->method('loadUserByEmail')
            ->with($authentication->getEmail())
            ->willReturn($user);
        $this->passwordEncoder->expects($this->once())
            ->method('matches')
            ->with($authentication->getPassword(), $user->getPassword())
            ->willReturn(false);
        $this->expectException(BadCredentialsException::class);

        $this->authenticationProvider->authenticate($authentication);
    }
}

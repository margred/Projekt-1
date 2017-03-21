<?php

namespace HAWMS\auth;

use HAWMS\exception\UserNotFoundException;
use HAWMS\model\User;
use HAWMS\service\PasswordEncoder;
use HAWMS\service\UserService;

class EmailPasswordAuthenticationProvider
{
    private $userService;

    /**
     * EmailPasswordAuthenticationProvider constructor.
     * @param UserService $userService
     * @param PasswordEncoder $passwordEncoder
     */
    public function __construct(UserService $userService, PasswordEncoder $passwordEncoder)
    {
        $this->userService = $userService;
        $this->passwordEncoder = $passwordEncoder;
    }

    /**
     * @param EmailPasswordAuthentication $authentication
     * @return User
     * @throws BadCredentialsException
     */
    public function authenticate(EmailPasswordAuthentication $authentication)
    {
        $user = $this->loadUser($authentication->getEmail());
        if (!$this->passwordEncoder->matches($authentication->getPassword(), $user->getPassword())) {
            throw new BadCredentialsException("Bad credentials");
        }
        return $user;
    }

    /**
     * @param $email
     * @return User
     * @throws BadCredentialsException
     */
    private function loadUser($email): User
    {
        try {
            return $this->userService->loadUserByEmail($email);
        } catch (UserNotFoundException $e) {
            throw new BadCredentialsException("Bad credentials");
        }
    }
}

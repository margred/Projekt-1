<?php

namespace HAWMS\service;

use HAWMS\exception\DuplicateEmailException;
use HAWMS\exception\UserNotFoundException;
use HAWMS\model\User;
use HAWMS\repository\UserRepository;

class UserService
{
    /**
     * @var PasswordEncoder
     */
    private $passwordEncoder;

    /**
     * @var UserRepository
     */
    private $userRepository;

    /**
     * UserService constructor.
     */
    public function __construct(PasswordEncoder $passwordEncoder, UserRepository $userRepository)
    {
        $this->passwordEncoder = $passwordEncoder;
        $this->userRepository = $userRepository;
    }

    public function register(User $user)
    {
        $existingUser = $this->userRepository->findOneByEmail($user->getEmail());
        if ($existingUser) {
            throw new DuplicateEmailException($user->getEmail() . ' already used');
        }
        $user->setPassword($this->passwordEncoder->encode($user->getPassword()));
        return $this->userRepository->save($user);
    }

    public function loadUserByEmail($email)
    {
        $user = $this->userRepository->findOneByEmail($email);
        if (!$user) {
            throw new UserNotFoundException('User with email <' . $email . '> not found');
        }
        return $user;
    }
}

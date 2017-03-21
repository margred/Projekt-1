<?php

namespace HAWMS\service;

use HAWMS\exception\DuplicateEmailException;
use HAWMS\model\User;
use HAWMS\repository\UserRepository;

class UserService
{
    /**
     * @var UserRepository
     */
    private $userRepository;

    /**
     * UserService constructor.
     */
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function register(User $user)
    {
        $existingUser = $this->userRepository->findOneByEmail($user->getEmail());
        if ($existingUser) {
            throw new DuplicateEmailException($user->getEmail() . ' already used');
        }
        return $this->userRepository->save($user);
    }
}

<?php

namespace HAWMS\service;

class PasswordHashEncoder implements PasswordEncoder
{
    /**
     * @param string $password
     * @return string encoded password
     */
    public function encode(string $password)
    {
        return password_hash($password, PASSWORD_BCRYPT);
    }

    /**
     * @param string $rawPassword
     * @param string $encodedPassword
     * @return boolean
     */
    public function matches(string $rawPassword, string $encodedPassword)
    {
        return password_verify($rawPassword, $encodedPassword);
    }
}

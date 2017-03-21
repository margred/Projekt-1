<?php

namespace HAWMS\service;

interface PasswordEncoder
{
    /**
     * @param string $password
     * @return string encoded password
     */
    public function encode(string $password);

    /**
     * @param string $rawPassword
     * @param string $encodedPassword
     * @return boolean
     */
    public function matches(string $rawPassword, string $encodedPassword);
}

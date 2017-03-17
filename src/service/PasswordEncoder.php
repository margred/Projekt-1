<?php

namespace HAWMS\service;

interface PasswordEncoder
{
    /**
     * @param string $password
     * @return string encoded password
     */
    public function encode(string $password);
}

<?php

namespace HAWMS\controller;

class UserRegistrationController extends Controller
{
    /**
     * @return ViewModel
     */
    public function register()
    {
        return new ViewModel('register');
    }
}

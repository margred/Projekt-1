<?php

namespace HAWMS\controller;

use HAWMS\service\UniversityService;

class UserRegistrationController extends Controller
{
    /**
     * @var UniversityService
     */
    private $universityService;

    /**
     * UserRegistrationController constructor.
     * @param UniversityService $universityService
     */
    public function __construct(UniversityService $universityService)
    {
        $this->universityService = $universityService;
    }

    /**
     * @return ViewModel
     */
    public function register()
    {
        $universities = $this->universityService->getUniversities();
        return new ViewModel('register', [
            'universities' => $universities
        ]);
    }
}

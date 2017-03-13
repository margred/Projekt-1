<?php

namespace HAWMS\controller;

use HAWMS\service\CourseService;
use HAWMS\service\UniversityService;

class UserRegistrationController extends Controller
{
    /**
     * @var UniversityService
     */
    private $universityService;

    /**
     * @var CourseService
     */
    private $courseService;

    /**
     * UserRegistrationController constructor.
     * @param UniversityService $universityService
     * @param CourseService $courseService
     */
    public function __construct(UniversityService $universityService, CourseService $courseService)
    {
        $this->universityService = $universityService;
        $this->courseService = $courseService;
    }

    /**
     * @return ViewModel
     */
    public function register()
    {
        $universities = $this->universityService->getUniversities();
        $courses = $this->courseService->getCourses();
        return new ViewModel('register', [
            'universities' => $universities,
            'courses' => $courses
        ]);
    }
}

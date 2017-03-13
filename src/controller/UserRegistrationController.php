<?php

namespace HAWMS\controller;

use HAWMS\http\Request;
use HAWMS\model\User;
use HAWMS\service\CourseService;
use HAWMS\service\UniversityService;
use HAWMS\service\UserService;

class UserRegistrationController extends Controller
{
    /**
     * @var UserService
     */
    private $userService;

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
     * @param UserService $userService
     * @param UniversityService $universityService
     * @param CourseService $courseService
     */
    public function __construct(UserService $userService, UniversityService $universityService, CourseService $courseService)
    {
        $this->userService = $userService;
        $this->universityService = $universityService;
        $this->courseService = $courseService;
    }

    /**
     * @param Request $request
     * @return ViewModel
     */
    public function register(Request $request)
    {
        if ($request->isPost()) {
            $user = $this->makeUser($request);
            $this->userService->register($user);
        }
        $universities = $this->universityService->getUniversities();
        $courses = $this->courseService->getCourses();
        return new ViewModel('register', [
            'universities' => $universities,
            'courses' => $courses
        ]);
    }

    /**
     * @param Request $request
     * @return User
     */
    private function makeUser(Request $request): User
    {
        $user = new User();
        $user->setEmail($request->getBody()['email']);
        $user->setPassword($request->getBody()['password']);
        $user->setFirstName($request->getBody()['firstName']);
        $user->setLastName($request->getBody()['lastName']);
        $user->setUniversityId($request->getBody()['universityId']);
        $user->setCourseId($request->getBody()['courseId']);
        return $user;
    }
}

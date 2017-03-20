<?php

namespace HAWMS\service;

use HAWMS\exception\UserNotFoundException;
use HAWMS\model\LearningCourse;
use HAWMS\repository\LectureRepository;

class LectureService
{
    private $lectureCourseRepository;
    private $userService;

    /**
     * LectureCourseService constructor.
     * @param LectureRepository $lectureCourseRepository
     * @param UserService $userService
     */
    public function __construct(LectureRepository $lectureCourseRepository, UserService $userService)
    {
        $this->lectureCourseRepository = $lectureCourseRepository;
        $this->userService = $userService;
    }

    /**
     * @param int $userId
     * @return LearningCourse[]
     * @throws UserNotFoundException
     */
    public function getLearningCoursesForUserId(int $userId)
    {
        $user = $this->userService->getUserById($userId);
        if (!$user) {
            throw new UserNotFoundException('User <' . $userId . '> not found');
        }
        return $this->lectureCourseRepository->findAllByUniversityIdAndCourseId(
            $user->getUniversityId(),
            $user->getCourseId());
    }
}

<?php

namespace HAWMS\service;

use HAWMS\exception\UserNotFoundException;
use HAWMS\model\LearningCourse;
use HAWMS\model\Lecture;
use HAWMS\repository\LectureRepository;

class LectureService
{
    /**
     * @var LectureRepository
     */
    private $lectureRepository;

    /**
     * @var UserService
     */
    private $userService;

    /**
     * LectureCourseService constructor.
     * @param LectureRepository $lectureRepository
     * @param UserService $userService
     */
    public function __construct(LectureRepository $lectureRepository, UserService $userService)
    {
        $this->lectureRepository = $lectureRepository;
        $this->userService = $userService;
    }

    /**
     * @param Lecture $lecture
     * @return Lecture
     */
    public function createLecture(Lecture $lecture)
    {
        return $this->lectureRepository->save($lecture);
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
        return $this->lectureRepository->findAllByUniversityIdAndCourseId(
            $user->getUniversityId(),
            $user->getCourseId());
    }
}

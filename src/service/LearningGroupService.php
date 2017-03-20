<?php

namespace HAWMS\service;

use HAWMS\model\LearningGroup;
use HAWMS\model\Lecture;
use HAWMS\repository\LearningGroupRepository;

class LearningGroupService
{
    private $learningGroupRepository;
    private $lectureService;
    private $userService;

    /**
     * LearningGroupService constructor.
     * @param LearningGroupRepository $learningGroupRepository
     */
    public function __construct(LearningGroupRepository $learningGroupRepository, LectureService $lectureService, UserService $userService)
    {
        $this->learningGroupRepository = $learningGroupRepository;
        $this->lectureService = $lectureService;
        $this->userService = $userService;
    }

    /**
     * @param array $data
     * @return LearningGroup
     */
    public function createLearningGroup(array $data = [])
    {
        $learningGroup = new LearningGroup();
        if (isset($data['lectureId'])) {
            $learningGroup->setLectureId($data['lectureId']);
        } else {
            $user = $this->userService->getUserById($data['userId']);
            $lecture = new Lecture();
            $lecture->setName($data['lectureName']);
            $lecture->setUniversityId($user->getUniversityId());
            $lecture->setCourseId($user->getCourseId());
            $lecture = $this->lectureService->createLecture($lecture);
            $learningGroup->setLectureId($lecture->getId());
        }
        $learningGroup->setLocation($data['location']);
        return $this->learningGroupRepository->save($learningGroup);
    }

    public function getAvailableLearningGroups($userId)
    {
        $user = $this->userService->getUserById($userId);
        return $this->learningGroupRepository->findAllByUniversityIdAndCourseId(
            $user->getUniversityId(),
            $user->getCourseId());
    }
}

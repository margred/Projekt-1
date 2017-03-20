<?php

namespace HAWMS\service;

use HAWMS\model\LearningGroup;
use HAWMS\repository\LearningGroupRepository;

class LearningGroupService
{
    private $learningGroupRepository;
    private $lectureService;

    /**
     * LearningGroupService constructor.
     * @param LearningGroupRepository $learningGroupRepository
     */
    public function __construct(LearningGroupRepository $learningGroupRepository, LectureService $lectureService)
    {
        $this->learningGroupRepository = $learningGroupRepository;
        $this->lectureService = $lectureService;
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
            $lecture = $this->lectureService->createLecture($data['lectureName']);
            $learningGroup->setLectureId($lecture->getId());
        }
        $learningGroup->setLocation($data['location']);
        return $this->learningGroupRepository->save($learningGroup);
    }
}

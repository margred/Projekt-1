<?php

namespace HAWMS\controller;

use HAWMS\http\Request;
use HAWMS\service\LearningGroupService;
use HAWMS\service\LectureService;

class LearningGroupController extends Controller
{
    private $lectureCourseService;
    private $learningGroupService;

    /**
     * LearningGroupController constructor.
     * @param LectureService $lectureCourseService
     * @param LearningGroupService $learningGroupService
     */
    public function __construct(LectureService $lectureCourseService, LearningGroupService $learningGroupService)
    {
        $this->lectureCourseService = $lectureCourseService;
        $this->learningGroupService = $learningGroupService;
    }

    /**
     * @param Request $request
     * @return ViewModel
     */
    public function add(Request $request)
    {
        $userId = $_SESSION['user']->getId();
        if ($request->isPost()) {
            $data = $request->getBody();
            $lectureId = null;
            if (isset($data['lectureId']) && $data['lectureId'] != -1) {
                $lectureId = $data['lectureId'];
            }
            $this->learningGroupService->createLearningGroup([
                'userId' => $userId,
                'lectureId' => $lectureId,
                'lectureName' => $data['lectureName'],
                'location' => $data['location']
            ]);
        }
        return new ViewModel('learning-group-add', [
            'lectureCourses' => $this->lectureCourseService->getLearningCoursesForUserId($userId)
        ]);
    }
}

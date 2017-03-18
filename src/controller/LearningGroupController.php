<?php

namespace HAWMS\controller;

use HAWMS\http\Request;
use HAWMS\service\LearningGroupService;
use HAWMS\service\LectureCourseService;

class LearningGroupController extends Controller
{
    private $lectureCourseService;
    private $learningGroupService;

    /**
     * LearningGroupController constructor.
     * @param LectureCourseService $lectureCourseService
     * @param LearningGroupService $learningGroupService
     */
    public function __construct(LectureCourseService $lectureCourseService, LearningGroupService $learningGroupService)
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
        if ($request->isPost()) {
            $data = $request->getBody();
            $this->learningGroupService->createLearningGroup([
                'lectureCourseId' => $data['lectureCourseId'],
                'lectureCourseName' => $data['lectureCourseName'],
                'location' => $data['location']
            ]);
        }
        $userId = $_SESSION['userId'];
        return new ViewModel('learning-group-add', [
            'lectureCourses' => $this->lectureCourseService->getLearningCoursesForUserId($userId)
        ]);
    }
}

<?php

namespace HAWMS\controller;

use HAWMS\service\LearningGroupService;

class ProfileController extends Controller
{
    private $learningGroupService;

    /**
     * ProfileController constructor.
     * @param LearningGroupService $learningGroupService
     */
    public function __construct(LearningGroupService $learningGroupService)
    {
        $this->learningGroupService = $learningGroupService;
    }

    public function profile()
    {
        $userId = $_SESSION['user']->getId();
        return new ViewModel('profile', [
            'learningGroups' => $this->learningGroupService->getLearningGroupsByUser($userId)
        ]);
    }
}

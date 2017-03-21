<?php

use HAWMS\controller\LearningGroupController;
use HAWMS\http\Request;
use HAWMS\model\LearningCourse;
use HAWMS\model\User;
use HAWMS\service\LearningGroupService;
use HAWMS\service\LectureService;
use PHPUnit\Framework\TestCase;

class LearningGroupControllerTest extends TestCase
{
    /**
     * @var LectureService
     */
    private $lectureService;

    /**
     * @var LearningGroupService
     */
    private $learningGroupService;

    /**
     * @var LearningGroupController
     */
    private $learningGroupController;

    protected function setUp()
    {
        $this->lectureService = $this->createMock(LectureService::class);
        $this->learningGroupService = $this->createMock(LearningGroupService::class);
        $this->learningGroupController = new LearningGroupController($this->lectureService, $this->learningGroupService);
    }

    public function testShouldReturnViewModel()
    {
        $userId = 2345;
        $user = new User();
        $user->setId($userId);
        $_SESSION['user'] = $user;
        $learningCourses = [
            new LearningCourse()
        ];
        $this->lectureService->expects($this->once())
            ->method('getLearningCoursesForUserId')
            ->with($userId)
            ->willReturn($learningCourses);

        $request = new Request();
        $viewModel = $this->learningGroupController->add($request);

        $this->assertNotNull($viewModel);
        $this->assertEquals('learning-group-add', $viewModel->getViewName());
        $this->assertSame($viewModel->getModel()['lectureCourses'], $learningCourses);
    }

    public function testWhenRequestIsPost_ShouldCreateLearningGroup()
    {
        $request = new Request([
            'method' => 'POST',
            'body' => [
                'lectureId' => 23,
                'lectureName' => 'Programmieren 1',
                'location' => 'Raum E62'
            ]
        ]);
        $this->learningGroupService->expects($this->once())
            ->method('createLearningGroup')
            ->with($this->callback(function ($createGroupParams) {
                return isset($createGroupParams['lectureId']) && $createGroupParams['lectureId'] == 23 &&
                    isset($createGroupParams['lectureName']) && $createGroupParams['lectureName'] == 'Programmieren 1' &&
                    isset($createGroupParams['location']) && $createGroupParams['location'] = 'Raum E62';
            }));

        $this->learningGroupController->add($request);
    }
}

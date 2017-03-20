<?php

use HAWMS\controller\LearningGroupController;
use HAWMS\http\Request;
use HAWMS\model\LearningCourse;
use HAWMS\service\LearningGroupService;
use HAWMS\service\LectureCourseService;
use PHPUnit\Framework\TestCase;

class LearningGroupControllerTest extends TestCase
{
    /**
     * @var LectureCourseService
     */
    private $lectureCourseService;

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
        $this->lectureCourseService = $this->createMock(LectureCourseService::class);
        $this->learningGroupService = $this->createMock(LearningGroupService::class);
        $this->learningGroupController = new LearningGroupController($this->lectureCourseService, $this->learningGroupService);
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
        $this->lectureCourseService->expects($this->once())
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
                'lectureCourseId' => 23,
                'lectureCourseName' => 'Programmieren 1',
                'location' => 'Raum E62'
            ]
        ]);
        $this->learningGroupService->expects($this->once())
            ->method('createLearningGroup')
            ->with($this->callback(function ($createGroupParams) {
                return isset($createGroupParams['lectureCourseId']) && $createGroupParams['lectureCourseId'] == 23 &&
                    isset($createGroupParams['lectureCourseName']) && $createGroupParams['lectureCourseName'] == 'Programmieren 1' &&
                    isset($createGroupParams['location']) && $createGroupParams['location'] = 'Raum E62';
            }));

        $this->learningGroupController->add($request);
    }
}

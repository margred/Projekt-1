<?php

use HAWMS\model\LearningGroup;
use HAWMS\model\Lecture;
use HAWMS\model\User;
use HAWMS\repository\LearningGroupRepository;
use HAWMS\service\LearningGroupService;
use HAWMS\service\LectureService;
use HAWMS\service\UserService;
use PHPUnit\Framework\TestCase;

class LearningGroupServiceTest extends TestCase
{
    /**
     * @var LearningGroupRepository
     */
    private $learningGroupRepository;

    /**
     * @var UserService
     */
    private $userService;

    /**
     * @var LearningGroupService
     */
    private $learningGroupService;

    protected function setUp()
    {
        $this->learningGroupRepository = $this->createMock(LearningGroupRepository::class);
        $this->lectureService = $this->createMock(LectureService::class);
        $this->userService = $this->createMock(UserService::class);
        $this->learningGroupService = new LearningGroupService($this->learningGroupRepository, $this->lectureService, $this->userService);
    }

    public function testWhenLectureCourseIdIsSet_ShouldCreateLearningGroupWithLectureId()
    {
        $data = [
            'lectureId' => 3487,
            'lectureCourseName' => 'Programmieren 1',
            'location' => 'E62'
        ];
        $learningGroup = new LearningGroup();
        $this->learningGroupRepository->expects($this->once())
            ->method('save')
            ->with($this->callback(function ($learningGroup) {
                return $learningGroup->getLectureId() == 3487
                    && $learningGroup->getLocation() == 'E62';
            }))
            ->willReturn($learningGroup);

        $actualLearningGroup = $this->learningGroupService->createLearningGroup($data);

        $this->assertSame($actualLearningGroup, $learningGroup);
    }


    public function testWhenLectureCourseIdIsNotSet_ShouldCreateLecture()
    {
        $data = [
            'userId' => 1234,
            'lectureName' => 'Programmieren 1',
            'location' => 'E62'
        ];
        $lecture = new Lecture();
        $lecture->setId(12345);
        $learningGroup = new LearningGroup();
        $this->lectureService->expects($this->once())
            ->method('createLecture')
            ->willReturn($lecture);
        $this->learningGroupRepository->expects($this->once())
            ->method('save')
            ->with($this->callback(function ($learningGroup) {
                return $learningGroup->getLectureId() == 12345
                    && $learningGroup->getLocation() == 'E62';
            }))
            ->willReturn($learningGroup);
        $this->userService->method('getUserById')
            ->willReturn(new User());

        $actualLearningGroup = $this->learningGroupService->createLearningGroup($data);

        $this->assertSame($actualLearningGroup, $learningGroup);
    }
}

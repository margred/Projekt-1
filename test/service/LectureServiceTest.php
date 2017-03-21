<?php

use HAWMS\exception\UserNotFoundException;
use HAWMS\model\LearningCourse;
use HAWMS\model\User;
use HAWMS\repository\LectureRepository;
use HAWMS\service\LectureService;
use HAWMS\service\UserService;

class LectureServiceTest extends \PHPUnit\Framework\TestCase
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
     * @var LectureService
     */
    private $lectureService;

    protected function setUp()
    {
        $this->lectureRepository = $this->createMock(LectureRepository::class);
        $this->userService = $this->createMock(UserService::class);
        $this->lectureService = new LectureService($this->lectureRepository, $this->userService);
    }

    public function testShouldReturnLectureCoursesByUsersUniversityAndCourse()
    {
        $userId = 3455;
        $user = new User();
        $user->setUniversityId(89);
        $user->setCourseId(3434);
        $this->userService->expects($this->once())
            ->method('getUserById')
            ->with($userId)
            ->willReturn($user);
        $lectureCourses = [new LearningCourse()];
        $this->lectureRepository->expects($this->once())
            ->method('findAllByUniversityIdAndCourseId')
            ->with($user->getUniversityId(), $user->getCourseId())
            ->willReturn($lectureCourses);

        $actualLearningCourses = $this->lectureService->getLearningCoursesForUserId($userId);

        $this->assertSame($lectureCourses, $actualLearningCourses);
    }

    public function testWhenUserIsNull_ShouldThrowUserNotFoundException()
    {
        $userId = 3455;
        $this->userService->expects($this->once())
            ->method('getUserById')
            ->with($userId)
            ->willReturn(null);
        $this->expectException(UserNotFoundException::class);

        $this->lectureService->getLearningCoursesForUserId($userId);
    }
}

<?php

use HAWMS\model\Course;
use HAWMS\repository\CourseRepository;
use HAWMS\service\CourseService;
use PHPUnit\Framework\TestCase;

class CourseServiceTest extends TestCase
{
    /**
     * @var CourseRepository
     */
    private $courseRepository;

    /**
     * @var CourseService
     */
    private $courseService;

    protected function setUp()
    {
        $this->courseRepository = $this->createMock(CourseRepository::class);
        $this->courseService = new CourseService($this->courseRepository);
    }


    public function testShouldReturnAllFoundCourses()
    {
        $expectedCourses = [
            new Course(),
            new Course()
        ];
        $this->courseRepository->method('findAll')
            ->wilLReturn($expectedCourses);

        $actualCourses = $this->courseService->getCourses();

        $this->assertSame($expectedCourses, $actualCourses);
    }
}

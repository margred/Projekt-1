<?php

namespace HAWMS\service;

use HAWMS\repository\CourseRepository;

class CourseService
{
    private $courseRepository;

    /**
     * CourseService constructor.
     * @param CourseRepository $courseRepository
     */
    public function __construct(CourseRepository $courseRepository)
    {
        $this->courseRepository = $courseRepository;
    }

    public function getCourses()
    {
        return $this->courseRepository->findAll();
    }
}

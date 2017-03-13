<?php

namespace HAWMS\service;

use HAWMS\model\University;
use HAWMS\repository\UniversityRepository;

class UniversityService
{
    /**
     * @var UniversityRepository
     */
    private $universityRepository;

    /**
     * UniversityService constructor.
     * @param UniversityRepository $universityRepository
     */
    public function __construct(UniversityRepository $universityRepository)
    {
        $this->universityRepository = $universityRepository;
    }

    /**
     * @return University[]
     */
    public function getUniversities()
    {
        return $this->universityRepository->findAll();
    }
}

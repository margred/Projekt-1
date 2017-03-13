<?php

use HAWMS\model\University;
use HAWMS\repository\UniversityRepository;
use HAWMS\service\UniversityService;

class UniversityServiceTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @var UniversityRepository
     */
    private $universityRepository;

    /**
     * @var UniversityService
     */
    private $universityService;

    protected function setUp()
    {
        $this->universityRepository = $this->createMock(UniversityRepository::class);
        $this->universityService = new UniversityService($this->universityRepository);
    }

    public function testShouldReturnAllFoundUniversities()
    {
        $expectedUniversities = [
            new University(1, 'HAW Hamburg'),
            new University(2, 'University Hamburg')
        ];
        $this->universityRepository->method('findAll')
            ->wilLReturn($expectedUniversities);

        $actualUniversities = $this->universityService->getUniversities();

        $this->assertSame($expectedUniversities, $actualUniversities);
    }
}

<?php

namespace HAWMS\repository;

use HAWMS\model\LearningCourse;
use PDO;

class LectureRepository
{
    /**
     * @var PDO
     */
    private $connection;

    /**
     * LectureCourseRepository constructor.
     * @param PDO $connection
     */
    public function __construct(PDO $connection)
    {
        $this->connection = $connection;
    }

    /**
     * @param int $universityId
     * @param int $courseId
     * @return LearningCourse[]
     */
    public function findAllByUniversityIdAndCourseId(int $universityId, int $courseId)
    {
        $stmt = $this->connection->prepare('SELECT * FROM lectures WHERE university_id = :universityId AND course_id = :courseId');
        $stmt->bindValue(':universityId', $universityId, PDO::PARAM_INT);
        $stmt->bindValue(':courseId', $courseId, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_CLASS, 'HAWMS\model\Lecture');
    }
}

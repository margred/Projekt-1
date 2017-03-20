<?php

namespace HAWMS\repository;

use HAWMS\model\LearningCourse;
use HAWMS\model\Lecture;
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
     * @param Lecture $lecture
     * @return Lecture
     */
    public function save(Lecture $lecture)
    {
        $stmt = $this->connection->prepare('INSERT INTO lectures(name, university_id, course_id) VALUES (:name, :universityId, :courseId)');
        $stmt->bindValue(':name', $lecture->getName(), PDO::PARAM_STR);
        $stmt->bindValue(':universityId', $lecture->getUniversityId(), PDO::PARAM_STR);
        $stmt->bindValue(':courseId', $lecture->getCourseId(), PDO::PARAM_STR);
        $stmt->execute();
        return $this->findById($this->connection->lastInsertId());
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

    /**
     * @param int $id
     * @return Lecture
     */
    public function findById(int $id) {
        $stmt = $this->connection->prepare('SELECT * FROM lectures WHERE id = :id');
        $stmt->execute(array('id' => $id));
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'HAWMS\model\Lecture');
        return $stmt->fetch();
    }
}

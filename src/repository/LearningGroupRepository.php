<?php

namespace HAWMS\repository;

use HAWMS\model\LearningGroup;
use PDO;

class LearningGroupRepository
{
    /**
     * @var PDO
     */
    private $connection;

    /**
     * UserRepository constructor.
     * @param PDO $connection
     */
    public function __construct(PDO $connection)
    {
        $this->connection = $connection;
    }

    /**
     * @param LearningGroup $learningGroup
     * @return LearningGroup
     */
    public function save(LearningGroup $learningGroup)
    {
        $stmt = $this->connection->prepare('INSERT INTO learning_groups(lecture_id, location) VALUES (:lectureId, :location)');
        $stmt->bindValue(':lectureId', $learningGroup->getLectureId(), PDO::PARAM_INT);
        $stmt->bindValue(':location', $learningGroup->getLocation(), PDO::PARAM_STR);
        $stmt->execute();
        return $this->findById($this->connection->lastInsertId());
    }

    private function findById($id)
    {
        $stmt = $this->connection->prepare('SELECT * FROM learning_groups WHERE id = :id');
        $stmt->execute(array('id' => $id));
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'HAWMS\model\LearningGroup');
        return $stmt->fetch();
    }

    public function findAllByUniversityIdAndCourseId($universityId, $courseId)
    {
        $stmt = $this->connection->prepare('SELECT *, l.name as lecture FROM learning_groups lg INNER JOIN lectures l ON l.id = lg.lecture_id WHERE l.university_id = :universityId AND l.course_id = :courseId');
        $stmt->bindValue(':universityId', $universityId, PDO::PARAM_INT);
        $stmt->bindValue(':courseId', $courseId, PDO::PARAM_STR);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'HAWMS\model\LearningGroup');
        return $stmt->fetchAll();
    }

    public function addUser($learningGroupId, $userId)
    {
        $stmt = $this->connection->prepare('INSERT INTO learning_groups_users(learning_group_id, user_id) VALUES (:learningGroupId, :userId)');
        $stmt->bindValue(':learningGroupId', $learningGroupId, PDO::PARAM_INT);
        $stmt->bindValue(':userId', $userId, PDO::PARAM_STR);
        return $stmt->execute();
    }
}

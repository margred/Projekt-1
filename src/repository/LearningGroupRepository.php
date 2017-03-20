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
}

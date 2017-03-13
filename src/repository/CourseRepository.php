<?php

namespace HAWMS\repository;

use PDO;

class CourseRepository
{
    /**
     * @var PDO
     */
    private $connection;

    /**
     * CourseRepository constructor.
     * @param \PDO $connection
     */
    public function __construct(\PDO $connection)
    {
        $this->connection = $connection;
    }

    public function findAll()
    {
        $result = $this->connection->query('SELECT * FROM courses');
        $result->setFetchMode(PDO::FETCH_CLASS, 'HAWMS\model\Course');
        return $result->fetchAll();
    }
}

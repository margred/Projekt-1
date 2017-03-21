<?php

namespace HAWMS\repository;

use PDO;

class UniversityRepository
{
    /**
     * @var PDO
     */
    private $connection;

    /**
     * UniversityRepository constructor.
     */
    public function __construct(\PDO $connection)
    {
        $this->connection = $connection;
    }

    public function findAll()
    {
        $result = $this->connection->query('SELECT * FROM universities');
        $result->setFetchMode(PDO::FETCH_CLASS, 'HAWMS\model\University');
        return $result->fetchAll();
    }
}

<?php

namespace HAWMS\repository;

use HAWMS\model\User;
use PDO;

class UserRepository
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
     * @param User $user
     * @return User
     */
    public function save(User $user)
    {
        $stmt = $this->connection->prepare('INSERT INTO users(email, password, first_name, last_name, university_id, course_id) VALUES(:email, :password, :firstName, :lastName, :universityId, :courseId)');
        $stmt->bindValue(':email', $user->getEmail(), PDO::PARAM_STR);
        $stmt->bindValue(':password', $user->getPassword(), PDO::PARAM_STR);
        $stmt->bindValue(':firstName', $user->getFirstName(), PDO::PARAM_STR);
        $stmt->bindValue(':lastName', $user->getLastName(), PDO::PARAM_STR);
        $stmt->bindValue(':universityId', $user->getUniversityId(), PDO::PARAM_INT);
        $stmt->bindValue(':courseId', $user->getCourseId(), PDO::PARAM_INT);
        $stmt->execute();
        return $this->findById($this->connection->lastInsertId());
    }

    /**
     * @param int $id
     * @return User
     */
    public function findById(int $id) {
        $stmt = $this->connection->prepare('SELECT * FROM users WHERE id = :id');
        $stmt->execute(array('id' => $id));
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'HAWMS\model\User');
        return $stmt->fetch();
    }

    /**
     * @param string $email
     * @return User
     */
    public function findOneByEmail(string $email)
    {
        $stmt = $this->connection->prepare('SELECT * FROM users WHERE email = :email');
        $stmt->execute(array('email' => $email));
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'HAWMS\model\User');
        return $stmt->fetch();
    }
}

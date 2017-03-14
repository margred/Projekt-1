<?php

namespace HAWMS\model;

class User
{
    protected $mapping = [
        'first_name' => 'firstName',
        'last_name' => 'lastName',
        'university_id' => 'universityId',
        'course_id' => 'courseId'
    ];

    private $id;
    private $email;
    private $password;
    private $firstName;
    private $lastName;
    private $universityId;
    private $courseId;

    function __set($name, $value)
    {
        if (isset($this->mapping[$name])) {
            $propertyName = $this->mapping[$name];
            $this->$propertyName = $value;
        }
    }


    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param string $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }

    /**
     * @return string
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * @param string $firstName
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;
    }

    /**
     * @return string
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * @param string $lastName
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;
    }

    /**
     * @return int
     */
    public function getUniversityId()
    {
        return $this->universityId;
    }

    /**
     * @param int $universityId
     */
    public function setUniversityId($universityId)
    {
        $this->universityId = $universityId;
    }

    /**
     * @return int
     */
    public function getCourseId()
    {
        return $this->courseId;
    }

    /**
     * @param int $courseId
     */
    public function setCourseId($courseId)
    {
        $this->courseId = $courseId;
    }
}

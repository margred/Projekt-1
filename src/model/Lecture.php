<?php

namespace HAWMS\model;

class Lecture
{
    private $id;
    private $name;
    private $universityId;
    private $courseId;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getUniversityId()
    {
        return $this->universityId;
    }

    /**
     * @param mixed $universityId
     */
    public function setUniversityId($universityId)
    {
        $this->universityId = $universityId;
    }

    /**
     * @return mixed
     */
    public function getCourseId()
    {
        return $this->courseId;
    }

    /**
     * @param mixed $courseId
     */
    public function setCourseId($courseId)
    {
        $this->courseId = $courseId;
    }
}

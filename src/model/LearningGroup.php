<?php

namespace HAWMS\model;

class LearningGroup
{
    private $id;
    private $lectureId;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return int
     */
    public function getLectureId()
    {
        return $this->lectureId;
    }

    /**
     * @param int $lectureId
     */
    public function setLectureId($lectureId)
    {
        $this->lectureId = $lectureId;
    }

    /**
     * @return string
     */
    public function getLocation()
    {
        return $this->location;
    }

    /**
     * @param string $location
     */
    public function setLocation($location)
    {
        $this->location = $location;
    }
    private $location;
}

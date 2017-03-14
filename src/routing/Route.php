<?php

namespace HAWMS\routing;

class Route
{
    private $pattern;
    private $params;

    public function __construct(string $pattern, array $params)
    {
        $this->pattern = $pattern;
        $this->params = $params;
    }

    /**
     * @return string
     */
    public function getPattern(): string
    {
        return $this->pattern;
    }

    /**
     * @return array
     */
    public function getParams()
    {
        return $this->params;
    }
}

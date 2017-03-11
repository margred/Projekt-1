<?php

namespace HAWMS\view;

class View {
    private $path;

    /**
     * View constructor.
     * @param string $path
     */
    public function __construct(string $path = null)
    {
        $this->path = $path;
    }

    /**
     * @return string
     */
    public function getPath(): string
    {
        return $this->path;
    }
}

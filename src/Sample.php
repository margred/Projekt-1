<?php

namespace HAWMS;

class Sample
{
    private $num = 0;

    public function increase()
    {
        $this->num += 1;
    }

    public function decrease()
    {
        $this->num -= 1;
    }

    public function getNum()
    {
        return $this->num;
    }
}

<?php

namespace AppBundle\Service;


class TolikService
{
    private $arg;
    public function __construct($a)
    {
        return $this->arg = $a;
    }

    public function myserv($str)
    {
        return $this->arg
            ->transform($str);;
    }
}
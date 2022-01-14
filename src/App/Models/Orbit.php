<?php

namespace App\Models;

use App\Models\Traits\HasName;

class Orbit
{
    
    use HasName;

    private $length;
    private $numCrater;
    private $maxSpeed;

    function __construct($name, $length, $numCrater)
    {
        $this->name = $name;
        $this->length = $length;
        $this->numCrater = $numCrater;
    }

    public function getLength()
    {
        return $this->length;
    }

    public function getNumCrater()
    {
        return $this->numCrater;
    }

    public function getMaxSpeed()
    {
        return $this->maxSpeed;
    }

    public function setNumCrater($numCrater)
    {
        $this->numCrater = $numCrater;
        return $this;
    }

    public function setMaxSpeed($maxSpeed)
    {
        $this->maxSpeed = $maxSpeed;
        return $this;
    }
}

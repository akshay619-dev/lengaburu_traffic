<?php

namespace App\Models;

use App\Models\Traits\HasName;
use App\Utils\Helper;

class Vehicle
{
    use HasName;

    private $speed;
    private $craterSpeed;
    private $travelsIn;


    function __construct($name, $speed, $craterSpeed, $travelsIn)
    {
        $this->name = $name;
        $this->speed = $speed;
        $this->craterSpeed = $craterSpeed;
        $this->travelsIn = $travelsIn;
    }

    public function getSpeed()
    {
        return $this->speed;
    }

    public function setSpeed($speed)
    {
        $this->speed = $speed;
        return $this;
    }

    public function getCraterSpeed()
    {
        return $this->craterSpeed;
    }

    public function getTravelsIn()
    {
        return $this->travelsIn;
    }

    public function canTravelIn($weather)
    {
        return Helper::inObjectArray($this->travelsIn, 'getName', $weather);
    }
}

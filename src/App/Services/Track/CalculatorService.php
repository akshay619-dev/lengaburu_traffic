<?php

namespace App\Services\Track;

use App\Interfaces\Service;
use App\Models\{Vehicle, Orbit};

class CalculatorService implements Service
{
    private $vehicle;
    private $orbit;

    function __construct(Vehicle $vehicle, Orbit $orbit)
    {
        $this->vehicle = $vehicle;
        $this->orbit = $orbit;
    }

    /**
     * return time in hour required for passing Crater
     * @var Vehicle 
     * @var Orbit
     */
    public function handle()
    {
        $speed = $this->orbit->getMaxSpeed() > $this->vehicle->getSpeed() ? $this->vehicle->getSpeed() : $this->orbit->getMaxSpeed();

        return ($this->orbit->getLength() / $speed);
    }
}

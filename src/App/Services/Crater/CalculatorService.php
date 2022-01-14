<?php

namespace App\Services\Crater;

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
        /**
         * convert minutes to hrs
         */
        return $this->vehicle->getCraterSpeed() * $this->orbit->getNumCrater() / 60;
    }
}

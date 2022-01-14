<?php

declare(strict_types=1);

require './src/autoload.php';

use PHPUnit\Framework\TestCase;
use App\Models\Vehicle;
use App\Models\Weather;

final class VehicleTest extends TestCase
{

    private $vehicle;
    private $weather1;
    private $weather2;

    protected function setUp(): void
    {
        $this->weather1 = new Weather('RAINY', -10);
        $this->weather2 = new Weather('WINDY', 20);
        $this->vehicle = new Vehicle('CAR', 13, 3, [$this->weather1, $this->weather2]);
    }

    public function testThatCanBeCreated(): void
    {
        $this->assertInstanceOf(
            Vehicle::class,
            $this->vehicle
        );
    }

    public function testThatVehicleNameCanBeSet()
    {
        $this->assertEquals($this->vehicle->getName(), 'CAR');
    }

    public function testThatVehicleSpeedCanBeSet()
    {
        $this->assertEquals($this->vehicle->getSpeed(), 13);
        $this->vehicle->setSpeed(15);
        $this->assertEquals($this->vehicle->getSpeed(), 15);
    }

    public function testThatVehicleCraterSpeedCanBeSet()
    {
        $this->assertEquals($this->vehicle->getCraterSpeed(), 3);
    }

    public function testThatVehicleTravelInCanBeSet()
    {
        $this->assertNotEmpty($this->vehicle->getTravelsIn());
        $this->assertTrue(is_array($this->vehicle->getTravelsIn()));

        $this->assertInstanceOf(
            Weather::class,
            $this->vehicle->getTravelsIn()[0]
        );
        $this->assertInstanceOf(
            Weather::class,
            $this->vehicle->getTravelsIn()[1]
        );

        $this->assertEquals($this->vehicle->getTravelsIn()[0], $this->weather1);
        $this->assertEquals($this->vehicle->getTravelsIn()[1], $this->weather2);
    }

    public function testThatVehicleCanTravelInRainyWeather()
    {
        $this->assertTrue(
            $this->vehicle->canTravelIn('RAINY')
        );
    }

    public function testThatVehicleCanTravelInSunnyWeather()
    {
        $this->assertFalse(
            $this->vehicle->canTravelIn('SUNNY')
        );
    }
}

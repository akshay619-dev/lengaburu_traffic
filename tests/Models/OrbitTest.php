<?php

declare(strict_types=1);

require './src/autoload.php';

use PHPUnit\Framework\TestCase;
use App\Models\Orbit;

final class OrbitTest extends TestCase
{
    public function testThatOrbitCanBeCreated(): void
    {
        $this->assertInstanceOf(
            Orbit::class,
            new Orbit('ORBIT1', 20, 10)
        );
    }

    public function testThatOrbitNameCanBeSet()
    {
        $orbit = new Orbit('ORBIT1', 20, 10);
        $this->assertEquals($orbit->getName(), 'ORBIT1');
    }

    public function testThatOrbitLengthCanBeSet()
    {
        $orbit = new Orbit('ORBIT1', 20, 10);
        $this->assertEquals($orbit->getLength(), 20);
    }

    public function testThatOrbitCraterCanBeSet()
    {
        $orbit = new Orbit('ORBIT1', 20, 10);
        $this->assertEquals($orbit->getNumCrater(), 10);
        $orbit->setNumCrater(14);
        $this->assertEquals($orbit->getNumCrater(), 14);
    }

    public function testThatOrbitMaxSpeedCanBeSet()
    {
        $orbit = (new Orbit('ORBIT1', 20, 10))->setMaxSpeed(25);
        $this->assertEquals($orbit->getMaxSpeed(), 25);
    }


}

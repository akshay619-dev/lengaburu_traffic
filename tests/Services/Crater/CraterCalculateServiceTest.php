<?php

declare(strict_types=1);

require './src/autoload.php';

use PHPUnit\Framework\TestCase;
use App\Models\{Orbit, Weather, Vehicle};
use App\Services\Crater\CalculatorService;

final class CraterCalculateServiceTest extends TestCase
{
    private $orbit;
    private $vehicle;

    protected function setUp(): void
    {
        $weather = new Weather('WINDY', 0);
        $this->vehicle = new Vehicle('CAR', 20, 3, [$weather]);
        $this->orbit = new Orbit('ORBIT2', 20, 10);
    }

    public function testThatCraterCalculatorCanCalculateScore(): void
    {
        $this->orbit->setMaxSpeed(20);
        $this->assertEquals(
           (new CalculatorService($this->vehicle, $this->orbit))->handle(),
            .5
        );
    }
}

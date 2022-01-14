<?php

declare(strict_types=1);

require './src/autoload.php';

use PHPUnit\Framework\TestCase;
use App\Models\Weather;

final class WeatherTest extends TestCase
{
    public function testThatCanBeCreated(): void
    {
        $this->assertInstanceOf(
            Weather::class,
            new Weather('SUNNY', 13)
        );
    }

    public function testThatWeatherNameCanBeSet()
    {
        $weather = new Weather('SUNNY', 13);
        $this->assertEquals($weather->getName(), 'SUNNY');
    }

    public function testThatWeatherEffectCanBeSet()
    {
        $weather = new Weather('SUNNY', 13);
        $this->assertEquals($weather->getEffect(), 13);
    }
}

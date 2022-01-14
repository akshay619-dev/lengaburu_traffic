<?php

declare(strict_types=1);

require './src/autoload.php';

use App\Models\Weather;
use App\Utils\Helper;
use PHPUnit\Framework\TestCase;

final class HelperTest extends TestCase
{

    private $heystack;

    protected function setUp(): void
    {
        $this->heystack = [
            new Weather('SUNNY', 10),
            new Weather('RAINY', 20),
            new Weather('WINDY', 30)
        ];
    }

    public function testThatHelperCanCheckStringInSideObjectArray(): void
    {
        $this->assertTrue(
            Helper::inObjectArray($this->heystack, 'getName', 'SUNNY')
        );
        $this->assertFalse(
            Helper::inObjectArray($this->heystack, 'getName', 'MONSOON')
        );
    }

    public function testThatHelperCanFindInSideObjectArray(): void
    {
        $this->assertNotEmpty(
            Helper::findObjectArray($this->heystack, 'getName', 'SUNNY')
        );
        $this->assertNull(
            Helper::findObjectArray($this->heystack, 'getName', 'MONSOON')
        );
        $this->assertInstanceOf(
            Weather::class,
            Helper::findObjectArray($this->heystack, 'getName', 'SUNNY')
        );
    }

    public function testThatHelperCanReadFile(): void
    {
        $this->assertIsArray(
            Helper::readFile('input.txt')
        );
    }

    public function testThatReadFileHelperThrowsException(): void
    {
        $this->expectException(Exception::class);
        Helper::readFile('../input.txt');
    }
}

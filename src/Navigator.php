<?php

use App\Models\{Orbit, Vehicle, Weather};
use App\Services\Track\CalculatorService as TrackCalculatorService;
use App\Services\Crater\CalculatorService as CraterCalculatorService;
use App\Services\ScoreFinder;
use App\Utils\Helper;

class Navigator
{

    private static $weathers = [];
    private static $vehicles = [];
    private static $orbits = [];
    private static $scores = [];

    private static function init()
    {
        $sunny = new Weather('SUNNY', -10);
        $rainy = new Weather('RAINY', 20);
        $windy = new Weather('WINDY', 0);

        self::$weathers = [$sunny, $rainy, $windy];

        self::$vehicles = [
            new Vehicle('BIKE', 10, 2, [$sunny, $windy]),
            new Vehicle('TUKTUK', 12, 1, [$sunny, $rainy]),
            new Vehicle('CAR', 20, 3, [$sunny, $rainy, $windy]),
        ];

        self::$orbits = [
            new Orbit('ORBIT1', 18, 20),
            new Orbit('ORBIT2', 20, 10),
        ];
    }

    public static function handle($weather, $orbitSpeeds)
    {
        self::init();
        /**
         * getting eligible vehicles depending on weather
         */
        $eligibleVehicles = self::getEligibleVehicles($weather);

        /**
         * find weather object 
         */
        $weather = Helper::findObjectArray(self::$weathers, 'getName', $weather);

        foreach ($eligibleVehicles as $eligibleVehicle) {
            foreach (self::$orbits as $orbitKey => $orbit) {
                /**
                 * seeting max speed for vehicle and updating crater quantity based on weather
                 */
                $orbit->setMaxSpeed($orbitSpeeds[$orbitKey])
                    ->setNumCrater( $orbit->getNumCrater() + ($orbit->getNumCrater() * $weather->getEffect() / 100));

                /**
                 * ScoreFinder::find finds score for that vehicle and orbit based on Track, Crater factors
                 * you can add new factor in array passed to it 
                 */
                self::$scores["{$eligibleVehicle->getName()}-{$orbit->getName()}"] = ScoreFinder::find([
                    new TrackCalculatorService($eligibleVehicle, $orbit), 
                    new CraterCalculatorService($eligibleVehicle, $orbit)
                    // can be added new factor the class should implement Service Interface
                    // new MountainCalculateService($eligibleVehicle, $orbit);
                ]);
            }
        }

        /**
         * finally returns min score Key from array
         */
        echo str_replace('-', ' ', array_search(min(self::$scores), self::$scores)) . PHP_EOL;
    }

    private static function getEligibleVehicles($weather)
    {
        return array_filter(self::$vehicles, function ($vehicle) use ($weather) {
            return $vehicle->canTravelIn($weather);
        });
    }
}

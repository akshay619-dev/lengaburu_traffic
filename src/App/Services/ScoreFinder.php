<?php

namespace App\Services;


class ScoreFinder
{

    public static function find(array $calculators)
    {
        $resultant = [];

        foreach ($calculators as $calculator) {
            $resultant[] = Calculator::calculate($calculator);
        }

        return array_sum($resultant);
    }
}

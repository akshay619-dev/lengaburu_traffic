<?php

namespace App\Services;

use App\Interfaces\Service;

class Calculator {

    public static function calculate(Service $service){
        return $service->handle();
    }

}
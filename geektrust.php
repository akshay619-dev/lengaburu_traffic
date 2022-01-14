<?php

require './src/config.php';
require './src/autoload.php';

use App\Utils\Helper;

if (file_exists($argv[1])) {
    $lines = [];
    try{
        $lines = Helper::readFile($argv[1]);
    } catch (Exception $e) {
       die('Error: ' .$e->getMessage());
    }

    foreach ($lines as $line) {
        if(trim($line) !== '' && $line !== null){
            list($weather, $orbit1Speed, $orbit2Speed) = Helper::extractParams($line);
            Navigator::handle($weather, [(int) $orbit1Speed, (int) $orbit2Speed]);
        }
    }

} else {
    die('file path not found');
}

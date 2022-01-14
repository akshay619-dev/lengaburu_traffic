<?php

namespace App\Utils;

use Exception;

class Helper
{

    public static function inObjectArray($array, $index, $value)
    {
        foreach ($array as $arrayInf) {
            $compareWith = null;
            if (method_exists($arrayInf, $index)) {
                $compareWith = $arrayInf->$index();
            } else {
                $compareWith = $arrayInf->{$index};
            }

            if ($compareWith === $value) {
                return true;
            }
        }
        return false;
    }

    public static function findObjectArray($array, $index, $value)
    {
        foreach ($array as $arrayInf) {
            $compareWith = null;
            if (method_exists($arrayInf, $index)) {
                $compareWith = $arrayInf->$index();
            } else {
                $compareWith = $arrayInf->{$index};
            }

            if ($compareWith === $value) {
                return $arrayInf;
            }
        }
        return null;
    }

    public static function readFile($file)
    {
        if (!file_exists($file)) {
            throw new Exception("Unable to open File");
        }
        $fileObject = fopen($file, "r");
        $fileData = explode("\n", fread($fileObject, filesize($file)));
        fclose($fileObject);
        return $fileData;
    }

    public static function extractParams($line)
    {
        return explode(' ', trim($line));
    }
}

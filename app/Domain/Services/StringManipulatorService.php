<?php

namespace App\Domain\Services;

use App\Domain\Entities\StringEntity;

class StringManipulatorService
{
    public static function toAllUpperCase(StringEntity $stringEntity)
    {
        $stringEntity->updateString(self::toUpperCase($stringEntity->get()));

        return $stringEntity;
    }

    private static function toUpperCase(String $string) : String
    {
        return mb_convert_case($string, MB_CASE_UPPER, 'UTF-8');
    }
}

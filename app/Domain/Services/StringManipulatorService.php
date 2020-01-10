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

    protected static function toUpperCase(String $string) : String
    {
        return mb_convert_case($string, MB_CASE_UPPER, 'UTF-8');
    }

    public static function toAlternateCase(StringEntity $stringEntity) : void
    {
        $characters = str_split($stringEntity->get());
        //var_dump($characters);
        $result = '';
        foreach ($characters as $key => $character) {
            if ($key % 2 == 0) {
                $result .= self::toLowerCase($character);
                continue;
            }

            $result .= self::toUpperCase($character);
        }

        $stringEntity->updateString($result);
    }

    protected static function toLowerCase(String $string) : String
    {
        return mb_convert_case($string, MB_CASE_LOWER, 'UTF-8');
    }
}

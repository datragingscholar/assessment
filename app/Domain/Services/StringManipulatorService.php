<?php

namespace App\Domain\Services;

use App\Domain\Entities\StringEntity;

class StringManipulatorService implements iStringManipulator
{
    public function toAllUpperCase(StringEntity $stringEntity) : void
    {
        $stringEntity->updateString($this->toUpperCase($stringEntity->get()));
    }

    protected function toUpperCase(String $string) : String
    {
        return mb_convert_case($string, MB_CASE_UPPER, 'UTF-8');
    }

    public function toAlternateCase(StringEntity $stringEntity) : void
    {
        $characters = mb_str_split($stringEntity->get());

        $result = '';
        foreach ($characters as $key => $character) {
            if ($key % 2 == 0) {
                $result .= $this->toLowerCase($character);
                continue;
            }

            $result .= $this->toUpperCase($character);
        }

        $stringEntity->updateString($result);
    }

    protected function mb_str_split(String $string) : Array
    {
        return preg_split('/(?<!^)(?!$)/u', $string);
    }

    protected function toLowerCase(String $string) : String
    {
        return mb_convert_case($string, MB_CASE_LOWER, 'UTF-8');
    }
}

<?php

namespace App\Domain\Services;

use App\Domain\Entities\StringEntity;

class StringManipulatorService
{
    public static function toAllUpperCase(StringEntity $stringEntity)
    {
        $stringEntity->updateString(mb_convert_case($stringEntity->get(), MB_CASE_UPPER, 'UTF-8'));

        return $stringEntity;
    }
}

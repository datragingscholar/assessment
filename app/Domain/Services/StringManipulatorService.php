<?php

namespace App\Domain\Services;

use App\Domain\Entities\StringEntity;

class StringManipulatorService
{
    public static function toAllUpperCase(StringEntity $stringEntity)
    {
        $stringEntity->updateString('HELLO WORLD');

        return $stringEntity;
    }
}

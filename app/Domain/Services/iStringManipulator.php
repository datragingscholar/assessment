<?php

namespace App\Domain\Services;

interface iStringManipulator
{
    public function toAllUpperCase(\App\Domain\Entities\StringEntity $stringEntity) : void;
    public function toAlternateCase(\App\Domain\Entities\StringEntity $stringEntity) : void;
}

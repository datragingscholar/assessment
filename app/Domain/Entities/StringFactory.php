<?php

namespace App\Domain\Entities;

class StringFactory
{
    public function makeFromString(String $string) : StringEntity
    {
        return new StringEntity($string);
    }
}

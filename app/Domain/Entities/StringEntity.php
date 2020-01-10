<?php

namespace App\Domain\Entities;

class StringEntity
{
    protected $string = '';

    public function __construct(String $string)
    {
        $this->string = $string;
    }

    public function get() : String
    {
        return $this->string;
    }
}

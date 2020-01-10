<?php

namespace App\Persistance;

interface iStringPersistance
{
    public function currentPath() : String;
    public function persist(\App\Domain\Entities\StringEntity $stringEntity) : Bool;
    public function read() : \App\Domain\Entities\StringEntity;
}

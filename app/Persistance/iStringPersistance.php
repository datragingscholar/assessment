<?php

namespace App\Persistance;

interface iStringPersistance
{
    public function setCSVFilePath(String $csvFilePath) : void;
    public function currentCSVFilePath() : String;
    public function persist(\App\Domain\Entities\StringEntity $stringEntity) : Bool;
    public function read() : \App\Domain\Entities\StringEntity;
}

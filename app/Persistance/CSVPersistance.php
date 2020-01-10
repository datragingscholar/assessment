<?php

namespace App\Persistance;

use App\Domain\Entities\StringFactory;

class CSVPersistance
{
    protected $stringFactory;
    protected $path;

    public function __construct(StringFactory $stringFactory, $path)
    {
        $this->stringFactory = $stringFactory;
        $this->path = $path;
    }

    public function currentPath() : String
    {
        return $this->path;
    }
}

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

        $this->throwExceptionIfPathNotValid();
    }

    protected function throwExceptionIfPathNotValid()
    {
        try {
            new \SplFileObject($this->path, 'a+');
        } catch (\Exception | \RuntimeException $e) {
            throw new \InvalidArgumentException('The passed path, ' . $this->path . ', is not valid.');
        }
    }

    public function currentPath() : String
    {
        return $this->path;
    }
}

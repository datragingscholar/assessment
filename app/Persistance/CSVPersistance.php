<?php

namespace App\Persistance;

use League\Csv\Writer;
use App\Domain\Entities\StringFactory;
use App\Domain\Entities\StringEntity;

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

    public function persist(StringEntity $stringEntity) : Bool
    {
        $string_data = $stringEntity->get();
        $string_data = array_map('trim', preg_split('/(?<!^)(?!$)/u', $string_data));

        $writer = Writer::createFromPath($this->path, 'w+');
        $writer->insertOne($string_data);

        return true;
    }
}

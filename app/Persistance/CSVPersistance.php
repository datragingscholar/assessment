<?php

namespace App\Persistance;

use League\Csv\Writer;
use League\Csv\Reader;
use App\Domain\Entities\StringFactory;
use App\Domain\Entities\StringEntity;

class CSVPersistance implements iStringPersistance
{
    protected $stringFactory;
    protected $csvFilePath;

    public function __construct(StringFactory $stringFactory)
    {
        $this->stringFactory = $stringFactory;
    }

    public function setCSVFilePath(String $csvFilePath) : void
    {
        $this->csvFilePath = $csvFilePath;
        $this->throwExceptionIfPathNotValid();
    }

    protected function throwExceptionIfPathNotValid() : void
    {
        try {
            new \SplFileObject($this->csvFilePath, 'a+');
        } catch (\Exception | \RuntimeException $e) {
            throw new \InvalidArgumentException('The passed path, ' . $this->csvFilePath . ', is not valid.');
        }
    }

    public function currentCSVFilePath() : String
    {
        return $this->csvFilePath;
    }

    public function persist(StringEntity $stringEntity) : Bool
    {
        $this->throwExceptionIfPathNotValid();

        $string_data = $stringEntity->get();
        $string_data = $this->splitStringToArrayByCharacter($string_data);
        $string_data = $this->trimWhiteSpaceAsEmptyElement($string_data);

        $writer = Writer::createFromPath($this->csvFilePath, 'w+');
        $writer->insertOne($string_data);

        return true;
    }

    protected function splitStringToArrayByCharacter(String $string) : Array
    {
        return preg_split('/(?<!^)(?!$)/u', $string);
    }

    protected function trimWhiteSpaceAsEmptyElement(Array $array) : Array
    {
        return array_map('trim', $array);
    }

    public function read() : StringEntity
    {
        $reader = Reader::createFromPath($this->path, 'r');
        $record_data = $reader->fetchOne(0);
        $record_data = $this->repopulateEmptyElementWithWhiteSpace($record_data);
        $record_data = $this->reconstructCharacterSplitArrayToString($record_data);

        return $this->stringFactory->makeFromString($record_data);
    }

    protected function repopulateEmptyElementWithWhiteSpace(Array $array) : Array
    {
        return array_map(function ($column) {
            if (!$column) return ' ';

            return $column;
        }, $array);
    }

    protected function reconstructCharacterSplitArrayToString(Array $array) : String
    {
        return implode('', $array);
    }
}

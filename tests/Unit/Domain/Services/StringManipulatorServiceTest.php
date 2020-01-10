<?php

namespace Tests\Unit\Domain\Services;

use Tests\TestCase;
use App\Domain\Entities\StringEntity;
use App\Domain\Services\StringManipulatorService;

class StringManipulatorServiceTest extends TestCase
{
    /**
     * @test
     * @covers StringManipulator::toAllUpperCase
     */
    public function test_can_correctly_convert_to_uppercase()
    {
        $string = new StringEntity('hello world');
        StringManipulator::toAllUpperCase($string);
        $this->assertEquals('HELLO WORLD', $string->get());
    }
}
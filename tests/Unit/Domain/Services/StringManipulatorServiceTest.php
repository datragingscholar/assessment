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
        $roman = new StringEntity('hello world');
        StringManipulatorService::toAllUpperCase($roman);
        $this->assertEquals('HELLO WORLD', $roman->get());

        $latin = new StringEntity('àáâãäåæçèéêëìíîïðñòóôõöøùúûüý');
        StringManipulatorService::toAllUpperCase($latin);
        $this->assertEquals('ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜÝ', $latin->get());

        $non_latin = new StringEntity('Τάχιστη αλώπηξ βαφής ψημένη γη, δρασκελίζει υπέρ νωθρού κυνός');
        StringManipulatorService::toAllUpperCase($non_latin);
        $this->assertEquals('ΤΆΧΙΣΤΗ ΑΛΏΠΗΞ ΒΑΦΉΣ ΨΗΜΈΝΗ ΓΗ, ΔΡΑΣΚΕΛΊΖΕΙ ΥΠΈΡ ΝΩΘΡΟΎ ΚΥΝΌΣ', $non_latin->get());

        $multibyte = new StringEntity('白日依山尽ぃぅぇぉっゃ！。《》');
        StringManipulatorService::toAllUpperCase($multibyte);
        $this->assertEquals('白日依山尽ぃぅぇぉっゃ！。《》', $multibyte->get());

        $mixed = new StringEntity('1白!の日υπέρ is WhItê');
        StringManipulatorService::toAllUpperCase($mixed);
        $this->assertEquals('1白!の日ΥΠΈΡ IS WHITÊ', $mixed->get());
    }
}

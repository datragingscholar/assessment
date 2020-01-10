<?php

namespace Tests\Unit\Domain\Services;

use Tests\TestCase;
use App\Domain\Entities\StringEntity;
use App\Domain\Services\StringManipulatorService;

class StringManipulatorServiceTest extends TestCase
{
    protected $stringManipulator;

    public function setUp() : void
    {
        $this->stringManipulator = new StringManipulatorService();
    }

    /**
     * @test
     * @covers StringManipulator::toAllUpperCase
     */
    public function test_can_correctly_convert_to_uppercase()
    {
        $roman = new StringEntity('hello world');
        $this->stringManipulator->toAllUpperCase($roman);
        $this->assertEquals('HELLO WORLD', $roman->get());

        $latin = new StringEntity('àáâãäåæçèéêëìíîïðñòóôõöøùúûüý');
        $this->stringManipulator->toAllUpperCase($latin);
        $this->assertEquals('ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜÝ', $latin->get());

        $non_latin = new StringEntity('Τάχιστη αλώπηξ βαφής ψημένη γη, δρασκελίζει υπέρ νωθρού κυνός');
        $this->stringManipulator->toAllUpperCase($non_latin);
        $this->assertEquals('ΤΆΧΙΣΤΗ ΑΛΏΠΗΞ ΒΑΦΉΣ ΨΗΜΈΝΗ ΓΗ, ΔΡΑΣΚΕΛΊΖΕΙ ΥΠΈΡ ΝΩΘΡΟΎ ΚΥΝΌΣ', $non_latin->get());

        $multibyte = new StringEntity('白日依山尽ぃぅぇぉっゃ！。《》');
        $this->stringManipulator->toAllUpperCase($multibyte);
        $this->assertEquals('白日依山尽ぃぅぇぉっゃ！。《》', $multibyte->get());

        $mixed = new StringEntity('1白!の日υπέρ is WhItê');
        $this->stringManipulator->toAllUpperCase($mixed);
        $this->assertEquals('1白!の日ΥΠΈΡ IS WHITÊ', $mixed->get());
    }

    /**
     * @test
     * @covers StringManipulator::toAlternateCase
     */
    public function test_can_correctly_convert_to_alternate_case()
    {
        $roman = new StringEntity('hello world');
        $this->stringManipulator->toAlternateCase($roman);
        $this->assertEquals('hElLo wOrLd', $roman->get());

        $latin = new StringEntity('àáâ ãäåæçèéêëìíîïðñòóôõöøùúûüý');
        $this->stringManipulator->toAlternateCase($latin);
        $this->assertEquals('àÁâ ãÄåÆçÈéÊëÌíÎïÐñÒóÔõÖøÙúÛüÝ', $latin->get());

        $non_latin = new StringEntity('Τάχιστη αλώπηξ βαφής ψημένη γη, δρασκελίζει υπέρ νωθρού κυνός');
        $this->stringManipulator->toAlternateCase($non_latin);
        $this->assertEquals('τΆχΙσΤη αΛώΠηΞ ΒαΦήΣ ΨηΜέΝη γΗ, δΡαΣκΕλΊζΕι υΠέΡ ΝωΘρΟύ κΥνΌς', $non_latin->get());

        $multibyte = new StringEntity('白日依山尽ぃぅぇぉっゃ！。《》');
        $this->stringManipulator->toAllUpperCase($multibyte);
        $this->assertEquals('白日依山尽ぃぅぇぉっゃ！。《》', $multibyte->get());

        $mixed = new StringEntity('WhiTê αΛ白！日ぇis NOT υΠ》ýæ');
        $this->stringManipulator->toAlternateCase($mixed);
        $this->assertEquals('wHiTê αΛ白！日ぇiS NoT Υπ》ýÆ', $mixed->get());
    }
}

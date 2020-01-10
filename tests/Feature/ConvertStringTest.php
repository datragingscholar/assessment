<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ConvertStringTest extends TestCase
{
    public function test_command_should_run_correctly_without_options()
    {
        $this->artisan('string:convert',
                       ['string' => 'There should be code'])
            ->expectsOutput('THERE SHOULD BE CODE')
            ->expectsOutput('tHeRe sHoUlD Be cOdE')
            ->expectsOutput('File Created!')
            ->assertExitCode(0);

        $this->assertEquals('T,h,e,r,e,,s,h,o,u,l,d,,b,e,,c,o,d,e', trim(file_get_contents(getcwd() . '/test.csv')));
    }
}

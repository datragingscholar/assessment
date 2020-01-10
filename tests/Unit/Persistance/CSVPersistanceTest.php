<?php

namespace Tests\Unit\Persistance;

use Tests\TestCase;
use App\Persistance\CSVPersistance;

class CSVPersistanceTest extends TestCase
{
    /**
     * @test
     * @covers CSVPersistance::currentPath
     */
    public function test_can_initialize_and_get_path()
    {
        $path = getcwd() . '/test.csv';
        $csvPersistance = new CSVPersistance(
            new StringFactory,
            $path
        );

        $this->assertEquals($path, $csvPersistance->currentPath());
    }
}

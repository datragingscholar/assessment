<?php

namespace Tests\Unit\Persistance;

use Tests\TestCase;
use App\Persistance\CSVPersistance;
use App\Domain\Entities\StringFactory;

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

    /**
     * @test
     */
    public function test_path_should_be_valid()
    {
        $this->expectException(\InvalidArgumentException::class);

        $this->csvPersistance = new CSVpersistance(
            new StringFactory,
            'ao9e8hib, .9/ ]==/='
        );
    }
}

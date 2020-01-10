<?php

namespace Tests\Unit\Persistance;

use Tests\TestCase;
use App\Persistance\CSVPersistance;
use App\Domain\Entities\StringFactory;

class CSVPersistanceTest extends TestCase
{
    protected $tmpFiles = [];

    public function setUp() : void
    {
        register_shutdown_function(function () {
            foreach ($this->tmpFiles as $tmpFile)
            {
                if (file_exists($tmpFile))
                    unlink($tmpFile);
            }
        });
    }

    /**
     * @test
     * @covers CSVPersistance::currentPath
     */
    public function test_can_initialize_and_get_path()
    {
        $tmpFilePath = sys_get_temp_dir() . '/testpath.csv';
        $csvPersistance = new CSVPersistance(
            new StringFactory,
            //tempnam(sys_get_temp_dir(), 'PHPUnit') . '.csv'
            $tmpFilePath
        );
        $this->tmpFiles[] = $tmpFilePath;

        $this->assertEquals($tmpFilePath, $csvPersistance->currentPath());
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

<?php

namespace Tests\Unit\Persistance;

use Tests\TestCase;
use App\Persistance\CSVPersistance;
use App\Domain\Entities\StringFactory;
use App\Domain\Entities\StringEntity;

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
        $tmpFilePath = sys_get_temp_dir() . '/path_test.csv';
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

    /**
     * @test
     * @covers CSVPersistance::persist
     */
    public function test_can_correctly_persist()
    {
        $tmpFilePath = sys_get_temp_dir() . '/persist_test.csv';
        $csvPersistance = new CSVPersistance(
            new StringFactory,
            $tmpFilePath
        );
        $this->tmpFiles[] = $tmpFilePath;

        $stringEntity = new StringEntity('hello world');
        $csvPersistance->persist($stringEntity);
        $this->assertEquals('h,e,l,l,o,,w,o,r,l,d', trim(file_get_contents($tmpFilePath)));

        $stringEntity = new StringEntity('白!,の日υπέρ is WhItê《！');
        $csvPersistance->persist($stringEntity);
        $this->assertEquals('白,!,",",の,日,υ,π,έ,ρ,,i,s,,W,h,I,t,ê,《,！', trim(file_get_contents($tmpFilePath)));
    }
}

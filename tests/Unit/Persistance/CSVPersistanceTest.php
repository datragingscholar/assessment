<?php

namespace Tests\Unit\Persistance;

use Tests\TestCase;
use App\Persistance\CSVPersistance;
use App\Domain\Entities\StringFactory;
use App\Domain\Entities\StringEntity;

class CSVPersistanceTest extends TestCase
{
    protected $tmpFiles = [];
    protected $csvPersistance;

    public function setUp() : void
    {
        $this->csvPersistance = new CSVPersistance(new StringFactory);

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
    public function test_can_set_and_get_path()
    {
        $tmpFilePath = sys_get_temp_dir() . '/path_test.csv';
        $this->csvPersistance->setCSVFilePath($tmpFilePath);
        $this->tmpFiles[] = $tmpFilePath;

        $this->assertEquals($tmpFilePath, $this->csvPersistance->currentCSVFilePath());
    }

    /**
     * @test
     */
    public function test_path_should_be_valid()
    {
        $this->expectException(\InvalidArgumentException::class);

        $this->csvPersistance->setCSVFilePath('ao9e8hib, .9/ ]==/=');
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

    /**
     * @test
     * @covers CSVPersistance::read
     */
    public function test_can_correctly_read()
    {
        $tmpFilePath = sys_get_temp_dir() . '/read_test.csv';
        $csvPersistance = new CSVPersistance(
            new StringFactory,
            $tmpFilePath
        );
        $this->tmpFiles[] = $tmpFilePath;

        $stringEntity = new StringEntity('hello world');
        $csvPersistance->persist($stringEntity);
        $stringEntityRead = $csvPersistance->read();
        $this->assertInstanceOf(StringEntity::class, $stringEntityRead);
        $this->assertEquals('hello world', $stringEntityRead->get());

        $stringEntity = new StringEntity('白!,の日υπέρ is WhItê《！');
        $csvPersistance->persist($stringEntity);
        $stringEntityRead = $csvPersistance->read();
        $this->assertInstanceOf(StringEntity::class, $stringEntityRead);
        $this->assertEquals('白!,の日υπέρ is WhItê《！', $stringEntityRead->get());
    }
}

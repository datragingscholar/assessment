<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Domain\Entities\StringEntity;

class StringEntityTest extends TestCase
{
    /**
     * @test
     * @covers StringEntity::get
     */
    public function test_can_initialize_and_get_string()
    {
        $stringEntity = new StringEntity('test string');

        $this->assertIsString($stringEntity->get());
        $this->assertEquals('test string', $stringEntity->get());
    }

    /**
     * @test
     * @covers StringEntity::updateString
     */
    public function test_can_update_string()
    {
        $stringEntity = new StringEntity('test string');
        $stringEntity->updateString('new string');

        $this->assertIsString($stringEntity->get());
        $this->assertEquals('new string', $stringEntity->get());
    }
}

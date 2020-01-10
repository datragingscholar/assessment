<?php

use Tests\TestCase;
use App\Domain\Entities\StringEntity;
use App\Domain\Entities\StringFactory;

class StringFactoryTest extends TestCase
{
    /**
     * @test
     * @covers StringFactory::makeFromString
     */
    public function test_can_make_from_string()
    {
        $stringFactory = new StringFactory;
        $stringEntity = $stringFactory->makeFromString('test string');

        $this->assertInstanceOf(StringEntity::class, $stringEntity);
        $this->assertEquals('test string', $stringEntity->get());
    }
}

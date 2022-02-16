<?php
namespace Braddle\TestDoubles;

use Mockery\Adapter\Phpunit\MockeryTestCase;
use \Mockery as m;


class DoublerTest extends MockeryTestCase
{
    public function test_name():void
    {
        $mockUser = m::mock(User::class);
        $mockUser->shouldReceive("getName")
          ->andReturn("Teo");

        $spyLogger = m::spy(Logger::class);
        $spyLogger->info("should work");

        $spyLogger->shuoldHaveReceived("info");
    }

}

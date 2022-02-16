<?php
namespace Braddle\ADT;

use PHPUnit\Framework\TestCase;

class QueueTest extends TestCase
{
    private Queue $empty, $one, $three;

    public function setUp(): void
    {
        $this->empty = new Queue();
        $this->one = new Queue();
        $this->one->push("pop");
        $this->three = new Queue();
        $this->three->push("snap");
        $this->three->push("crackle");
        $this->three->push("pop");
    }

    public function test_isEmpty_whenEmpty(): void
    {
        $this->assertTrue($this->empty->isEmpty());
    }

    public function test_isEmpty_whenNotEmpty(): void
    {
        $this->assertFalse($this->one->isEmpty());
    }

    public function test_size(): void
    {
        $this->assertSame(0, $this->empty->size());
        $this->assertSame(1, $this->one->size());
        $this->assertSame(3, $this->three->size());
    }

    public function test_pop_single(): void
    {
        $this->assertSame('pop', $this->one->pop());
        $this->assertSame('snap', $this->three->pop());
    }

    public function test_pop_multiple(): void
    {
        $this->assertSame('pop', $this->one->pop());
        $this->assertEquals(0, $this->one->size());

        $this->assertSame('snap', $this->three->pop());
        $this->assertEquals(2, $this->three->size());
        $this->assertSame('crackle', $this->three->pop());
        $this->assertEquals(1, $this->three->size());
        $this->assertSame('pop', $this->three->pop());
        $this->assertEquals(0, $this->three->size());
    }

}
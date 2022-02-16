<?php
namespace Braddle\ADT;

use PHPUnit\Framework\TestCase;

class StackTest extends TestCase
{

    private Stack $empty, $one, $three;

    public function setUp(): void
    {
        parent::setUp();

        $this->empty = new Stack();
        $this->one = new Stack();
        $this->three = new Stack();

    }

    public function test_isEmpty_isEmpty(): void
    {
        $this->assertTrue($this->empty->isEmpty());
    }

    public function test_isEmpty_isNotEmpty(): void
    {
        $this->one->push("pop");

        $this->assertFalse($this->one->isEmpty());
    }

    public function test_size(): void
    {

        $this->one->push("pop");

        $this->three->push("snap");
        $this->three->push("crackle");
        $this->three->push("pop");

        $this->assertEquals(0, $this->empty->size());
        $this->assertEquals(1, $this->one->size());
        $this->assertEquals(3, $this->three->size());
    }

    public function test_pop_single(): void
    {
        $this->one->push("pop");
        $this->assertEquals("pop", $this->one->pop());
        $this->assertTrue($this->one->isEmpty());
        $this->assertEquals(0, $this->one->size());
    }

    public function test_pop_multiple(): void
    {
        $this->three->push("snap");
        $this->three->push("crackle");
        $this->three->push("pop");

        $this->assertEquals("pop", $this->three->pop());
        $this->assertEquals(2, $this->three->size());

        $this->assertEquals("crackle", $this->three->pop());
        $this->assertEquals(1, $this->three->size());

        $this->assertEquals("snap", $this->three->pop());
        $this->assertEquals(0, $this->three->size());
        $this->assertTrue($this->three->isEmpty());
    }

}
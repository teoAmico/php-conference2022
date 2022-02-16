<?php

namespace Braddle\ADT;

class Stack
{
    private int $size = 0;
    private array $value = [];


    public function isEmpty(): bool
    {
        return $this->size === 0;
    }

    public function push(string $input): void
    {
        $this->value[$this->size++] = $input;
    }

    public function size(): int
    {
        return $this->size;
    }

    public function pop(): string
    {
        return $this->value[--$this->size];
    }
}
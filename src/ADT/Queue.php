<?php

namespace Braddle\ADT;

class Queue implements Collection
{
    private int $size = 0;
    private int $index = 0;
    private array $value = [];

    public function isEmpty(): bool
    {
        return $this->size === 0;
    }

    public function size(): int
    {
        return $this->size;
    }

    public function push(string $value): void
    {
        $this->value[$this->size++] = $value;
    }

    public function pop(): string
    {
        $this->size--;

        $val = $this->value[$this->index];

        unset($this->value[$this->index]);

        $this->index++;

        return $val;
    }
}
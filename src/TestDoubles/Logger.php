<?php

namespace Braddle\TestDoubles;

interface Logger
{
    public function info(string $message): string;
}
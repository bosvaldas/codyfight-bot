<?php

namespace App\Business\Command;

use App\Business\Command\Move\MoveCommandInterface;

class CommandResolver
{
    private array $resolved = [
        'moves' => [],
    ];

    public function getMove(string $key): MoveCommandInterface
    {
        return $this->resolved['moves'][$key] ??= resolve($key);
    }
}
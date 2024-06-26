<?php

namespace App\Business\Command\Move;

readonly class MoveParameters
{
    public function __construct(
        private int $x,
        private int $y,
    )
    {
    }

    public function getX(): int
    {
        return $this->x;
    }

    public function getY(): int
    {
        return $this->y;
    }
}
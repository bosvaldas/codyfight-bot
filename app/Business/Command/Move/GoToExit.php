<?php

namespace App\Business\Command\Move;

class GoToExit implements MoveCommandInterface
{
    public function execute(array $gameState): MoveParameters
    {
        throw new \RuntimeException('not implemented');
    }
}
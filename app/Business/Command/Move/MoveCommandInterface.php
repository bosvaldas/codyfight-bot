<?php

namespace App\Business\Command\Move;

interface MoveCommandInterface
{
    public function execute(array $gameState): MoveParameters;
}
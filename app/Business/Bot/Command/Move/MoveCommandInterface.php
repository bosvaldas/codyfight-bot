<?php

namespace App\Business\Bot\Command\Move;

interface MoveCommandInterface
{
    public function get(array $gameState): MoveParameters;
}
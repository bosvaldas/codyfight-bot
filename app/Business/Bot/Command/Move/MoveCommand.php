<?php

namespace App\Business\Bot\Command\Move;

class MoveCommand
{
    public function get(array $gameState): MoveParameters
    {
        return new MoveParameters(
            x: $gameState['players']['bearer']['position']['x'],
            y: $gameState['players']['bearer']['position']['y'],
        );
    }
}
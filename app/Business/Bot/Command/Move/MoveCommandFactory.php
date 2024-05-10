<?php

namespace App\Business\Bot\Command\Move;

use App\Business\Bot\Runner\BotConfiguration;

class MoveCommandFactory
{
    public function createMoveCommand(BotConfiguration $configuration): MoveCommandInterface
    {
        return new RandomMoveCommand();
    }
}
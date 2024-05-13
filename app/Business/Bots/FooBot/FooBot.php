<?php

namespace App\Business\Bots\FooBot;

use App\Business\Bots\Bot;
use App\Business\Client\CodyfightClientInterface;
use App\Business\Command\Move\MoveCommandInterface;

class FooBot extends Bot
{
    public function handleTurn(): void
    {
//        if ($this->isTurnIsEven()) {
//            $this->move($this->commandMap['chaseEnemy']);
//        } else {
//            $this->move($this->commandMap['goToExit']);
//        }
    }

    private function isTurnIsEven(): bool
    {
        return $this->game['is_turn_even'];
    }
}
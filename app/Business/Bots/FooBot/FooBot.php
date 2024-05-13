<?php

namespace App\Business\Bots\FooBot;

use App\Business\Bots\Bot;
use App\Business\Client\CodyfightClientInterface;
use App\Business\Command\Move\ChaseEnemy;
use App\Business\Command\Move\GoToExit;
use App\Business\Command\Move\MoveCommandInterface;
use App\Business\Command\Move\RandomMove;

class FooBot extends Bot
{
    public function handleTurn(): void
    {
        $this->move(RandomMove::class);
    }
}
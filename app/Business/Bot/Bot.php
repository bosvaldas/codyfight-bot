<?php

namespace App\Business\Bot;

use App\Business\Bot\Client\CodyfightClientInterface;
use App\Business\Bot\Command\Move\MoveCommandInterface;

readonly class Bot
{
    public function __construct(
        private CodyfightClientInterface $client,
        private MoveCommandInterface     $moveCommand,
    )
    {
    }

    public function move(array $gameState): array
    {
        $moveParameters = $this->moveCommand->get($gameState);

        return $this->client->move($moveParameters);
    }

    public function updateState(): array
    {
        return $this->client->checkGameState();
    }

    public function initGame(): array
    {
        return $this->client->initGame();
    }
}
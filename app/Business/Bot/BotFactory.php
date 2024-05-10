<?php

namespace App\Business\Bot;

use App\Business\Bot\Client\ClientFactory;
use App\Business\Bot\Command\Move\MoveCommandFactory;
use App\Business\Bot\Runner\BotConfiguration;

class BotFactory
{
    public function __construct(
        private ClientFactory $clientFactory,
        private MoveCommandFactory $moveCommandFactory,
    )
    {
    }

    public function createBot(BotConfiguration $configuration): Bot
    {
        return new Bot(
            client: $this->clientFactory->createCodyfightClient($configuration),
            moveCommand: $this->moveCommandFactory->createMoveCommand($configuration),
        );
    }
}
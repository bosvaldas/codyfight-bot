<?php

namespace App\Business\Bot\Runner;

use App\Business\Bot\Client\ClientFactory;

class BotRunner
{
    public function __construct(
        private ClientFactory $clientFactory,
    )
    {
    }

    public function run(BotConfiguration $configuration): BotRunnerResults
    {
        $client = $this->clientFactory->createCodyfightClient($configuration);
        $client->initGame();
        $client->surrender();

        return new BotRunnerResults();
    }
}
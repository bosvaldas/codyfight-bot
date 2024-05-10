<?php

namespace App\Business\Bot\Client;

use App\Business\Bot\Runner\BotConfiguration;

class ClientFactory
{
    public function createCodyfightClient(BotConfiguration $configuration): CodyfightClientInterface
    {
        return new CodyfightApiClient($configuration);
    }
}
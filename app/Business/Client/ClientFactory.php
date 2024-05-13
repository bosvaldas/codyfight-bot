<?php

namespace App\Business\Client;

use App\Business\Runner\BotConfiguration;

class ClientFactory
{
    public function createCodyfightClient(BotConfiguration $configuration): CodyfightClientInterface
    {
        return new CodyfightApiClient($configuration);
    }
}
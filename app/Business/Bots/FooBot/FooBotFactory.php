<?php

namespace App\Business\Bots\FooBot;

use App\Business\Bots\Bot;
use App\Business\Bots\BotFactory;
use App\Business\Runner\BotConfiguration;

class FooBotFactory extends BotFactory
{
    public function createBot(BotConfiguration $configuration): Bot
    {
        return new FooBot(
            client: $this->createClient($configuration),
            logger: $this->createLogger($configuration),
            commandResolver: $this->createCommandResolver()
        );
    }

}
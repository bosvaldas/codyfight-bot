<?php

namespace App\Business\Runner;

use App\Business\Bots\Bot;
use App\Business\Bots\BotFactory;

readonly class BotRunner
{
    public function run(BotConfiguration $configuration): void
    {
        $bot = $this->createBot($configuration);
        while (true) {
            $bot->run();
        }
    }

    private function createBot(BotConfiguration $configuration): Bot
    {
        $factory = $this->resolveBotFactory($configuration);

        return $factory->createBot($configuration);
    }

    private function resolveBotFactory(BotConfiguration $configuration): BotFactory
    {
        return resolve($configuration->getBotFactoryName());
    }
}
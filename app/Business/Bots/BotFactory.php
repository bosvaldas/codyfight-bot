<?php

namespace App\Business\Bots;

use App\Business\Bots\FooBot\FooBot;
use App\Business\Client\ClientFactory;
use App\Business\Client\CodyfightClientInterface;
use App\Business\Command\CommandResolver;
use App\Business\Logger\BotLoggerInterface;
use App\Business\Logger\LoggerFactory;
use App\Business\Runner\BotConfiguration;

abstract class BotFactory
{
    public function __construct(
        private ClientFactory $clientFactory,
        private LoggerFactory $loggerFactory,
    )
    {
    }

    abstract public function createBot(BotConfiguration $configuration): Bot;

    protected function createLogger(BotConfiguration $configuration): BotLoggerInterface
    {
        return $this->loggerFactory->createLogger($configuration);
    }

    protected function createClient(BotConfiguration $configuration): CodyfightClientInterface
    {
        return $this->clientFactory->createCodyfightClient($configuration);
    }

    public function createCommandResolver(): CommandResolver
    {
        return new CommandResolver();
    }
}
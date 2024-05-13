<?php

namespace App\Business\Logger;

use App\Business\Runner\BotConfiguration;
use Illuminate\Support\Facades\Log;

readonly class StdOutLogger implements BotLoggerInterface
{
    public function __construct(
        private BotConfiguration $configuration
    )
    {
    }

    public function info(string $message): void
    {
        echo $this->prepareMessage('info', $message);
    }

    public function prepareMessage(string $type, string $message): string
    {
        return sprintf("[%s][Bot %s] %s\n", $type, $this->configuration->getBotName(), $message);
    }
}
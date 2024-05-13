<?php

namespace App\Business\Logger;

use App\Business\Runner\BotConfiguration;

class LoggerFactory
{
    public function createLogger(BotConfiguration $configuration): BotLoggerInterface
    {
        return new StdOutLogger($configuration);
    }
}
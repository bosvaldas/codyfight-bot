<?php

namespace App\Business\Logger;

interface BotLoggerInterface
{
    public function info(string $message): void;
}
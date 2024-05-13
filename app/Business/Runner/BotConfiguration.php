<?php

namespace App\Business\Runner;

readonly class BotConfiguration
{
    public function __construct(
        private string $botName,
        private string $botFactoryClassName,
        private string $ckey,
        private int    $gameMode
    )
    {
    }

    public function getCkey(): string
    {
        return $this->ckey;
    }

    public function getGameMode(): int
    {
        return $this->gameMode;
    }

    public function getBotName(): string
    {
        return $this->botName;
    }

    public function getBotFactoryName(): string
    {
        return $this->botFactoryClassName;
    }
}
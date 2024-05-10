<?php

namespace App\Business\Bot\Runner;

readonly class BotConfiguration
{
    public function __construct(
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
}
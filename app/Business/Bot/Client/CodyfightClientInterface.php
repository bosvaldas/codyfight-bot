<?php

namespace App\Business\Bot\Client;

interface CodyfightClientInterface
{
    public function initGame(int $gameMode = null): array;

    public function surrender(): array;
}
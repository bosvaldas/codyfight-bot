<?php

namespace App\Business\Bot\Client;

use App\Business\Bot\Command\Move\MoveParameters;

interface CodyfightClientInterface
{
    public function initGame(int $gameMode = null): array;

    public function surrender(): array;

    public function move(MoveParameters $parameters): array;

    public function checkGameState(): array;
}
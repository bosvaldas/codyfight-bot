<?php

namespace App\Business\Bot\Client;

use App\Business\Bot\Runner\BotConfiguration;
use Illuminate\Support\Facades\Http;

class CodyfightApiClient implements CodyfightClientInterface
{
    private BotConfiguration $configuration;

    public function __construct(BotConfiguration $configuration)
    {
        $this->configuration = $configuration;
    }

    public function initGame(int $gameMode = null): array
    {
        $response = Http::post(
            'https://game.codyfight.com',
            [
                'ckey' => $this->configuration->getCkey(),
                'mode' => $gameMode ?? $this->configuration->getGameMode(),
            ]
        );

        return $response->json();
    }

    public function surrender(): array
    {
        $response = Http::delete(
            'https://game.codyfight.com',
            [
                'ckey' => $this->configuration->getCkey(),
                'mode' => $gameMode ?? $this->configuration->getGameMode(),
            ]
        );

        return $response->json();
    }
}
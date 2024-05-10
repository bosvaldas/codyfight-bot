<?php

namespace App\Business\Bot\Client;

use App\Business\Bot\Runner\BotConfiguration;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class CodyfightApiClient implements CodyfightClientInterface
{
    private BotConfiguration $configuration;

    public function __construct(BotConfiguration $configuration)
    {
        $this->configuration = $configuration;
    }

    public function initGame(int $gameMode = null): array
    {
        $this->log('Starting game');
        $response = Http::post(
            'https://game.codyfight.com',
            [
                'ckey' => $this->configuration->getCkey(),
                'mode' => $gameMode ?? $this->configuration->getGameMode(),
            ]
        );
        $this->log('Game started');

        return $response->json();
    }

    public function surrender(): array
    {
        $this->log('Surrendering game');
        $response = Http::delete(
            'https://game.codyfight.com',
            [
                'ckey' => $this->configuration->getCkey(),
                'mode' => $gameMode ?? $this->configuration->getGameMode(),
            ]
        );
        $this->log('Game surrendered');

        return $response->json();
    }

    private function log(string $message): void
    {
        Log::debug('CodyfightClient: ' . $message);
    }
}
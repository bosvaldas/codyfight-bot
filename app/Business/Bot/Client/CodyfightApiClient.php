<?php

namespace App\Business\Bot\Client;

use App\Business\Bot\Command\Move\MoveParameters;
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

    public function move(MoveParameters $parameters): array
    {
        $this->log(sprintf('Starting move to [x: %s, y: %s]', $parameters->getX(), $parameters->getY()));
        $response = Http::put(
            'https://game.codyfight.com',
            [
                'ckey' => $this->configuration->getCkey(),
                'x' => $parameters->getX(),
                'y' => $parameters->getY(),
            ]
        );
        $this->log('Move ended');

        return $response->json();
    }

    public function checkGameState(): array
    {
        $this->log('Checking game state');
        $response = Http::get(
            'https://game.codyfight.com',
            [
                'ckey' => $this->configuration->getCkey(),
            ]
        );
        $this->log('Game state updated');

        return $response->json();
    }

    private function log(string $message): void
    {
        Log::debug('CodyfightClient: ' . $message);
    }
}
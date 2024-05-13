<?php

namespace App\Business\Bots;

use App\Business\Client\CodyfightClientInterface;
use App\Business\Command\Move\MoveCommandInterface;
use App\Business\Logger\BotLoggerInterface;

abstract class Bot
{
    protected ?array $game = null;

    public function __construct(
        protected CodyfightClientInterface $client,
        protected BotLoggerInterface       $logger,
        protected array                    $commandMap,
    )
    {
    }

    abstract function handleTurn();

    public function run(): void
    {
        $this->createGame();
        $this->waitForGameToStart();
        $this->playGame();
        $this->endGame();
    }

    protected function createGame(): void
    {
        if ($this->game) {
            return;
        }

        $this->logger->info('Creating game');
        $this->game = $this->client->initGame();
    }

    protected function waitForGameToStart(): void
    {
        while ($this->game['state']['status'] === 0) {
            $this->logger->info('Waiting for game to start');

            sleep(1);

            $this->updateState();
        }
    }

    protected function playGame(): void
    {
        if ($this->game['state']['status'] !== 1) {
            return;
        }

        $this->logger->info('Play game');
        sleep(3);
        $this->logger->info('Surrendering');
        $this->game = $this->client->surrender();
    }

    protected function endGame(): void
    {
        if ($this->game['state']['status'] !== 2) {
            return;
        }

        $opponentName = $this->game['players']['opponent']['name'];
        $playerName = $this->game['players']['bearer']['name'];

        $verdict = match ($this->game['verdict']['winner']) {
            $opponentName => 'lost',
            $playerName => 'win',
            default => 'draw',
        };

        $this->logger->info('Game ' . $verdict);

        $this->resetGame();
    }

    protected function updateState(): void
    {
        $this->game = $this->client->checkGameState();
    }

    protected function resetGame(): void
    {
        $this->logger->info('Resetting game');
        $this->game = [];
    }

    protected function move(MoveCommandInterface $command): array
    {
        $moveParameters = $command->execute($this->game);

        return $this->client->move($moveParameters);
    }
}
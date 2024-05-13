<?php

namespace App\Business\Bots;

use App\Business\Client\CodyfightClientInterface;
use App\Business\Command\CommandResolver;
use App\Business\Logger\BotLoggerInterface;

abstract class Bot
{
    protected ?array $game = null;

    public function __construct(
        protected CodyfightClientInterface $client,
        protected BotLoggerInterface       $logger,
        protected CommandResolver          $commandResolver,
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
        while ($this->game['state']['status'] === 1) {
            if ($this->game['players']['bearer']['is_player_turn']) {
                $this->logger->info('Player turn');
                $this->handleTurn();
            } else {
                $this->logger->info('Waiting for player turn');
                $this->updateState();
            }
        }
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

        $this->logger->info('Game ended. Verdict ' . $verdict);

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

    protected function move(string $commandName): void
    {
        $this->logger->info("Running move $commandName");

        $command = $this->commandResolver->getMove($commandName);
        $moveParameters = $command->execute($this->game);

        $this->game = $this->client->move($moveParameters);
    }
}
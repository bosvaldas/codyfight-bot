<?php

namespace App\Business\Bot\Runner;

use App\Business\Bot\Client\ClientFactory;
use App\Business\Bot\Client\CodyfightClientInterface;
use App\Business\Bot\Command\Move\MoveCommand;

class BotRunner
{
    private CodyfightClientInterface $client;

    public function __construct(
        private readonly ClientFactory $clientFactory,
        private readonly MoveCommand   $moveCommand,
    )
    {
    }

    public function run(BotConfiguration $configuration): BotRunnerResults
    {
        $this->client = $this->clientFactory->createCodyfightClient($configuration);

        $endGameState = $this->playGame();

        return new BotRunnerResults();
    }

    private function playGame(): array
    {
        $gameState = $this->startGame();

        while ($this->gameIsInProgress($gameState)) {
            if ($this->isPlayerTurn($gameState)) {
                logger('PLAYER TURN');
                $gameState = $this->move($gameState);
            } else {
                logger('Waiting for player turn');
                $gameState = $this->checkGameState();
            }
            sleep(1);
        }
        logger('Game ended');

        return $gameState;
    }

    private function startGame(): array
    {
        $gameState = $this->client->initGame();
        $gameStatus = $gameState['state']['status'];

        while ($gameStatus === 0) {
            logger('Waiting for game to start');
            $gameState = $this->client->initGame();

            if (!isset($gameState['state']['status'])) {
                // Possibly maintenance/timeout?
                sleep(5);
            } else {
                $gameStatus = $gameState['state']['status'];
                sleep(1);
            }
        }

        return $gameState;
    }

    private function gameIsInProgress(array $gameState): bool
    {
        return $gameState['state']['status'] === 1;
    }

    private function isPlayerTurn(array $gameState): bool
    {
        return $gameState['players']['bearer']['is_player_turn'];
    }

    private function move(array $gameState): array
    {
        $moveParameters = $this->moveCommand->get($gameState);

        return $this->client->move($moveParameters);
   }

    private function checkGameState(): array
    {
        return $this->client->checkGameState();
    }
}
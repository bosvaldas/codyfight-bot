<?php

namespace App\Business\Bot\Runner;

use App\Business\Bot\Bot;

readonly class BotRunner
{
    private Bot $bot;

    public function run(Bot $bot): BotRunnerResults
    {
        $this->bot = $bot;
        $endGameState = $this->playGame();

        return new BotRunnerResults();
    }

    private function playGame(): array
    {
        $gameState = $this->startGame();

        while ($this->gameIsInProgress($gameState)) {
            if ($this->isPlayerTurn($gameState)) {
                logger('PLAYER TURN');
                $gameState = $this->bot->move($gameState);
            } else {
                logger('Waiting for player turn');
                $gameState = $this->bot->updateState();
            }
            sleep(1);
        }
        logger('Game ended');

        return $gameState;
    }

    private function startGame(): array
    {
        $gameState = $this->bot->initGame();
        $gameStatus = $gameState['state']['status'];

        while ($gameStatus === 0) {
            logger('Waiting for game to start');
            $gameState = $this->bot->initGame();

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
}
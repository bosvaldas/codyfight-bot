<?php

namespace App\Business\Bot\Command\Move;

class RandomMoveCommand implements MoveCommandInterface
{
    public function get(array $gameState): MoveParameters
    {
        $move = $this->getRandomPossibleMove($gameState);

        return $this->transformParameters($move);
    }

    private function getRandomPossibleMove(array $gameState): array
    {
        $possibleMoves = $gameState['players']['bearer']['possible_moves'];

        return $possibleMoves[array_rand($possibleMoves)];
    }

    private function transformParameters(array $move): MoveParameters
    {
        return new MoveParameters(x: $move['x'], y: $move['y']);
    }
}
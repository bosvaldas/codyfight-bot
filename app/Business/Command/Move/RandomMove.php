<?php

namespace App\Business\Command\Move;

class RandomMove implements MoveCommandInterface
{
    public function execute(array $gameState): MoveParameters
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
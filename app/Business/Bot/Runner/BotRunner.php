<?php

namespace App\Business\Bot\Runner;

class BotRunner
{
    public function run(BotConfiguration $configuration): BotRunnerResults
    {
        return new BotRunnerResults();
    }
}
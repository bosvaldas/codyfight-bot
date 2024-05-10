<?php

namespace App\Console\Commands;

use App\Business\Bot\BotFactory;
use App\Business\Bot\Runner\BotConfiguration;
use App\Business\Bot\Runner\BotRunner;
use App\Business\Bot\Runner\BotRunnerResults;
use Illuminate\Console\Command;

class RunCodyfightBot extends Command
{
    protected $signature = "codyfight:bot:run {botName : Name of the bot to run}";

    protected $description = 'Runs Codyfight bot by name';

    public function handle(BotFactory $botFactory, BotRunner $runner): int
    {
        $botName = $this->argument('botName');
        $codyfightConfig = config('codyfight');

        $existingBotNames = array_keys($codyfightConfig['bot']);
        if (!in_array($botName, $existingBotNames)) {
            $errorMessage = sprintf(
                'Bot "%s" does not exist. Existing bot names [%s]',
                $botName,
                implode(', ', $existingBotNames)
            );
            $this->error($errorMessage);

            return static::FAILURE;
        }

        $botConfiguration = new BotConfiguration(
            ckey: $codyfightConfig['bot'][$botName]['ckey'],
            gameMode: (int) $codyfightConfig['bot'][$botName]['game_mode']
        );
        $bot = $botFactory->createBot($botConfiguration);
        $results = $runner->run($bot);
        $this->handleBotResults($results);

        return static::SUCCESS;
    }

    private function handleBotResults(BotRunnerResults $results): void
    {
        // print outcome
    }
}

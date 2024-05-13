<?php

namespace App\Console\Commands;

use App\Business\Runner\BotConfiguration;
use App\Business\Runner\BotRunner;
use Illuminate\Console\Command;

class RunCodyfightBot extends Command
{
    protected $signature = "codyfight:bot:run {botName : Name of the bot to run}";

    protected $description = 'Runs Codyfight bot by name';

    public function handle(BotRunner $runner): int
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

        $botConfiguration = $this->createConfiguration($botName, $codyfightConfig);

        $runner->run($botConfiguration);

        return static::SUCCESS;
    }

    public function createConfiguration(string $botName, array $codyfightConfig): BotConfiguration
    {
        $rawBotConfiguration = $codyfightConfig['bot'][$botName];

        return new BotConfiguration(
            botName: $botName,
            botFactoryClassName: $rawBotConfiguration['factory_class_name'],
            ckey: $rawBotConfiguration['ckey'],
            gameMode: (int)$rawBotConfiguration['game_mode']
        );
    }
}

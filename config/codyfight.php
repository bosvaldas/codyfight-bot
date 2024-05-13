<?php

use Illuminate\Support\Env;

return [
    'bot' => [
        'foo' => [
            'ckey' => Env::getOrFail('BOT_0_CKEY'),
            'game_mode' => 0,
            'factory_class_name' => \App\Business\Bots\FooBot\FooBotFactory::class,
        ],
        'foo_bar' => [
            'ckey' => Env::getOrFail('BOT_1_CKEY'),
            'game_mode' => 0,
            'factory_class_name' => \App\Business\Bots\FooBot\FooBotFactory::class,
        ],
        'bar_baz' => [
            'ckey' => Env::getOrFail('BOT_2_CKEY'),
            'game_mode' => 0,
            'factory_class_name' => \App\Business\Bots\FooBot\FooBotFactory::class,
        ],
    ],
];
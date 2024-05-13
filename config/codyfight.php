<?php

return [
    'bot' => [
        'foo' => [
            'ckey' => env('BOT_0_CKEY'),
            'game_mode' => env('BOT_0_GAME_MODE'),
            'factory_class_name' => \App\Business\Bots\FooBot\FooBotFactory::class,
        ],
    ],
];
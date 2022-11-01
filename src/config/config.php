<?php

use Lwwcas\LaravelRssReader\Feeds\LaravelNews;

return [
    'active-rss' => [
        'laravel-news' => LaravelNews::class,
    ],

    'config-rss' => [
        'laravel-news' => [
            // 'url' => 'https://news.google.com/news/rss',
            // 'articles' => 'item',
        ]
    ],

    'defaultDateFormat' => 'Y-m-d',

    'defaultArticlesDateFormat' => 'Y-m-d H:i:s',

    'autoUpdateHoursDelay' => '24',
];

<?php

use Lwwcas\LaravelRssReader\Feeds\LaravelNews;

return [
    'active-rss' => [
        'laravel-news' => LaravelNews::class,
    ],

    'config-rss' => [
        'laravel-news' => [
            'url' => 'https://news.google.com/news/rss',
        ]
    ],

    'custom-rss' => [
        //
    ],
];

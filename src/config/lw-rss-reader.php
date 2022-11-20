<?php

return [
    'active-rss' => [
        'laravel-news',
    ],

    'config-rss' => [
        'laravel-news' => [
            // 'url' => 'https://news.google.com/news/rss',
        ]
    ],

    'article-reading-limit' => 20,

    'enable-caching-in-rss-feed-id' => true,

    'hide-articles-on-blacklist' => false,

    'save-articles-on-blacklist' => true,

    'auto-update-hours-delay' => '24',

    'default-date-format' => 'Y-m-d',

    'default-articles-date-format' => 'Y-m-d H:i:s',
];

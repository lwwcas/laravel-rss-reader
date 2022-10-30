<?php

namespace Lwwcas\LaravelRssReader\Feeds;

class LaravelNews extends BaseFeed
{
    protected $id = 'laravel-news';

    protected $generator = 'https://laravel-news.com';

    protected $url = 'https://feed.laravel-news.com/';

    protected $image = 'https://static.feedpress.com/logo/laravelnews-6027ee343fdff.png';

    protected $title = 'Laravel News';

    protected $description = 'Your official Laravel news source.';

    protected $language = 'en-US';

    protected $setup = [
        'core' => 'channel',
        'articles' => 'item',
        'article' => [
            'url' => 'link',
            'title' => 'title',
            'description' => 'description',
            'category' => 'category',
            'date' => 'pubDate',
            'guid' => 'guid',

        ],
        'image' => 'image',
        'title' => 'title',
        'description' => 'description',
        'url' => 'link',
        'language' => 'language',
        'generator' => 'generator',
        'lastUpdate' => 'lastBuildDate',
    ];
}

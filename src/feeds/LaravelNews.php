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

    protected $cache = true;

    protected $autoUpdate = false;

    protected $badWordsVerification = true;

    protected $metadata = [
        'generator' => 'generator',
        'language' => 'language',
        'lastUpdate' => 'lastBuildDate',
    ];

    protected $setup = [
        'articles' => 'item',
        'core' => 'channel',
        'description' => 'description',
        'image' => 'image',
        'title' => 'title',
        'url' => 'link',
    ];

    protected $article = [
        'date' => 'pubDate',
        'description' => 'description',
        'image' => null,
        'title' => 'title',
        'url' => 'link',
    ];

    protected $articleData = [
        'category',
    ];

    public function feedCreated(array $feed = []): array
    {
        foreach ($feed['articles'] as $key => $article) {
            $description = $article['description'];

            // fetch the first paragraph
            $start = strpos($description, '<p>');
            $end = strpos($description, '</p>', $start);
            $paragraph = substr($description, $start, $end - $start + 4);

            // fetch the img tag
            $start = strpos($paragraph, '<img src="');
            $image = substr($paragraph, $start + 10);
            $image = str_replace('"></a></p>', '', $image);

            // remove the first paragraph from the description
            $description = substr($description, $end + 4);

            $feed['articles'][$key]['image'] = $image;
            $feed['articles'][$key]['description'] = $description;
        }

        return $feed;
    }

    public function customFilter(array $article = []): array
    {
        return [];
    }
}

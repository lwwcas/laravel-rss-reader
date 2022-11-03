<?php

namespace Lwwcas\LaravelRssReader;

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Lwwcas\LaravelRssReader\Feeds\BaseFeed;
use Lwwcas\LaravelRssReader\Models\RssFeed;
use Lwwcas\LaravelRssReader\Models\RssFeedLog;
use SimpleXMLElement;

class RssReader
{
    private const NAMESPACE = 'Lwwcas\LaravelRssReader\\';

    private $rssFeed = null;

    private $rootFeed = [
        'articles' => [],
    ];

    public function feed(string $rssFeed): RssReader
    {
        $this->rssFeed = $rssFeed;
        $rssClass = $this->getActiveFeed($rssFeed);

        if ($rssClass === null) {
            throw new \LogicException('Your RSS feed is not active in your settings file.');
        }

        $feed = $this->getNormalizeFeed($rssClass);
        $rootFeed = $this->generateRootFeed($rssClass, $feed);
        $rootFeed['articles'] = $this->generateArticlesFeed($rssClass, $feed);
        $rootFeed['articles'] = $this->generateCustomFilter($rssClass, $rootFeed['articles']);

        $this->rootFeed = $rssClass->feedCreated($rootFeed);

        return $this;
    }

    public function save()
    {
        if ($this->rssFeed === null) {
            return null;
        }

        $rssClass = $this->getActiveFeed($this->rssFeed);

        if ($rssClass->sourceCache() === false) {
            return null;
        }

        $articles = $this->rootFeed['articles'];

        $response = DB::transaction(function () use ($rssClass, $articles) {
            $now = date('Y-m-d H:i:s');
            $rssFeed = RssFeed::updateOrCreate(
                [
                    'key' => $rssClass->id(),
                ],
                [
                    'title' => $rssClass->sourceTitle(),
                    'key' => $rssClass->id(),
                    'read_at' => $now,
                ]
            );

            $rssFeed->logs()->create([
                'title' => $rssClass->sourceTitle(),
                'key' => $rssClass->id(),
                'action' => RssFeedLog::ACTION_SAVE,
                'read_at' => $now,
            ]);

            foreach ($articles as $article) {
                $slug = Str::of($article['title'])->slug('-');
                $rssFeed->articles()->updateOrCreate(
                    [
                        'slug' => $slug,
                    ],
                    [
                        'url' => $article['url'],
                        'title' => $article['title'],
                        'description' => $article['description'],
                        'image' => $article['image'],
                        'data' => $article['data'],
                        'date' => $article['date'],
                        'custom' => $article['custom_filter'],
                        'language' => $rssClass->sourceLanguage(),
                        'active' => true,
                        'black_list' => false,
                    ]
                );
            }

            return $rssFeed;
        });

        return $response;
    }

    public function get(): array
    {
        return $this->rootFeed;
    }

    public function all(): array
    {
        return $this->rootFeed['articles'];
    }

    public function first(callable $callback = null, $default = null): Arr
    {
        return Arr::first($this->rootFeed['articles'], $callback, $default);
    }

    public function last(callable $callback = null, $default = null): Arr
    {
        return Arr::last($this->rootFeed['articles'], $callback, $default);
    }

    public function sort(): RssReader
    {
        $this->rootFeed['articles'] = Arr::sort($this->rootFeed['articles']);
        return $this;
    }

    private function verifyBannedWords(BaseFeed $rssClass, array $articles): array
    {
        return $articles;
    }

    private function generateArticlesFeed(BaseFeed $rssClass, array $feed): array
    {
        $setup = $rssClass->sourceSetup();
        $articleData = $rssClass->sourceArticleData();
        $articleSource = $rssClass->sourceArticle();

        $articleDataFormat = $this->config('default-articles-date-format');
        $articles = [];

        foreach ($feed[$setup['articles']] as $key => $article) {
            $articleDate = $rssClass->dateParse($article[$articleSource['date']], $articleDataFormat);
            $articles[$key] = [
                'url' => $article[$articleSource['url']],
                'title' => $article[$articleSource['title']],
                'description' => $article[$articleSource['description']],
                'date' => $articleDate,
                'image' => null,
            ];

            $articleDataList = [];
            foreach ($articleData as $data) {
                $articleDataList[$data] = $article[$data];
            }

            $articles[$key]['data'] = $articleDataList;
        }

        return $articles;
    }

    private function generateRootFeed(BaseFeed $rssClass, array $feed): array
    {
        $setup = $rssClass->sourceSetup();
        $metadata = $rssClass->sourceMetadata();

        $feedDate = $rssClass->dateParse($feed[$metadata['lastUpdate']]);

        $root = [
            'url' => $feed[$setup['url']],
            'title' => $feed[$setup['title']],
            'description' => $feed[$setup['description']],
            'metadata' => [
                'generator' => $feed[$metadata['generator']],
                'language' => $feed[$metadata['language']],
                'lastUpdate' => $feedDate,
            ],
        ];

        if (array_key_exists($setup['image'], $feed) === true) {
            if (array_key_exists('url', $feed[$setup['image']])) {
                $root['image'] = $feed[$setup['image']]['url'];
            }
        }

        return $root;
    }

    private function generateCustomFilter(BaseFeed $rssClass, array $articles): array
    {
        $_articles = [];
        foreach ($articles as $article) {
            $custom = $rssClass->customFilter($article);
            if ($custom === null) {
                $article['custom_filter'] = null;
                continue;
            }

            if (is_array($custom) === false) {
                $article['custom_filter'] = null;
                continue;
            }

            $article['custom_filter'] = $rssClass->customFilter($article);
            $_articles[] = $article;
        }

        return $_articles;
    }

    private function getNormalizeFeed(BaseFeed $rssClass): array
    {
        $url = $rssClass->sourceUrl();
        $setup = $rssClass->sourceSetup();

        $feed = $this->readFromUrl($url);
        $feed = $this->toArray($feed);

        return $feed[$setup['core']];
    }

    private function getActiveFeed(string $rssFeed): ?BaseFeed
    {
        $activeRss = $this->config('active-rss');
        $arrayFeedSearch = array_search($rssFeed, $activeRss);

        if (is_array($activeRss) == false) {
            return null;
        }

        if ($arrayFeedSearch === false && array_key_exists($rssFeed, $activeRss) === false) {
            return null;
        }

        if ($arrayFeedSearch !== false && $activeRss[$arrayFeedSearch] === $rssFeed) {
            return $this->getRssClass($rssFeed);
        }

        return (new $activeRss[$rssFeed]());
    }

    private function getRssClass(string $rssFeed): BaseFeed
    {
        $namespace = RssReader::NAMESPACE . 'feeds\\';
        $rssClassName = $namespace . str_replace('-', '', ucwords($rssFeed, '-'));

        return (new $rssClassName());
    }

    /**
     * Used to parse an RSS feed.
     *
     * @param $url
     */
    public function readFromUrl(string $url): SimpleXMLElement
    {
        $content = @file_get_contents($url);

        if ($content === false) {
            throw new \LogicException('The RSS feed url is not valid.');
        }

        // Instantiate XML element
        $xmlElement = new SimpleXMLElement($content);

        return $xmlElement;
    }

    private function toArray(SimpleXMLElement $xmlElement = null)
    {
        if (!$xmlElement->children()) {
            return (string) $xmlElement;
        }

        $xmlArray = [];
        foreach ($xmlElement->children() as $tag => $child) {
            if (count($xmlElement->$tag) === 1) {
                $xmlArray[$tag] = $this->toArray($child);
            } else {
                $xmlArray[$tag][] = $this->toArray($child);
            }
        }

        return $xmlArray;
    }

    /**
     * Used internally in order to retrieve a specific value from the
     * configuration file.
     *
     * @param string $configuration The name of the configuration to use
     *
     * @return mixed
     */
    private function config($configuration)
    {
        return Config::get('laravel-rss-reader.' . $configuration);
    }
}

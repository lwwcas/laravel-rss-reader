<?php

namespace Lwwcas\LaravelRssReader\Abstract;

use Illuminate\Support\Arr;
use Lwwcas\LaravelRssReader\BadWords\BadWord;
use Lwwcas\LaravelRssReader\Concerns\BlackList;
use Lwwcas\LaravelRssReader\Concerns\ConfigFeed;
use SimpleXMLElement;

abstract class BaseRssReader
{
    use ConfigFeed;
    use BlackList;

    protected const NAMESPACE = 'Lwwcas\\LaravelRssReader\\';

    protected $rssFeed = null;

    protected $rootFeed = [
        'articles' => [],
    ];

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

    protected function generateArticlesFeed(BaseFeed $rssClass, array $feed): array
    {
        $setup = $rssClass->setup();
        $articleData = $rssClass->articleData();
        $articleSource = $rssClass->article();

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

    protected function generateCustomFilter(BaseFeed $rssClass, array $articles): array
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

    protected function generateRootFeed(BaseFeed $rssClass, array $feed): array
    {
        $setup = $rssClass->setup();
        $metadata = $rssClass->metadata();

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

    protected function getNormalizeFeed(BaseFeed $rssClass): array
    {
        $url = $rssClass->url();
        $setup = $rssClass->setup();

        $feed = $this->readFromUrl($url);
        $feed = $this->toArray($feed);

        return $feed[$setup['core']];
    }

    protected function getActiveFeed(string $rssFeed): ?BaseFeed
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

    protected function getRssClass(string $rssFeed): BaseFeed
    {
        $namespace = self::NAMESPACE . 'feeds\\';
        $rssClassName = $namespace . str_replace('-', '', ucwords($rssFeed, '-'));

        return (new $rssClassName());
    }

    protected function verifyBannedWords(BaseFeed $rssClass, array $articles): array
    {
        if ($rssClass->badWordsVerification() === false) {
            return $articles;
        }

        $_articles = [];

        foreach ($articles as $article) {
            $description = $article['description'];
            $verification = BadWord::verifyParagraph($description);
            $article['black-list'] = [
                'status' => $verification['black-list'],
                'bad-words' => $verification['words'],
            ];
            $_articles[] = $article;
        }

        return $_articles;
    }

    public function all(): array
    {
        return $this->rootFeed;
    }

    public function get(): array
    {
        return $this->rootFeed['articles'];
    }

    public function first(callable $callback = null, $default = null): array
    {
        return Arr::first($this->rootFeed['articles'], $callback, $default);
    }

    public function last(callable $callback = null, $default = null): array
    {
        return Arr::last($this->rootFeed['articles'], $callback, $default);
    }

    protected function toArray(SimpleXMLElement $xmlElement = null)
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
}

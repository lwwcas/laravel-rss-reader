<?php

namespace Lwwcas\LaravelRssReader\Abstract;

use Illuminate\Support\Arr;
use Lwwcas\LaravelRssReader\Abstract\FileGetContentsWrapper;
use Lwwcas\LaravelRssReader\Concerns\BlackList;
use Lwwcas\LaravelRssReader\Concerns\BuildFeed;
use Lwwcas\LaravelRssReader\Concerns\HasConfigFeed;
use SimpleXMLElement;

abstract class BaseRssReader
{
    use HasConfigFeed;
    use BlackList;
    use BuildFeed;

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
        $contents = (new FileGetContentsWrapper())
            ->setUrl($url)
            ->setErrorMessage('The RSS feed url is not valid.')
            ->getContents();

        // Instantiate XML element
        $xmlElement = new SimpleXMLElement($contents);

        return $xmlElement;
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

    public function getNormalizeFeed(BaseFeed $rssClass): array
    {
        $url = $rssClass->url();
        $setup = $rssClass->setup();

        $feed = $this->readFromUrl($url);
        $feed = $this->toArray($feed);

        return $feed[$setup['core']];
    }

    public function getActiveFeed(string $rssFeed): BaseFeed|null
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
            return $this->buildRssClass($rssFeed);
        }

        return (new $activeRss[$rssFeed]());
    }

    public function getRssFeed(): string
    {
        return $this->rssFeed;
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

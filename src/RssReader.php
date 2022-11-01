<?php

namespace Lwwcas\LaravelRssReader;

use Illuminate\Support\Facades\Config;
use SimpleXMLElement;

class RssReader
{
    private const NAMESPACE = 'Lwwcas\LaravelRssReader';

    public function feed(string $rssFeed)
    {
        $rssClass = $this->getActiveFeed($rssFeed);

        if ($rssClass === null) {
            throw new \LogicException('Your RSS feed is not active in your settings file.');
        }

        $url = $rssClass->sourceUrl();
        $setup = $rssClass->sourceSetup();
        $metadata = $rssClass->sourceMetadata();
        $articleData = $rssClass->sourceArticleData();
        $articleSource = $rssClass->sourceArticle();

        $feed = $this->readFromUrl($url);
        $feed = $this->toArray($feed);
        $feed = $feed[$setup['core']];

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

        $articles = [];
        $articleDataFormat = $this->config('defaultArticlesDateFormat');
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

        $root['articles'] = $articles;

        $root = $rssClass->feedCreated($root);

        return $root;
    }

    private function getActiveFeed(string $rssFeed)
    {
        $activeRss = $this->config('active-rss');
        $arrayFeedSearch = array_search($rssFeed, $activeRss);

        if (is_array($activeRss) == false) {
            return null;
        }

        if ($arrayFeedSearch === false && array_key_exists($rssFeed, $activeRss) === false) {
            return null;
        }

        if ($arrayFeedSearch != false && $activeRss[$arrayFeedSearch] === $rssFeed) {
            return $this->getRssClass($rssFeed);
        }

        return (new $activeRss[$rssFeed]());
    }

    private function getRssClass(string $rssFeed)
    {
        $namespace = RssReader::NAMESPACE . '\\' . 'feeds\\';
        $rssClassName = $namespace . str_replace('-', '', ucwords($rssFeed, '-'));

        return (new $rssClassName());
    }

    /**
     * Used to parse an RSS feed.
     *
     * @param $url
     */
    public function readFromUrl(string $url)
    {
        $content = file_get_contents($url);

        // Instantiate XML element
        $xmlElement = new SimpleXMLElement($content);

        return $xmlElement;
    }

    public function toArray(SimpleXMLElement $xmlElement = null)
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

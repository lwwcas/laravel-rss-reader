<?php

namespace Lwwcas\LaravelRssReader;

use Illuminate\Support\Facades\Config;
use SimpleXMLElement;

class RssReader
{
    private const NAMESPACE = 'Lwwcas\LaravelRssReader';

    /**
     * RssReader constructor.
     */
    public function __construct()
    {
        //
    }

    /**
     * Used to parse an RSS feed.
     *
     * @param        $url
     * @param string $configuration
     * @param array  $options
     */
    // public static function read($url, $configuration = 'default', array $options = [])
    public function read(string $url)
    {
        $content = file_get_contents($url);

        // Instantiate XML element
        $xmlElement = new SimpleXMLElement($content);

        return $xmlElement;
    }

    public function feed(string $rssFeed)
    {
        if ($this->getActiveFeed($rssFeed) === null) {
            throw new \LogicException('Your RSS feed is not active in your settings file.');
        }

        $rssClass = $this->getRssClass($rssFeed);
        $url = $rssClass->url();
        $setup = $rssClass->setup();

        $feed = $this->read($url);
        $articles = [];

        // return $feed->{$setup['core']}->{$setup['articles']}->description;

        // foreach ($feed->{$setup['core']}->{$setup['articles']} as  $key => $article) {
        //     $articles[$key] = (array)$article;
        // }

        dd($feed);
    }

    private function getRssClass(string $rssFeed)
    {
        $namespace = RssReader::NAMESPACE . '\\' . 'feeds\\';
        $rssClassName = $namespace . str_replace('-', '', ucwords($rssFeed, '-'));
        $rssClass = null;

        $rssClass = (new $rssClassName());

        return $rssClass;
    }

    private function getActiveFeed(string $rssFeed)
    {
        $activeRss = $this->config('active-rss');
        if (!in_array($rssFeed, $activeRss)) {
            return null;
        }

        return $activeRss;
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

<?php

namespace Lwwcas\LaravelRssReader\Feeds;

use Illuminate\Support\Facades\Config;

abstract class BaseFeed
{
    protected $id = null;

    protected $generator = null;

    protected $url = null;

    protected $image = null;

    protected $title = null;

    protected $description = null;

    protected $language = null;

    protected $metadata = [];

    protected $setup = [];

    protected $article = [];

    protected $articleData = [];

    protected $cache = true;

    protected $autoUpdate = true;

    protected $badWordsVerification = true;

    public function id()
    {
        return $this->id;
    }

    public function generator()
    {
        $config = $this->configParameter('generator');
        if ($config != null) {
            return $config;
        }

        return $this->generator;
    }

    public function url()
    {
        $config = $this->configParameter('url');
        if ($config != null) {
            return $config;
        }

        return $this->url;
    }

    public function image()
    {
        $config = $this->configParameter('image');
        if ($config != null) {
            return $config;
        }

        return $this->image;
    }

    public function title()
    {
        $config = $this->configParameter('title');
        if ($config != null) {
            return $config;
        }

        return $this->title;
    }

    public function description()
    {
        $config = $this->configParameter('description');
        if ($config != null) {
            return $config;
        }

        return $this->description;
    }

    public function language()
    {
        $config = $this->configParameter('language');
        if ($config != null) {
            return $config;
        }

        return $this->language;
    }

    public function metadata()
    {
        $config = $this->configParameter('metadata');
        if ($config != null) {
            return $config;
        }

        return $this->metadata;
    }

    public function setup()
    {
        $config = $this->configParameter('setup');
        if ($config != null) {
            return $config;
        }

        return $this->setup;
    }

    public function article()
    {
        $config = $this->configParameter('article');
        if ($config != null) {
            return $config;
        }

        return $this->article;
    }

    public function articleData()
    {
        $config = $this->configParameter('articleData');
        if ($config != null) {
            return $config;
        }

        return $this->articleData;
    }

    public function cache()
    {
        $config = $this->configParameter('cache');
        if ($config != null) {
            return $config;
        }

        return $this->cache;
    }

    public function autoUpdate()
    {
        $config = $this->configParameter('autoUpdate');
        if ($config != null) {
            return $config;
        }

        return $this->autoUpdate;
    }

    public function badWordsVerification()
    {
        $config = $this->configParameter('badWordsVerification');
        if ($config != null) {
            return $config;
        }

        return $this->badWordsVerification;
    }

    public function all()
    {
        return [
            'id' => $this->id(),
            'generator' => $this->generator(),
            'url' => $this->url(),
            'image' => $this->image(),
            'title' => $this->title(),
            'description' => $this->Description(),
            'language' => $this->language(),
            'metadata' => $this->metadata(),
            'setup' => $this->setup(),
            'article' => $this->article(),
            'articleData' => $this->articleData(),
            'cache' => $this->cache(),
            'autoUpdate' => $this->autoUpdate(),
            'badWordsVerification' => $this->badWordsVerification(),
        ];
    }

    public function feedCreated(array $feed = []): array
    {
        return $feed;
    }

    public function customFilter(array $feed = []): array
    {
        return [];
    }

    public function dateParse(string $date, ?string $format = null)
    {
        $dateFormat = $format === null ? $this->config('default-date-format') : $format;
        $date = strtotime($date);
        return date($dateFormat, $date);
    }

    private function configParameter($config)
    {
        $rssId = $this->id . '.';
        $config = $this->config('config-rss.' . $rssId . $config);

        if ($config === null) {
            return null;
        }

        return $config;
    }

    private function config(string $config)
    {
        return Config::get('laravel-rss-reader.' . $config);
    }
}

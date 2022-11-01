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

    public function id()
    {
        return $this->id;
    }

    public function sourceGenerator()
    {
        $config = $this->configParameter('generator');
        if ($config != null) {
            return $config;
        }

        return $this->generator;
    }

    public function sourceUrl()
    {
        $config = $this->configParameter('url');
        if ($config != null) {
            return $config;
        }

        return $this->url;
    }

    public function sourceImage()
    {
        $config = $this->configParameter('image');
        if ($config != null) {
            return $config;
        }

        return $this->image;
    }

    public function sourceTitle()
    {
        $config = $this->configParameter('title');
        if ($config != null) {
            return $config;
        }

        return $this->title;
    }

    public function sourceDescription()
    {
        $config = $this->configParameter('description');
        if ($config != null) {
            return $config;
        }

        return $this->description;
    }

    public function sourceLanguage()
    {
        $config = $this->configParameter('language');
        if ($config != null) {
            return $config;
        }

        return $this->language;
    }

    public function sourceMetadata()
    {
        $config = $this->configParameter('metadata');
        if ($config != null) {
            return $config;
        }

        return $this->metadata;
    }

    public function sourceSetup()
    {
        $config = $this->configParameter('setup');
        if ($config != null) {
            return $config;
        }

        return $this->setup;
    }

    public function sourceArticle()
    {
        $config = $this->configParameter('article');
        if ($config != null) {
            return $config;
        }

        return $this->article;
    }

    public function sourceArticleData()
    {
        $config = $this->configParameter('articleData');
        if ($config != null) {
            return $config;
        }

        return $this->articleData;
    }

    public function sourceAll()
    {
        return [
            'id' => $this->id(),
            'generator' => $this->sourceGenerator(),
            'url' => $this->sourceUrl(),
            'image' => $this->sourceImage(),
            'title' => $this->sourceTitle(),
            'description' => $this->sourceDescription(),
            'language' => $this->sourceLanguage(),
            'metadata' => $this->sourceMetadata(),
            'setup' => $this->sourceSetup(),
            'article' => $this->sourceArticle(),
            'articleData' => $this->sourceArticleData(),
        ];
    }

    public function feedCreated(array $feed = [])
    {
        return $feed;
    }

    public function dateParse(string $date, ?string $format = null)
    {
        $dateFormat = $format === null ? $this->config('defaultDateFormat') : $format;
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

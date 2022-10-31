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

    protected $setup = [];

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

    public function language()
    {
        $config = $this->configParameter('language');
        if ($config != null) {
            return $config;
        }

        return $this->language;
    }

    public function setup()
    {
        $config = $this->configParameter('setup');
        if ($config != null) {
            return $config;
        }

        return $this->setup;
    }

    private function configParameter($config)
    {
        $rssId = $this->id . '.';
        $config = Config::get('laravel-rss-reader.config-rss.' . $rssId . $config);

        if ($config === null) {
            return null;
        }

        return $config;
    }
}

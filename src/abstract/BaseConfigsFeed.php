<?php

namespace Lwwcas\LaravelRssReader\Abstract;

use Lwwcas\LaravelRssReader\Concerns\HasConfigFeed;

abstract class BaseConfigsFeed
{
    use HasConfigFeed;

    public function id()
    {
        return $this->id;
    }

    public function generator()
    {
        $config = $this->configParameter('generator');
        if ($config === null) {
            return $this->generator;
        }

        return $config;
    }

    public function url()
    {
        $config = $this->configParameter('url');
        if ($config === null) {
            return $this->url;
        }

        return $config;
    }

    public function image()
    {
        $config = $this->configParameter('image');
        if ($config === null) {
            return $this->image;
        }

        return $config;
    }

    public function title()
    {
        $config = $this->configParameter('title');
        if ($config === null) {
            return $this->title;
        }

        return $config;
    }

    public function description()
    {
        $config = $this->configParameter('description');
        if ($config === null) {
            return $this->description;
        }

        return $config;
    }

    public function language()
    {
        $config = $this->configParameter('language');
        if ($config === null) {
            return $this->language;
        }

        return $config;
    }

    public function metadata()
    {
        $config = $this->configParameter('metadata');
        if ($config === null) {
            return $this->metadata;
        }

        return $config;
    }

    public function setup()
    {
        $config = $this->configParameter('setup');
        if ($config === null) {
            return $this->setup;
        }

        return $config;
    }

    public function article()
    {
        $config = $this->configParameter('article');
        if ($config === null) {
            return $this->article;
        }

        return $config;
    }

    public function articleData()
    {
        $config = $this->configParameter('articleData');
        if ($config === null) {
            return $this->articleData;
        }

        return $config;
    }

    public function cache()
    {
        $config = $this->configParameter('cache');
        if ($config === null) {
            return $this->cache;
        }

        return $config;
    }

    public function autoUpdate()
    {
        $config = $this->configParameter('autoUpdate');
        if ($config === null) {
            return $this->autoUpdate;
        }

        return $config;
    }

    public function badWordsVerification()
    {
        $config = $this->configParameter('badWordsVerification');
        if ($config === null) {
            return $this->badWordsVerification;
        }

        return $config;
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

    public function configParameter($config)
    {
        $rssId = $this->id . '.';
        $config = $this->config('my-rss.' . $rssId . $config);

        if ($config === null) {
            return null;
        }

        return $config;
    }
}

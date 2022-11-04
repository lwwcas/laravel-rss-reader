<?php

namespace Lwwcas\LaravelRssReader\Feeds;

abstract class BaseFeed extends BaseConfigsFeed implements ConfigableFeed
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
}

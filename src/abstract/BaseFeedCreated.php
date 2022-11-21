<?php

namespace Lwwcas\LaravelRssReader\Abstract;

use Lwwcas\LaravelRssReader\Contracts\FeedCreated;

abstract class BaseFeedCreated implements FeedCreated
{
    public function feedCreated(array $feed = []): array
    {
        return $feed;
    }
}

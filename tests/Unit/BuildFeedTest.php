<?php

namespace Tests\Unit;

use Lwwcas\LaravelRssReader\RssReader;
use Lwwcas\LaravelRssReader\Tests\TestCase;

class BuildFeedTest extends TestCase
{
    /** @test */
    public function it_should_build_an_rss_feed_class()
    {
        $laravelNews = (new RssReader())->buildRssClass('laravel-news');

        expect($laravelNews)->toBeObject();
    }
}

<?php

namespace Tests\Feature;

use Lwwcas\LaravelRssReader\Models\RssFeed;
use Lwwcas\LaravelRssReader\Models\RssFeedArticle;
use Lwwcas\LaravelRssReader\Tests\TestCase;

class SaveConsoleCommandTest extends TestCase
{
    /** @test */
    public function it_should_save_feed_based_on_key(): void
    {
        $this->artisan('rss-reader:save laravel-news')->assertSuccessful();
    }

    /** @test */
    public function it_not_should_save_feed_based_on_key_not_found_in_config_file(): void
    {
        $key = 'zzzz-example-zzz-' . rand(100, 9999);

        $this->artisan('rss-reader:save ' . $key)->assertFailed();
    }
}

<?php

namespace Tests\Feature;

use Lwwcas\LaravelRssReader\Models\RssFeed;
use Lwwcas\LaravelRssReader\Tests\TestCase;

class ReadConsoleCommandTest extends TestCase
{
    /** @test */
    public function it_should_read_feed_based_on_key(): void
    {
        RssFeed::factory()->create([
            'key' => 'laravel-news',
        ]);

        $this->artisan('rss-reader:read laravel-news')->assertSuccessful();
    }

    /** @test */
    public function it_should_read_feed_and_articles_based_on_key(): void
    {
        $rssFeed = RssFeed::factory()->create([
            'key' => 'laravel-news',
        ]);

        $this->createLaravelArticle($rssFeed->id);

        $this->artisan('rss-reader:read laravel-news')->assertSuccessful();
    }

    /** @test */
    public function it_not_should_read_feed_based_on_key_not_found_in_config_file(): void
    {
        $key = 'zzzz-example-zzz-' . rand(100, 9999);
        RssFeed::factory()->create([
            'key' => $key,
        ]);

        $this->artisan('rss-reader:read ' . $key)->assertFailed();
    }
}

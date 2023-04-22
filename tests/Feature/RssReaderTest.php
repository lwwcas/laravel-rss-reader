<?php

namespace Tests\Feature;

use Lwwcas\LaravelRssReader\Facedes\RssReader as RssReaderFacedes;
use Lwwcas\LaravelRssReader\RssReader;
use Lwwcas\LaravelRssReader\Feeds\LaravelNews;
use Lwwcas\LaravelRssReader\Models\RssFeed;
use Lwwcas\LaravelRssReader\Models\RssFeedArticle;
use Lwwcas\LaravelRssReader\Models\RssFeedLog;
use Lwwcas\LaravelRssReader\Tests\TestCase;

class RssReaderTest extends TestCase
{
    /** @test */
    public function it_should_build_the_instance_of_the_object_with_the_facedes()
    {
        $laravelNews = RssReaderFacedes::buildRssClass('laravel-news');
        $this->assertInstanceOf(LaravelNews::class, $laravelNews);
    }

    /** @test */
    public function it_should_read_the_database_feed_with_the_facedes()
    {
        $rssFeed = RssFeed::factory()->create([
            'key' => 'laravel-news',
        ]);

        $this->createLaravelArticle($rssFeed->id);

        $article = RssReaderFacedes::read('laravel-news')->first();

        $this->assertInstanceOf(RssFeedArticle::class, $article);
        $this->assertIsObject($article);

        $this->assertEquals($article['uuid'], 'e27d8216-4ee7-4778-b597-0286ca6d47f0');
        $this->assertEquals($article['title'], 'Laravel 10.7 Released');
        $this->assertEquals($article['slug'], 'laravel-107-released');
        $this->assertEquals($article['url'], 'https://laravel-news.com/laravel-10-7-0');
        $this->assertEquals($article['language'], 'en');
    }

    /** @test */
    public function it_should_read_the_database_feed()
    {
        $rssFeed = RssFeed::factory()->create([
            'key' => 'laravel-news',
        ]);

        $this->createLaravelArticle($rssFeed->id);

        $article = (new RssReader())->read('laravel-news')->first();

        $this->assertInstanceOf(RssFeedArticle::class, $article);
        $this->assertIsObject($article);

        $this->assertEquals($article['uuid'], 'e27d8216-4ee7-4778-b597-0286ca6d47f0');
        $this->assertEquals($article['title'], 'Laravel 10.7 Released');
        $this->assertEquals($article['slug'], 'laravel-107-released');
        $this->assertEquals($article['url'], 'https://laravel-news.com/laravel-10-7-0');
        $this->assertEquals($article['language'], 'en');
    }

    /** @test */
    public function it_should_record_the_log_read_whenever_the_feed_is_read_with_the_facedes()
    {
        $rssFeed = RssFeed::factory()->create([
            'title' => 'Laravel News',
            'key' => 'laravel-news',
        ]);

        $this->createLaravelArticle($rssFeed->id);

        RssReaderFacedes::read('laravel-news')->first();

        $logs = RssFeedLog::first();

        $this->assertNotNull($logs);
        $this->assertInstanceOf(RssFeedLog::class, $logs);
        $this->assertIsObject($logs);
        $this->assertEquals($logs['key'], 'laravel-news');
        $this->assertEquals($logs['action'], RssFeedLog::ACTION_READ);
    }

    /** @test */
    public function it_should_record_the_log_read_whenever_the_feed_is_read()
    {
        $rssFeed = RssFeed::factory()->create([
            'key' => 'laravel-news',
        ]);

        $this->createLaravelArticle($rssFeed->id);

        (new RssReader())->read('laravel-news')->first();

        $logs = RssFeedLog::first();

        $this->assertNotNull($logs);
        $this->assertInstanceOf(RssFeedLog::class, $logs);
        $this->assertIsObject($logs);
        $this->assertEquals($logs['key'], 'laravel-news');
        $this->assertEquals($logs['action'], RssFeedLog::ACTION_READ);
    }

    /** @test */
    public function it_should_record_the_log_autoread_whenever_the_feed_is_read_with_the_facedes()
    {
        $rssFeed = RssFeed::factory()->create([
            'title' => 'Laravel News',
            'key' => 'laravel-news',
        ]);

        $this->createLaravelArticle($rssFeed->id);

        RssReaderFacedes::read('laravel-news', true)->first();

        $logs = RssFeedLog::first();

        $this->assertNotNull($logs);
        $this->assertInstanceOf(RssFeedLog::class, $logs);
        $this->assertIsObject($logs);
        $this->assertEquals($logs['key'], 'laravel-news');
        $this->assertEquals($logs['action'], RssFeedLog::ACTION_AUTOREAD);
    }

    /** @test */
    public function it_should_record_the_log_autoread_whenever_the_feed_is_read()
    {
        $rssFeed = RssFeed::factory()->create([
            'key' => 'laravel-news',
        ]);

        $this->createLaravelArticle($rssFeed->id);

        (new RssReader())->read('laravel-news', true)->first();

        $logs = RssFeedLog::first();

        $this->assertNotNull($logs);
        $this->assertInstanceOf(RssFeedLog::class, $logs);
        $this->assertIsObject($logs);
        $this->assertEquals($logs['key'], 'laravel-news');
        $this->assertEquals($logs['action'], RssFeedLog::ACTION_AUTOREAD);
    }

    /** @test */
    public function it_should_create_a_feed_class_that_is_registered_in_the_configuration_file()
    {
        config()->set('lw-rss-reader.active-rss', ['laravel-news']);

        $feed = (new RssReader())->feed('laravel-news');
        $article = $feed->first();

        $this->assertNotNull($feed);
        $this->assertNotNull($article);
        $this->assertIsObject($feed);
        $this->assertIsArray($article);
        $this->assertEquals($feed->getRssFeed(), 'laravel-news');
        $this->assertArrayHasKey('url', $article);
        $this->assertArrayHasKey('title', $article);
        $this->assertArrayHasKey('description', $article);
        $this->assertArrayHasKey('date', $article);
        $this->assertArrayHasKey('image', $article);
        $this->assertArrayHasKey('data', $article);
        $this->assertArrayHasKey('custom-filter', $article);
        $this->assertArrayHasKey('black-list', $article);
        $this->assertArrayHasKey('status', $article['black-list']);
        $this->assertArrayHasKey('bad-words', $article['black-list']);
    }

    /** @test */
    public function it_not_should_create_a_feed_class_that_is_not_registered_in_the_configuration_file()
    {
        config()->set('lw-rss-reader.active-rss', []);

        $this->expectException(\LogicException::class);
        $this->expectExceptionMessage('Your RSS feed is not active in your settings file.');

        (new RssReader())->feed('laravel-news');
    }

    /** @test */
    public function it_should_pass_the_rss_feed_to_the_highest_instance_parameter()
    {
        config()->set('lw-rss-reader.active-rss', ['laravel-news']);

        $feed = (new RssReader())->feed('laravel-news');

        $this->assertNotNull($feed->getRssFeed());
        $this->assertEquals($feed->getRssFeed(), 'laravel-news');
    }

    /** @test */
    public function it_should_pass_the_root_feed_to_the_highest_instance_parameter()
    {
        config()->set('lw-rss-reader.active-rss', ['laravel-news']);

        $feed = (new RssReader())->feed('laravel-news');
        $rootFeed = $feed->all();

        $this->assertNotNull($rootFeed);
        $this->assertIsArray($rootFeed);
        $this->assertArrayHasKey('url', $rootFeed);
        $this->assertArrayHasKey('title', $rootFeed);
        $this->assertArrayHasKey('description', $rootFeed);
        $this->assertArrayHasKey('metadata', $rootFeed);
        $this->assertArrayHasKey('generator', $rootFeed['metadata']);
        $this->assertArrayHasKey('language', $rootFeed['metadata']);
        $this->assertArrayHasKey('lastUpdate', $rootFeed['metadata']);
        $this->assertArrayHasKey('image', $rootFeed);
        $this->assertArrayHasKey('articles', $rootFeed);
    }

    /** @test */
    public function it_should_pass_the_root_feed_articles_to_the_highest_instance_parameter()
    {
        config()->set('lw-rss-reader.active-rss', ['laravel-news']);

        $feed = (new RssReader())->feed('laravel-news');
        $feedArticles = $feed->get();

        $this->assertNotNull($feedArticles);
        $this->assertIsArray($feedArticles);
    }

    /** @test */
    public function it_should_pass_the_root_feed_articles_on_all_to_the_highest_instance_parameter()
    {
        config()->set('lw-rss-reader.active-rss', ['laravel-news']);

        $feed = (new RssReader())->feed('laravel-news');
        $feedArticles = $feed->all();

        $this->assertNotNull($feedArticles);
        $this->assertIsArray($feedArticles);
        $this->assertArrayHasKey('articles', $feedArticles);
        $this->assertNotNull($feedArticles['articles']);
        $this->assertIsArray($feedArticles['articles']);
    }

    /** @test */
    public function it_should_return_the_same_instance_of_the_class()
    {
        config()->set('lw-rss-reader.active-rss', ['laravel-news']);

        $feed = (new RssReader())->feed('laravel-news');

        $this->assertNotNull($feed);
        $this->assertInstanceOf(RssReader::class, $feed);
    }

    /** @test */
    public function it_should_return_null_when_save_is_called_and_there_is_no_rss_feed()
    {
        config()->set('lw-rss-reader.active-rss', []);

        $feed = (new RssReader())->save();

        $this->assertNull($feed);
    }

    /** @test */
    public function it_should_return_null_when_save_is_called_and_cache_is_set_to_false()
    {
        config()->set('lw-rss-reader.active-rss', ['laravel-news']);
        config()->set('lw-rss-reader.my-rss', [
            'laravel-news' => [
                'cache' => false,
            ]
        ]);

        $feed = (new RssReader());
        $class = $feed->getActiveFeed('laravel-news');

        $response = $feed->feed('laravel-news')->save();

        $this->assertNull($response);
        $this->assertNotNull($feed);
        $this->assertFalse($class->cache());
    }

    /** @test */
    public function it_not_should_return_null_when_save_is_called_and_cache_is_set_to_true()
    {
        config()->set('lw-rss-reader.active-rss', ['laravel-news']);
        config()->set('lw-rss-reader.my-rss', [
            'laravel-news' => [
                'cache' => true,
            ]
        ]);

        $feed = (new RssReader());
        $class = $feed->getActiveFeed('laravel-news');

        $response =  $feed->feed('laravel-news')->save();

        $this->assertNotNull($response);
        $this->assertNotNull($feed);
        $this->assertTrue($class->cache());
        $this->assertInstanceOf(RssReader::class, $feed);
    }
}

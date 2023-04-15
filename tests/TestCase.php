<?php

namespace Lwwcas\LaravelRssReader\Tests;

use Illuminate\Database\Query\Expression;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;
use Lwwcas\LaravelRssReader\Models\RssFeed;
use Lwwcas\LaravelRssReader\Models\RssFeedArticle;
use Lwwcas\LaravelRssReader\Providers\RssReaderServiceProvider;

class TestCase extends \Orchestra\Testbench\TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();

        $this->createTables();
    }

    protected function getPackageProviders($app)
    {
        return [
            RssReaderServiceProvider::class,
        ];
    }

    protected function getEnvironmentSetUp($app)
    {
        // perform environment setup
    }

    public function createTables()
    {
        $migrationsPath = dirname(__DIR__) . '/src/database/migrations';
        $this->loadMigrationsFrom($migrationsPath);
    }

    public function createLaravelArticle(int $feed = null)
    {
        $feedId = $feed === null ? RssFeed::factory()->create()->id : $feed;
        return RssFeedArticle::create([
            'feed_id' => $feedId,
            'uuid' => 'e27d8216-4ee7-4778-b597-0286ca6d47f0',
            'url' => 'https://laravel-news.com/laravel-10-7-0',
            'title' => 'Laravel 10.7 Released',
            'slug' => 'laravel-107-released',
            'description' => 'Laravel 10.7 added pipe() to run commands in sequence, setValue() to Validator',
            'image' => 'https://laravelnews.s3.amazonaws.com/images/laravel-10-featured.png',
            'language' => 'en',
            'data' => '{"category": "news"}',
            'active' => true,
            'black_list' => false,
            'bad_words' => [],
            'date' => '2023-04-12 05:00:08',
            'custom' => [],
        ]);
    }
}

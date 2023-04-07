<?php

namespace Lwwcas\LaravelRssReader\Tests;

use Illuminate\Database\Query\Expression;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schema;
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

    public function createFeedArticlesTables()
    {
        Schema::create('lw_feed_articles', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('feed_id')->unsigned();
            $table->uuid('uuid');
            $table->string('url');
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('description');
            $table->string('image')->nullable();
            $table->string('language');
            $table->json('data')
                ->default(new Expression('(JSON_ARRAY())'))
                ->comment('The extra information of the saved article');
            $table->json('custom')
                ->default(new Expression('(JSON_ARRAY())'))
                ->comment('A custom filter for automation or specific searches');
            $table->boolean('active')
                ->default(true)
                ->comment('Defines if the article is able to be visible');
            $table->boolean('black_list')
                ->default(false)
                ->comment('The article is blacklisted if there are offensive words');
            $table->json('bad_words')
                ->default(new Expression('(JSON_ARRAY())'))
                ->comment('If it\'s on the blacklist, it will list the bad words')
                ->nullable();
            $table->timestamp('date')->nullable();
            $table->timestamps();

            $table->foreign('feed_id')->references('id')->on('lw_feeds')->onDelete('cascade');
        });
    }
    public function createFeedLogsTables()
    {
        Schema::create('lw_feed_logs', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('feed_id')->unsigned();
            $table->uuid('uuid');
            $table->string('title')->nullable();
            $table->string('key');
            $table->string('action');
            $table->timestamp('date');
            $table->timestamps();

            $table->foreign('feed_id')->references('id')->on('lw_feeds')->onDelete('cascade');
        });
    }
    public function createFeedsTables()
    {
        Schema::create('lw_feeds', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid');
            $table->string('title')->nullable()->comment('The name of RSS feed provider');
            $table->string('key')->unique()->index()->comment('The key | id on config file');
            $table->timestamp('read_at')->comment('Last time the original RSS was accessed');
            $table->timestamps();
        });
    }

    public function createTables()
    {
        $this->createFeedArticlesTables();
        $this->createFeedLogsTables();
        $this->createFeedsTables();
    }
}

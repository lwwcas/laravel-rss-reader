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

    public function createTables()
    {
        $migrationsPath = dirname(__DIR__) . '/src/database/migrations';
        $this->loadMigrationsFrom($migrationsPath);
    }
}

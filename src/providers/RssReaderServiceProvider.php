<?php

namespace Lwwcas\LaravelRssReader\Providers;

use Lwwcas\LaravelRssReader\RssReader;
use Spatie\LaravelPackageTools\Commands\InstallCommand;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class RssReaderServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        $package
            ->name('laravel-rss-reader')
            ->hasConfigFile('lw-rss-reader')
            ->hasMigrations([
                'create_lw_feeds_table',
                'create_lw_feed_articles_table',
                'create_lw_feed_logs_table'
            ])
            ->hasInstallCommand(function (InstallCommand $command) {
                $command
                    ->startWith(function (InstallCommand $command) {
                        $command->info('');
                        $command->info('Hello, consider leaving a star in the repository and helping us to be better.');
                        $command->info('');
                    })
                    ->publishConfigFile()
                    ->publishMigrations()
                    ->copyAndRegisterServiceProviderInApp()
                    ->askToStarRepoOnGitHub('lwwcas/laravel-rss-reader')
                    ->endWith(function (InstallCommand $command) {
                        $command->info('');
                        $command->info('You do not find the happy life. You make it.');
                    });
            });
    }

    public function packageBooted()
    {
        //
    }

    public function packageRegistered()
    {
        $this->app->bind('rss-reader', function ($app) {
            return new RssReader();
        });

        $this->app->alias('laravel-rss-reader', RssReader::class);
    }
}

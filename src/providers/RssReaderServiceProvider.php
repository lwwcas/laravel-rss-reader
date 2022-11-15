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
            ->name('rss-reader')
            ->hasConfigFile('config')
            ->hasMigrations([
                'create_lw_feeds_table',
                'create_lw_feed_articles_table',
                'create_lw_feed_logs_table'
            ])
            ->hasInstallCommand(function (InstallCommand $command) {
                $command
                    ->publishConfigFile()
                    ->publishMigrations()
                    ->copyAndRegisterServiceProviderInApp()
                    ->askToStarRepoOnGitHub('lwwcas/laravel-rss-reader')
                    ->endWith(function (InstallCommand $command) {
                        $command->info('Have a great day!');
                    });
            });
    }

    public function packageBooted()
    {
        //
    }

    public function packageRegistered()
    {
        $this->app->singleton('rss-reader', function ($app, $arguments) {
            return new RssReader();
        });

        $this->app->alias('rss-reader', RssReader::class);
    }
}

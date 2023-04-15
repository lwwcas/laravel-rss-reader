<?php

namespace Lwwcas\LaravelRssReader\Commands;

use Illuminate\Console\Command;
use Lwwcas\LaravelRssReader\RssReader;

class RssReaderReadCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'rss-reader:read
                                {feed : The Feed ID of RSS}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Read a feed that is in the database';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->newLine();

        $reader = (new RssReader());
        $rssFeed = $this->argument('feed');
        $rssData = $reader->getActiveFeed($rssFeed);

        if ($rssData === null) {
            $this->doNotFountRssFeedOutput($rssFeed);
            return Command::FAILURE;
        }

        $this->tablesOutPut($rssData);

        $read = $reader->read($rssFeed, true);
        if ($read === null) {
            $this->info('There are no articles to list');
            $this->newLine();

            $this->line('Try running this command');
            $this->line('php artisan rss-reader:save ' . $rssFeed);
            return Command::SUCCESS;
        }

        $articles = $read->currentMonth()->get();

        $this->tablesArticlesSimplesOutput($articles);

        return Command::SUCCESS;
    }

    private function tablesArticlesSimplesOutput($articles): void
    {
        $articlesTable = [];
        foreach ($articles as $article) {
            array_push($articlesTable, [
                'title' => $this->shortTitle($article['title']) ?? '',
                'url' => $article['url'] ?? '',
            ]);
        }

        $this->table(
            [
                'Title',
                'Url',
            ],
            $articlesTable
        );
    }

    private function tablesOutPut($reader): void
    {
        $this->table(
            [
                'Name',
                'Source',
            ],
            [
                [
                    $reader->title(),
                    $reader->generator(),
                ],
            ],
        );

        $this->table(
            [
                'Language',
                'description',
            ],
            [
                [
                    $reader->language(),
                    $reader->description(),

                ],
            ],
        );

        $this->newLine();
    }

    private function doNotFountRssFeedOutput(string $rssFeed): void
    {
        $this->error(' The RSS Feed ' . $rssFeed . ' don\'t found ');
        $this->newLine();

        $this->line('The complete list of your RSS Feeds are in the lw-rss-reader.php configuration file');
        $this->newLine();

        $this->line('If you can\'t find the configure file try running this command');
        $this->line('php artisan vendor:publish --tag=rss-reader-config');
    }

    private function shortTitle(string $title)
    {
        $titleMaxLength = 25;
        return strlen($title) > $titleMaxLength ? substr($title, 0, $titleMaxLength) . '...' : $title;
    }
}

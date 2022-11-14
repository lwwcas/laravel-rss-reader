<?php

namespace Lwwcas\LaravelRssReader\Concerns;

use Lwwcas\LaravelRssReader\Abstract\BaseFeed;

trait BuildFeed
{
    use HasHasConfigFeed;

    protected function buildRssClass(string $rssFeed): BaseFeed
    {
        $namespace = 'Lwwcas\\LaravelRssReader\\feeds\\';
        $rssClassName = $namespace . str_replace('-', '', ucwords($rssFeed, '-'));

        return (new $rssClassName());
    }

    protected function buildArticlesFeed(BaseFeed $rssClass, array $feed): array
    {
        $setup = $rssClass->setup();
        $articleData = $rssClass->articleData();
        $articleSource = $rssClass->article();

        $articleDataFormat = $this->config('default-articles-date-format');
        $articles = [];

        foreach ($feed[$setup['articles']] as $key => $article) {
            $articleDate = $rssClass->dateParse($article[$articleSource['date']], $articleDataFormat);
            $articles[$key] = [
                'url' => $article[$articleSource['url']],
                'title' => $article[$articleSource['title']],
                'description' => $article[$articleSource['description']],
                'date' => $articleDate,
                'image' => null,
            ];

            $articleDataList = [];
            foreach ($articleData as $data) {
                $articleDataList[$data] = $article[$data];
            }

            $articles[$key]['data'] = $articleDataList;
        }

        return $articles;
    }

    protected function buildRootFeed(BaseFeed $rssClass, array $feed): array
    {
        $setup = $rssClass->setup();
        $metadata = $rssClass->metadata();

        $feedDate = $rssClass->dateParse($feed[$metadata['lastUpdate']]);

        $root = [
            'url' => $feed[$setup['url']],
            'title' => $feed[$setup['title']],
            'description' => $feed[$setup['description']],
            'metadata' => [
                'generator' => $feed[$metadata['generator']],
                'language' => $feed[$metadata['language']],
                'lastUpdate' => $feedDate,
            ],
        ];

        if (array_key_exists($setup['image'], $feed) === true) {
            if (array_key_exists('url', $feed[$setup['image']])) {
                $root['image'] = $feed[$setup['image']]['url'];
            }
        }

        return $root;
    }
}

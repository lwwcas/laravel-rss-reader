<?php

namespace Lwwcas\LaravelRssReader;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Lwwcas\LaravelRssReader\Models\RssFeed;
use Lwwcas\LaravelRssReader\Models\RssFeedLog;

class RssReader extends RssReaderBase
{
    public function feed(string $rssFeed): RssReader
    {
        $this->rssFeed = $rssFeed;
        $rssClass = $this->getActiveFeed($rssFeed);

        if ($rssClass === null) {
            throw new \LogicException('Your RSS feed is not active in your settings file.');
        }

        $feed = $this->getNormalizeFeed($rssClass);
        $rootFeed = $this->generateRootFeed($rssClass, $feed);
        $rootFeed['articles'] = $this->generateArticlesFeed($rssClass, $feed);
        $rootFeed['articles'] = $this->generateCustomFilter($rssClass, $rootFeed['articles']);

        $this->rootFeed = $rssClass->feedCreated($rootFeed);

        $this->rootFeed['articles'] = $this->verifyBannedWords($rssClass, $rootFeed['articles']);

        return $this;
    }

    public function save()
    {
        if ($this->rssFeed === null) {
            return null;
        }

        $rssClass = $this->getActiveFeed($this->rssFeed);

        if ($rssClass->sourceCache() === false) {
            return null;
        }

        $articles = $this->rootFeed['articles'];

        $response = DB::transaction(function () use ($rssClass, $articles) {
            $now = date('Y-m-d H:i:s');
            $rssFeed = RssFeed::updateOrCreate(
                [
                    'key' => $rssClass->id(),
                ],
                [
                    'title' => $rssClass->sourceTitle(),
                    'key' => $rssClass->id(),
                    'read_at' => $now,
                ]
            );

            $rssFeed->logs()->create([
                'title' => $rssClass->sourceTitle(),
                'key' => $rssClass->id(),
                'action' => RssFeedLog::ACTION_SAVE,
                'read_at' => $now,
            ]);

            foreach ($articles as $article) {
                $slug = Str::of($article['title'])->slug('-');
                $rssFeed->articles()->updateOrCreate(
                    [
                        'slug' => $slug,
                    ],
                    [
                        'url' => $article['url'],
                        'title' => $article['title'],
                        'description' => $article['description'],
                        'image' => $article['image'],
                        'data' => $article['data'],
                        'date' => $article['date'],
                        'custom' => $article['custom_filter'],
                        'language' => $rssClass->sourceLanguage(),
                        'active' => true,
                        'black_list' => false,
                    ]
                );
            }

            return $rssFeed;
        });

        return $response;
    }
}

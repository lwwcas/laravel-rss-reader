<?php

namespace Lwwcas\LaravelRssReader;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Lwwcas\LaravelRssReader\Abstract\BaseRssReader;
use Lwwcas\LaravelRssReader\Models\RssFeed;
use Lwwcas\LaravelRssReader\Models\RssFeedLog;

class RssReader extends BaseRssReader
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
        $this->rootFeed['articles'] = $this->verifyBannedWords($rssClass, $this->rootFeed['articles']);

        return $this;
    }

    public function save(): RssReader
    {
        if ($this->rssFeed === null) {
            return null;
        }

        $rssClass = $this->getActiveFeed($this->rssFeed);

        if ($rssClass->cache() === false) {
            return null;
        }

        $articles = $this->rootFeed['articles'];
        DB::transaction(function () use ($rssClass, $articles) {
            $now = date('Y-m-d H:i:s');
            $rssFeed = RssFeed::updateOrCreate(
                [
                    'key' => $rssClass->id(),
                ],
                [
                    'title' => $rssClass->title(),
                    'key' => $rssClass->id(),
                    'read_at' => $now,
                ]
            );

            $rssFeed->logs()->create([
                'title' => $rssClass->title(),
                'key' => $rssClass->id(),
                'action' => RssFeedLog::ACTION_SAVE,
                'read_at' => $now,
            ]);

            foreach ($articles as $article) {
                $saveArticlesOnBlackList = $this->saveArticlesOnBlackList($article);
                if ($saveArticlesOnBlackList === false) {
                    continue;
                }

                $isActive = true;
                $hideArticlesOnBlackList = $this->hideArticlesOnBlackList($article);
                if ($hideArticlesOnBlackList === true) {
                    $isActive = false;
                }

                $isOnBlackList = $this->isOnBlacklist($article);
                $badWords = [];
                if ($isOnBlackList === true) {
                    $badWords = $article['black-list']['words'];
                }

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
                        'language' => $rssClass->language(),
                        'active' => $isActive,
                        'black_list' => $isOnBlackList,
                        'bad_words' => $badWords,
                    ]
                );
            }

            return $rssFeed;
        });

        return $this;
    }
}

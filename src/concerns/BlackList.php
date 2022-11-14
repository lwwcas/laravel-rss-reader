<?php

namespace Lwwcas\LaravelRssReader\Concerns;

use Lwwcas\LaravelRssReader\Abstract\BaseFeed;
use Lwwcas\LaravelRssReader\BadWords\BadWord;

trait BlackList
{
    use HasConfigFeed;

    protected function isOnBlacklist(array $article): bool
    {
        $isBlackList = @$article['black-list']['status'];
        if ($isBlackList === null || $isBlackList === false) {
            return false;
        }

        return true;
    }

    protected function hideArticlesOnBlackList(array $article): bool
    {
        $isBlackList = $this->isOnBlacklist($article);
        $hideArticlesOnBlackList = $this->config('hide-articles-on-blacklist');

        if ($isBlackList === true && $hideArticlesOnBlackList === true) {
            return true;
        }

        return false;
    }

    protected function saveArticlesOnBlackList(array $article): bool
    {
        $isBlackList = $this->isOnBlacklist($article);
        $saveArticlesOnBlackList = $this->config('save-articles-on-blacklist');

        if ($isBlackList === true && $saveArticlesOnBlackList === false) {
            return false;
        }

        return true;
    }

    protected function verifyBannedWords(BaseFeed $rssClass, array $articles): array
    {
        if ($rssClass->badWordsVerification() === false) {
            return $articles;
        }

        $_articles = [];

        foreach ($articles as $article) {
            $description = $article['description'];
            $verification = BadWord::verifyParagraph($description);
            $article['black-list'] = [
                'status' => $verification['black-list'],
                'bad-words' => $verification['words'],
            ];
            $_articles[] = $article;
        }

        return $_articles;
    }
}

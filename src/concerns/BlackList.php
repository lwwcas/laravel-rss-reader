<?php

namespace Lwwcas\LaravelRssReader\Concerns;

trait BlackList
{
    use ConfigFeed;

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
}

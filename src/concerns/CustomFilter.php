<?php

namespace Lwwcas\LaravelRssReader\Concerns;

use Lwwcas\LaravelRssReader\Abstract\BaseFeed;

trait CustomFilter
{
    protected function buildCustomFilter(BaseFeed $rssClass, array $articles): array
    {
        $_articles = [];
        foreach ($articles as $article) {
            $custom = $rssClass->customFilter($article);
            if ($custom === null) {
                $article['custom_filter'] = null;
                continue;
            }

            if (is_array($custom) === false) {
                $article['custom_filter'] = null;
                continue;
            }

            $article['custom_filter'] = $rssClass->customFilter($article);
            $_articles[] = $article;
        }

        return $_articles;
    }
}

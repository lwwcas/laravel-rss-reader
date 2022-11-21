<?php

namespace Lwwcas\LaravelRssReader\Concerns;

use Lwwcas\LaravelRssReader\Abstract\BaseFeed;
use Lwwcas\LaravelRssReader\Contracts\CustomFilter;

trait HasCustomFilterBuilder
{
    protected function buildCustomFilter(BaseFeed $rssClass, array $articles): array
    {
        $_articles = [];
        foreach ($articles as $article) {
            $custom = $this->filter($rssClass, $article);
            if ($custom === null) {
                $article['custom_filter'] = null;
                continue;
            }

            if (is_array($custom) === false) {
                $article['custom_filter'] = null;
                continue;
            }

            $article['custom_filter'] = $custom;
            $_articles[] = $article;
        }

        return $_articles;
    }

    private function filter(BaseFeed $rssClass, array $article): array
    {
        $ownerClassPath = $rssClass->configParameter('custom-filter');

        if ($ownerClassPath === null) {
            return $rssClass->customFilter($article);
        }

        $this->exceptions($ownerClassPath, $rssClass->id());

        return (new $ownerClassPath())->customFilter($article);
    }

    private function exceptions(string $path, string $id)
    {
        if (class_exists($path) === false) {
            $rssClassId = strtoupper($id);
            throw new \Exception(
                'Class "' . $path . '" not found |
                On rss feed config file, my-rss -> ' . $rssClassId . ' -> custom-filter not found'
            );
        }

        $ownerClass = (new $path());

        if ($ownerClass instanceof CustomFilter === false) {
            throw new \Exception(
                'Class "' . $path . '" not extends BaseCustomFilter'
            );
        }

        if (method_exists($path, 'customFilter') === false) {
            throw new \Exception(
                'On the Class "' . $path . '" the method "customFilter" not found'
            );
        }

        return null;
    }
}

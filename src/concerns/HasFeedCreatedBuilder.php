<?php

namespace Lwwcas\LaravelRssReader\Concerns;

use Lwwcas\LaravelRssReader\Abstract\BaseFeed;
use Lwwcas\LaravelRssReader\Contracts\FeedCreated;

trait HasFeedCreatedBuilder
{
    protected function buildFeedCreator(BaseFeed $rssClass, array $feed): array
    {
        return $this->feedCreated($rssClass, $feed);
    }

    private function feedCreated(BaseFeed $rssClass, array $feed): array
    {
        $ownerClassPath = $rssClass->configParameter('feed-created');

        if ($ownerClassPath === null) {
            return $rssClass->feedCreated($feed);
        }

        $this->exceptions($ownerClassPath, $rssClass->id());

        return (new $ownerClassPath())->feedCreated($feed);
    }

    private function exceptions(string $path, string $id)
    {
        if (class_exists($path) === false) {
            $rssClassId = strtoupper($id);
            throw new \Exception(
                'Class "' . $path . '" not found |
                On rss feed config file, my-rss -> ' . $rssClassId . ' -> feed-created not found'
            );
        }

        $ownerClass = (new $path());

        if ($ownerClass instanceof FeedCreated === false) {
            throw new \Exception(
                'Class "' . $path . '" not extends BaseFeedCreated'
            );
        }

        if (method_exists($path, 'feedCreated') === false) {
            throw new \Exception(
                'On the Class "' . $path . '" the method "feedCreated" not found'
            );
        }

        return null;
    }
}

<?php

namespace Lwwcas\LaravelRssReader\Facedes;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Lwwcas\LaravelRssReader\Skeleton\SkeletonClass
 */
class RssReader extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'rss-reader';
    }
}

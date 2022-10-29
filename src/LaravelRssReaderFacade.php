<?php

namespace Lwwcas\LaravelRssReader;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Lwwcas\LaravelRssReader\Skeleton\SkeletonClass
 */
class LaravelRssReaderFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'laravel-rss-reader';
    }
}

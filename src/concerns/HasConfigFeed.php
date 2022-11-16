<?php

namespace Lwwcas\LaravelRssReader\Concerns;

use Illuminate\Support\Facades\Config;

trait HasConfigFeed
{
    /**
     * Used internally in order to retrieve a specific value from the
     * configuration file.
     *
     * @param string $configuration The name of the configuration to use
     *
     * @return mixed
     */
    protected function config($configuration)
    {
        return Config::get('lw-rss-reader.' . $configuration);
    }
}

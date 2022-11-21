<?php

namespace Lwwcas\LaravelRssReader\Abstract;

use Lwwcas\LaravelRssReader\Contracts\CustomFilter;

abstract class BaseCustomFilter implements CustomFilter
{
    public function customFilter(array $article = []): array
    {
        return [];
    }
}

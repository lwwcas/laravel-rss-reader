<?php

namespace Lwwcas\LaravelRssReader\Feeds;

interface ConfigableFeed
{
    public function id();

    public function generator();

    public function url();

    public function image();

    public function title();

    public function description();

    public function language();

    public function metadata();

    public function setup();

    public function article();

    public function articleData();

    public function cache();

    public function autoUpdate();

    public function badWordsVerification();

    public function all();
}

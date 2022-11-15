<?php

namespace Tests\Unit;

use Lwwcas\LaravelRssReader\RssReader;
use Lwwcas\LaravelRssReader\Tests\TestCase;

class BlackListTest extends TestCase
{
    /** @test */
    public function it_verify_if_the_article_is_on_the_blacklist()
    {
        $article['black-list']['status'] = true;
        $isOnBlacklist = (new RssReader())->isOnBlacklist($article);

        $this->assertTrue($isOnBlacklist);
    }

    /** @test */
    public function it_verify_if_the_article_is_not_on_the_blacklist()
    {
        $article['black-list']['status'] = false;
        $isOnBlacklist = (new RssReader())->isOnBlacklist($article);

        $this->assertFalse($isOnBlacklist);
    }

    /** @test */
    public function it_verify_if_the_article_is_not_defined()
    {
        $article = [];
        $isOnBlacklist = (new RssReader())->isOnBlacklist($article);

        $this->assertFalse($isOnBlacklist);

        $article['black-list'] = [];
        $isOnBlacklist = (new RssReader())->isOnBlacklist($article);

        $this->assertFalse($isOnBlacklist);
    }

    /** @test */
    public function it_verify_if_the_article_is_defined_and_null()
    {
        $article['black-list']['status'] = null;
        $isOnBlacklist = (new RssReader())->isOnBlacklist($article);

        $this->assertFalse($isOnBlacklist);
    }

    /** @test */
    public function it_should_hidden_article_on_blacklist()
    {
        $article['black-list']['status'] = true;
        config()->set('lw-rss-reader.hide-articles-on-blacklist', true);

        $response = (new RssReader())->hideArticlesOnBlackList($article);

        $this->assertTrue($response);
    }

    /** @test */
    public function it_not_should_hidden_article_on_blacklist()
    {
        $article['black-list']['status'] = true;
        config()->set('lw-rss-reader.hide-articles-on-blacklist', false);
        $response = (new RssReader())->hideArticlesOnBlackList($article);

        $this->assertFalse($response);
    }

    /** @test */
    public function it_not_should_hide_the_article_that_is_not_blacklisted()
    {
        $article['black-list']['status'] = false;
        config()->set('lw-rss-reader.hide-articles-on-blacklist', true);
        $response = (new RssReader())->hideArticlesOnBlackList($article);

        $this->assertFalse($response);
    }

    /** @test */
    public function it_should_save_articles_on_blacklist()
    {
        $article['black-list']['status'] = true;
        config()->set('lw-rss-reader.save-articles-on-blacklist', true);
        $response = (new RssReader())->saveArticlesOnBlackList($article);

        $this->assertTrue($response);
    }

    /** @test */
    public function it_not_should_save_articles_on_blacklist()
    {
        $article['black-list']['status'] = true;
        config()->set('lw-rss-reader.save-articles-on-blacklist', false);
        $response = (new RssReader())->saveArticlesOnBlackList($article);

        $this->assertFalse($response);
    }

    /** @test */
    public function it_should_save_the_article_that_is_not_blacklisted()
    {
        $article['black-list']['status'] = false;
        config()->set('lw-rss-reader.save-articles-on-blacklist', true);
        $response = (new RssReader())->saveArticlesOnBlackList($article);

        $this->assertTrue($response);
    }
}

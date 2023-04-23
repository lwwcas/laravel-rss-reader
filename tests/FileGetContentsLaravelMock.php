<?php

namespace Lwwcas\LaravelRssReader\Tests;

use SimpleXMLElement;

trait FileGetContentsLaravelMock
{
    public function laravelXmlSimulatedReturn()
    {
        $xmlElement = new SimpleXMLElement($this->laravelSimulatedReturn());
        return $xmlElement;
    }

    public function laravelSimulatedReturn()
    {
        return '<?xml version="1.0" encoding="UTF-8"?>
<?xml-stylesheet type="text/xsl" media="screen" href="/~files/feed-premium.xsl"?>
<rss xmlns:atom="http://www.w3.org/2005/Atom" xmlns:content="http://purl.org/rss/1.0/modules/content/" xmlns:dc="http://purl.org/dc/elements/1.1/" xmlns:feedpress="https://feed.press/xmlns" xmlns:media="http://search.yahoo.com/mrss/" xmlns:podcast="https://podcastindex.org/namespace/1.0" xmlns:slash="http://purl.org/rss/1.0/modules/slash/" xmlns:sy="http://purl.org/rss/1.0/modules/syndication/" xmlns:wfw="http://wellformedweb.org/CommentAPI/" version="2.0">
   <channel>
      <feedpress:locale>en</feedpress:locale>
      <atom:link rel="hub" href="http://feedpress.superfeedr.com/" />
      <image>
         <link>https://laravel-news.com</link>
         <title><![CDATA[Laravel News]]></title>
         <url>https://static.feedpress.com/logo/laravelnews-6027ee343fdff.png</url>
      </image>
      <title>Laravel News</title>
      <atom:link href="https://feed.laravel-news.com/" rel="self" type="application/rss+xml" />
      <link>https://laravel-news.com</link>
      <description>Your official Laravel news source.</description>
      <lastBuildDate>Fri, 21 Apr 2023 13:00:00 +0000</lastBuildDate>
      <language>en-US</language>
      <sy:updatePeriod>hourly</sy:updatePeriod>
      <sy:updateFrequency>1</sy:updateFrequency>
      <generator>https://laravel-news.com</generator>
      <item>
         <title>Generate String Acronyms with this Laravel Macro</title>
         <link>https://laravel-news.com/laravel-str-acronym</link>
         <pubDate>Fri, 21 Apr 2023 05:09:03 +0000</pubDate>
         <dc:creator><![CDATA[Laravel News]]></dc:creator>
         <category><![CDATA[packages]]></category>
         <guid isPermaLink="false">https://laravel-news.com/laravel-str-acronym</guid>
         <description><![CDATA[<p><a href="https://laravel-news.com/laravel-str-acronym"><img src="https://laravelnews.s3.amazonaws.com/images/laravel-str-acronym-featured.png"></a></p>
                                The Str Acronym package for Laravel provides a macro for generating acronyms from strings using the Str helper and supports the Stringable class.
                <p>The post <a href="https://laravel-news.com/laravel-str-acronym">Generate String Acronyms with this Laravel Macro</a> appeared first on <a href="https://laravel-news.com">Laravel News</a>.</p>
                <p>Join the <a href="https://laravel-news.com/newsletter">Laravel Newsletter</a> to get <a href="https://laravel-news.com">Laravel</a> articles like this directly in your inbox.</p>
                <hr>]]></description>
         <content:encoded><![CDATA[<p><a href="https://laravel-news.com/laravel-str-acronym"><img src="https://laravelnews.s3.amazonaws.com/images/laravel-str-acronym-featured.png"></a></p>
                                The Str Acronym package for Laravel provides a macro for generating acronyms from strings using the Str helper and supports the Stringable class.
                <p>The post <a href="https://laravel-news.com/laravel-str-acronym">Generate String Acronyms with this Laravel Macro</a> appeared first on <a href="https://laravel-news.com">Laravel News</a>.</p>
                <hr>
                <p>Join the <a href="https://laravel-news.com/newsletter">Laravel Newsletter</a> to get <a href="https://laravel-news.com">Laravel</a> articles like this directly in your inbox.</p>]]></content:encoded>
      </item>
      <item>
         <title>Laravel Telescope Guzzle Watcher</title>
         <link>https://laravel-news.com/laravel-telescope-guzzle-watcher</link>
         <pubDate>Thu, 20 Apr 2023 04:54:21 +0000</pubDate>
         <dc:creator><![CDATA[Laravel News]]></dc:creator>
         <category><![CDATA[packages]]></category>
         <guid isPermaLink="false">https://laravel-news.com/laravel-telescope-guzzle-watcher</guid>
         <description><![CDATA[<p><a href="https://laravel-news.com/laravel-telescope-guzzle-watcher"><img src="https://laravelnews.s3.amazonaws.com/images/laravel-telescope-guzzle-watcher-featured.png"></a></p>
                                The Laravel Telescope Guzzle Watcher is a Telescope plugin that provides Guzzle request and response logs within the Telescope UI.
                <p>The post <a href="https://laravel-news.com/laravel-telescope-guzzle-watcher">Laravel Telescope Guzzle Watcher</a> appeared first on <a href="https://laravel-news.com">Laravel News</a>.</p>
                <p>Join the <a href="https://laravel-news.com/newsletter">Laravel Newsletter</a> to get <a href="https://laravel-news.com">Laravel</a> articles like this directly in your inbox.</p>
                <hr>]]></description>
         <content:encoded><![CDATA[<p><a href="https://laravel-news.com/laravel-telescope-guzzle-watcher"><img src="https://laravelnews.s3.amazonaws.com/images/laravel-telescope-guzzle-watcher-featured.png"></a></p>
                                The Laravel Telescope Guzzle Watcher is a Telescope plugin that provides Guzzle request and response logs within the Telescope UI.
                <p>The post <a href="https://laravel-news.com/laravel-telescope-guzzle-watcher">Laravel Telescope Guzzle Watcher</a> appeared first on <a href="https://laravel-news.com">Laravel News</a>.</p>
                <hr>
                <p>Join the <a href="https://laravel-news.com/newsletter">Laravel Newsletter</a> to get <a href="https://laravel-news.com">Laravel</a> articles like this directly in your inbox.</p>]]></content:encoded>
      </item>
      <item>
         <title>Laravel 10.8 Released</title>
         <link>https://laravel-news.com/laravel-10-8-0</link>
         <pubDate>Wed, 19 Apr 2023 17:04:06 +0000</pubDate>
         <dc:creator><![CDATA[Laravel News]]></dc:creator>
         <category><![CDATA[news]]></category>
         <guid isPermaLink="false">https://laravel-news.com/laravel-10-8-0</guid>
         <description><![CDATA[<p><a href="https://laravel-news.com/laravel-10-8-0"><img src="https://laravelnews.s3.amazonaws.com/images/laravel-10-featured.png"></a></p>
                                The Laravel team released Laravel 10.8, with method chaining indentation, syntactic sugar for Process::pipe() method, after validation rules, and more.
                <p>The post <a href="https://laravel-news.com/laravel-10-8-0">Laravel 10.8 Released</a> appeared first on <a href="https://laravel-news.com">Laravel News</a>.</p>
                <p>Join the <a href="https://laravel-news.com/newsletter">Laravel Newsletter</a> to get <a href="https://laravel-news.com">Laravel</a> articles like this directly in your inbox.</p>
                <hr>]]></description>
         <content:encoded><![CDATA[<p><a href="https://laravel-news.com/laravel-10-8-0"><img src="https://laravelnews.s3.amazonaws.com/images/laravel-10-featured.png"></a></p>
                                The Laravel team released Laravel 10.8, with method chaining indentation, syntactic sugar for Process::pipe() method, after validation rules, and more.
                <p>The post <a href="https://laravel-news.com/laravel-10-8-0">Laravel 10.8 Released</a> appeared first on <a href="https://laravel-news.com">Laravel News</a>.</p>
                <hr>
                <p>Join the <a href="https://laravel-news.com/newsletter">Laravel Newsletter</a> to get <a href="https://laravel-news.com">Laravel</a> articles like this directly in your inbox.</p>]]></content:encoded>
      </item>
      <item>
         <title>Laravel FFMpeg tools</title>
         <link>https://laravel-news.com/laravel-ffmpeg-tools</link>
         <pubDate>Tue, 18 Apr 2023 15:52:03 +0000</pubDate>
         <dc:creator><![CDATA[Laravel News]]></dc:creator>
         <category><![CDATA[packages]]></category>
         <guid isPermaLink="false">https://laravel-news.com/laravel-ffmpeg-tools</guid>
         <description><![CDATA[<p><a href="https://laravel-news.com/laravel-ffmpeg-tools"><img src="https://laravelnews.s3.amazonaws.com/images/tween-featured-image.jpg"></a></p>
                                This package allows you to build FFMpeg strings in a fluent, easily maintainable way that feels familiar to php and Laravel devs.
                <p>The post <a href="https://laravel-news.com/laravel-ffmpeg-tools">Laravel FFMpeg tools</a> appeared first on <a href="https://laravel-news.com">Laravel News</a>.</p>
                <p>Join the <a href="https://laravel-news.com/newsletter">Laravel Newsletter</a> to get <a href="https://laravel-news.com">Laravel</a> articles like this directly in your inbox.</p>
                <hr>]]></description>
         <content:encoded><![CDATA[<p><a href="https://laravel-news.com/laravel-ffmpeg-tools"><img src="https://laravelnews.s3.amazonaws.com/images/tween-featured-image.jpg"></a></p>
                                This package allows you to build FFMpeg strings in a fluent, easily maintainable way that feels familiar to php and Laravel devs.
                <p>The post <a href="https://laravel-news.com/laravel-ffmpeg-tools">Laravel FFMpeg tools</a> appeared first on <a href="https://laravel-news.com">Laravel News</a>.</p>
                <hr>
                <p>Join the <a href="https://laravel-news.com/newsletter">Laravel Newsletter</a> to get <a href="https://laravel-news.com">Laravel</a> articles like this directly in your inbox.</p>]]></content:encoded>
      </item>
      <item>
         <title>Laravel Validate Package With Over 35 Pre-built Rules</title>
         <link>https://laravel-news.com/laravel-validation-with-35-pre-built-rules</link>
         <pubDate>Tue, 18 Apr 2023 04:23:07 +0000</pubDate>
         <dc:creator><![CDATA[Laravel News]]></dc:creator>
         <category><![CDATA[packages]]></category>
         <guid isPermaLink="false">https://laravel-news.com/laravel-validation-with-35-pre-built-rules</guid>
         <description><![CDATA[<p><a href="https://laravel-news.com/laravel-validation-with-35-pre-built-rules"><img src="https://laravelnews.s3.amazonaws.com/images/laravel-validation-mildwad-featured.png"></a></p>
                                The Laravel Validate package by Milwad simplifies Laravel validation with over 35 pre-built rule objects.
                <p>The post <a href="https://laravel-news.com/laravel-validation-with-35-pre-built-rules">Laravel Validate Package With Over 35 Pre-built Rules</a> appeared first on <a href="https://laravel-news.com">Laravel News</a>.</p>
                <p>Join the <a href="https://laravel-news.com/newsletter">Laravel Newsletter</a> to get <a href="https://laravel-news.com">Laravel</a> articles like this directly in your inbox.</p>
                <hr>]]></description>
         <content:encoded><![CDATA[<p><a href="https://laravel-news.com/laravel-validation-with-35-pre-built-rules"><img src="https://laravelnews.s3.amazonaws.com/images/laravel-validation-mildwad-featured.png"></a></p>
                                The Laravel Validate package by Milwad simplifies Laravel validation with over 35 pre-built rule objects.
                <p>The post <a href="https://laravel-news.com/laravel-validation-with-35-pre-built-rules">Laravel Validate Package With Over 35 Pre-built Rules</a> appeared first on <a href="https://laravel-news.com">Laravel News</a>.</p>
                <hr>
                <p>Join the <a href="https://laravel-news.com/newsletter">Laravel Newsletter</a> to get <a href="https://laravel-news.com">Laravel</a> articles like this directly in your inbox.</p>]]></content:encoded>
      </item>
      <item>
         <title>Create Beautiful Admin Panels in Laravel</title>
         <link>https://laravel-news.com/craftable-pro</link>
         <pubDate>Sun, 16 Apr 2023 00:44:17 +0000</pubDate>
         <dc:creator><![CDATA[Laravel News]]></dc:creator>
         <category><![CDATA[sponsor]]></category>
         <guid isPermaLink="false">https://laravel-news.com/craftable-pro</guid>
         <description><![CDATA[<p><a href="https://laravel-news.com/craftable-pro"><img src="https://laravelnews.s3.amazonaws.com/images/size=2200x1100,-variant=gallery,-background=default.png"></a></p>
                                Craftable PRO is a powerful admin panel and CRUD generator that utilizes the VILT stack (VueJs, InertiaJs, Laravel, and TailwindCSS). With Craftable PRO, you can quickly scaffold administration for your Laravel project and harness its out-of-the-box features such as user administration, permissions management, media library, and much more.
                <p>The post <a href="https://laravel-news.com/craftable-pro">Create Beautiful Admin Panels in Laravel</a> appeared first on <a href="https://laravel-news.com">Laravel News</a>.</p>
                <p>Join the <a href="https://laravel-news.com/newsletter">Laravel Newsletter</a> to get <a href="https://laravel-news.com">Laravel</a> articles like this directly in your inbox.</p>
                <hr>]]></description>
         <content:encoded><![CDATA[<p><a href="https://laravel-news.com/craftable-pro"><img src="https://laravelnews.s3.amazonaws.com/images/size=2200x1100,-variant=gallery,-background=default.png"></a></p>
                                Craftable PRO is a powerful admin panel and CRUD generator that utilizes the VILT stack (VueJs, InertiaJs, Laravel, and TailwindCSS). With Craftable PRO, you can quickly scaffold administration for your Laravel project and harness its out-of-the-box features such as user administration, permissions management, media library, and much more.
                <p>The post <a href="https://laravel-news.com/craftable-pro">Create Beautiful Admin Panels in Laravel</a> appeared first on <a href="https://laravel-news.com">Laravel News</a>.</p>
                <hr>
                <p>Join the <a href="https://laravel-news.com/newsletter">Laravel Newsletter</a> to get <a href="https://laravel-news.com">Laravel</a> articles like this directly in your inbox.</p>]]></content:encoded>
      </item>
      <item>
         <title>Laracon AU is returning in 2023!</title>
         <link>https://laravel-news.com/laracon-au-is-returning-in-2023</link>
         <pubDate>Mon, 17 Apr 2023 00:41:27 +0000</pubDate>
         <dc:creator><![CDATA[Laravel News]]></dc:creator>
         <category><![CDATA[laracon]]></category>
         <guid isPermaLink="false">https://laravel-news.com/laracon-au-is-returning-in-2023</guid>
         <description><![CDATA[<p><a href="https://laravel-news.com/laracon-au-is-returning-in-2023"><img src="https://laravelnews.s3.amazonaws.com/images/og-image.jpg"></a></p>
                                After four long years, Laracon is returning to Australia in 2023.
                <p>The post <a href="https://laravel-news.com/laracon-au-is-returning-in-2023">Laracon AU is returning in 2023!</a> appeared first on <a href="https://laravel-news.com">Laravel News</a>.</p>
                <p>Join the <a href="https://laravel-news.com/newsletter">Laravel Newsletter</a> to get <a href="https://laravel-news.com">Laravel</a> articles like this directly in your inbox.</p>
                <hr>]]></description>
         <content:encoded><![CDATA[<p><a href="https://laravel-news.com/laracon-au-is-returning-in-2023"><img src="https://laravelnews.s3.amazonaws.com/images/og-image.jpg"></a></p>
                                After four long years, Laracon is returning to Australia in 2023.
                <p>The post <a href="https://laravel-news.com/laracon-au-is-returning-in-2023">Laracon AU is returning in 2023!</a> appeared first on <a href="https://laravel-news.com">Laravel News</a>.</p>
                <hr>
                <p>Join the <a href="https://laravel-news.com/newsletter">Laravel Newsletter</a> to get <a href="https://laravel-news.com">Laravel</a> articles like this directly in your inbox.</p>]]></content:encoded>
      </item>
      <item>
         <title>Supercharge your Laravel Forge account with Bellows</title>
         <link>https://laravel-news.com/supercharge-your-laravel-forge-account-with-bellows</link>
         <pubDate>Tue, 11 Apr 2023 13:45:33 +0000</pubDate>
         <dc:creator><![CDATA[Laravel News]]></dc:creator>
         <category><![CDATA[sponsor]]></category>
         <guid isPermaLink="false">https://laravel-news.com/supercharge-your-laravel-forge-account-with-bellows</guid>
         <description><![CDATA[<p><a href="https://laravel-news.com/supercharge-your-laravel-forge-account-with-bellows"><img src="https://laravelnews.s3.amazonaws.com/images/bellows-featured.jpg"></a></p>
                                Bellows is an intelligent command line utility that sits on top of Laravel Forge to get your site up and running with all of your third-party integrations configured at the speed of light.
                <p>The post <a href="https://laravel-news.com/supercharge-your-laravel-forge-account-with-bellows">Supercharge your Laravel Forge account with Bellows</a> appeared first on <a href="https://laravel-news.com">Laravel News</a>.</p>
                <p>Join the <a href="https://laravel-news.com/newsletter">Laravel Newsletter</a> to get <a href="https://laravel-news.com">Laravel</a> articles like this directly in your inbox.</p>
                <hr>]]></description>
         <content:encoded><![CDATA[<p><a href="https://laravel-news.com/supercharge-your-laravel-forge-account-with-bellows"><img src="https://laravelnews.s3.amazonaws.com/images/bellows-featured.jpg"></a></p>
                                Bellows is an intelligent command line utility that sits on top of Laravel Forge to get your site up and running with all of your third-party integrations configured at the speed of light.
                <p>The post <a href="https://laravel-news.com/supercharge-your-laravel-forge-account-with-bellows">Supercharge your Laravel Forge account with Bellows</a> appeared first on <a href="https://laravel-news.com">Laravel News</a>.</p>
                <hr>
                <p>Join the <a href="https://laravel-news.com/newsletter">Laravel Newsletter</a> to get <a href="https://laravel-news.com">Laravel</a> articles like this directly in your inbox.</p>]]></content:encoded>
      </item>
      <item>
         <title>Lunar Headless E-Commerce for Laravel</title>
         <link>https://laravel-news.com/lunar</link>
         <pubDate>Fri, 14 Apr 2023 11:38:34 +0000</pubDate>
         <dc:creator><![CDATA[Laravel News]]></dc:creator>
         <category><![CDATA[packages]]></category>
         <guid isPermaLink="false">https://laravel-news.com/lunar</guid>
         <description><![CDATA[<p><a href="https://laravel-news.com/lunar"><img src="https://laravelnews.s3.amazonaws.com/images/lunar-ecommerce-featured.png"></a></p>
                                Lunar is an open-source package that brings the power of modern headless e-commerce functionality to Laravel.
                <p>The post <a href="https://laravel-news.com/lunar">Lunar Headless E-Commerce for Laravel</a> appeared first on <a href="https://laravel-news.com">Laravel News</a>.</p>
                <p>Join the <a href="https://laravel-news.com/newsletter">Laravel Newsletter</a> to get <a href="https://laravel-news.com">Laravel</a> articles like this directly in your inbox.</p>
                <hr>]]></description>
         <content:encoded><![CDATA[<p><a href="https://laravel-news.com/lunar"><img src="https://laravelnews.s3.amazonaws.com/images/lunar-ecommerce-featured.png"></a></p>
                                Lunar is an open-source package that brings the power of modern headless e-commerce functionality to Laravel.
                <p>The post <a href="https://laravel-news.com/lunar">Lunar Headless E-Commerce for Laravel</a> appeared first on <a href="https://laravel-news.com">Laravel News</a>.</p>
                <hr>
                <p>Join the <a href="https://laravel-news.com/newsletter">Laravel Newsletter</a> to get <a href="https://laravel-news.com">Laravel</a> articles like this directly in your inbox.</p>]]></content:encoded>
      </item>
      <item>
         <title>Convert HEIC Images to JPEG in PHP</title>
         <link>https://laravel-news.com/php-heic-to-jpg</link>
         <pubDate>Thu, 13 Apr 2023 04:32:14 +0000</pubDate>
         <dc:creator><![CDATA[Laravel News]]></dc:creator>
         <category><![CDATA[packages]]></category>
         <guid isPermaLink="false">https://laravel-news.com/php-heic-to-jpg</guid>
         <description><![CDATA[<p><a href="https://laravel-news.com/php-heic-to-jpg"><img src="https://laravelnews.s3.amazonaws.com/images/php-heic-to-jpg-featured.png"></a></p>
                                The php-heic-to-jpg PHP package is the easiest way to convert HEIC (High-Efficiency Image Container) images to JPEG with PHP and Laravel framework.
                <p>The post <a href="https://laravel-news.com/php-heic-to-jpg">Convert HEIC Images to JPEG in PHP</a> appeared first on <a href="https://laravel-news.com">Laravel News</a>.</p>
                <p>Join the <a href="https://laravel-news.com/newsletter">Laravel Newsletter</a> to get <a href="https://laravel-news.com">Laravel</a> articles like this directly in your inbox.</p>
                <hr>]]></description>
         <content:encoded><![CDATA[<p><a href="https://laravel-news.com/php-heic-to-jpg"><img src="https://laravelnews.s3.amazonaws.com/images/php-heic-to-jpg-featured.png"></a></p>
                                The php-heic-to-jpg PHP package is the easiest way to convert HEIC (High-Efficiency Image Container) images to JPEG with PHP and Laravel framework.
                <p>The post <a href="https://laravel-news.com/php-heic-to-jpg">Convert HEIC Images to JPEG in PHP</a> appeared first on <a href="https://laravel-news.com">Laravel News</a>.</p>
                <hr>
                <p>Join the <a href="https://laravel-news.com/newsletter">Laravel Newsletter</a> to get <a href="https://laravel-news.com">Laravel</a> articles like this directly in your inbox.</p>]]></content:encoded>
      </item>
      <item>
         <title>Laravel 10.7 Released</title>
         <link>https://laravel-news.com/laravel-10-7-0</link>
         <pubDate>Wed, 12 Apr 2023 05:00:08 +0000</pubDate>
         <dc:creator><![CDATA[Laravel News]]></dc:creator>
         <category><![CDATA[news]]></category>
         <guid isPermaLink="false">https://laravel-news.com/laravel-10-7-0</guid>
         <description><![CDATA[<p><a href="https://laravel-news.com/laravel-10-7-0"><img src="https://laravelnews.s3.amazonaws.com/images/laravel-10-featured.png"></a></p>
                                Laravel 10.7 added pipe() to run commands in sequence, setValue() to Validator, and the ability to assert invokable event listeners in tests.
                <p>The post <a href="https://laravel-news.com/laravel-10-7-0">Laravel 10.7 Released</a> appeared first on <a href="https://laravel-news.com">Laravel News</a>.</p>
                <p>Join the <a href="https://laravel-news.com/newsletter">Laravel Newsletter</a> to get <a href="https://laravel-news.com">Laravel</a> articles like this directly in your inbox.</p>
                <hr>]]></description>
         <content:encoded><![CDATA[<p><a href="https://laravel-news.com/laravel-10-7-0"><img src="https://laravelnews.s3.amazonaws.com/images/laravel-10-featured.png"></a></p>
                                Laravel 10.7 added pipe() to run commands in sequence, setValue() to Validator, and the ability to assert invokable event listeners in tests.
                <p>The post <a href="https://laravel-news.com/laravel-10-7-0">Laravel 10.7 Released</a> appeared first on <a href="https://laravel-news.com">Laravel News</a>.</p>
                <hr>
                <p>Join the <a href="https://laravel-news.com/newsletter">Laravel Newsletter</a> to get <a href="https://laravel-news.com">Laravel</a> articles like this directly in your inbox.</p>]]></content:encoded>
      </item>
      <item>
         <title>Useful Laravel Date Scopes for Eloquent Models</title>
         <link>https://laravel-news.com/laravel-date-scopes-for-eloquent</link>
         <pubDate>Tue, 11 Apr 2023 00:37:23 +0000</pubDate>
         <dc:creator><![CDATA[Laravel News]]></dc:creator>
         <category><![CDATA[packages]]></category>
         <guid isPermaLink="false">https://laravel-news.com/laravel-date-scopes-for-eloquent</guid>
         <description><![CDATA[<p><a href="https://laravel-news.com/laravel-date-scopes-for-eloquent"><img src="https://laravelnews.s3.amazonaws.com/images/laravel-date-scopes.png"></a></p>
                                The Laravel Date Scopes package provides some helpful query scopes for your Laravel Eloquent models.
                <p>The post <a href="https://laravel-news.com/laravel-date-scopes-for-eloquent">Useful Laravel Date Scopes for Eloquent Models</a> appeared first on <a href="https://laravel-news.com">Laravel News</a>.</p>
                <p>Join the <a href="https://laravel-news.com/newsletter">Laravel Newsletter</a> to get <a href="https://laravel-news.com">Laravel</a> articles like this directly in your inbox.</p>
                <hr>]]></description>
         <content:encoded><![CDATA[<p><a href="https://laravel-news.com/laravel-date-scopes-for-eloquent"><img src="https://laravelnews.s3.amazonaws.com/images/laravel-date-scopes.png"></a></p>
                                The Laravel Date Scopes package provides some helpful query scopes for your Laravel Eloquent models.
                <p>The post <a href="https://laravel-news.com/laravel-date-scopes-for-eloquent">Useful Laravel Date Scopes for Eloquent Models</a> appeared first on <a href="https://laravel-news.com">Laravel News</a>.</p>
                <hr>
                <p>Join the <a href="https://laravel-news.com/newsletter">Laravel Newsletter</a> to get <a href="https://laravel-news.com">Laravel</a> articles like this directly in your inbox.</p>]]></content:encoded>
      </item>
      <item>
         <title>The Best Practices Guide to OpenTelemetry for Developers</title>
         <link>https://laravel-news.com/the-best-practices-guide-to-opentelemetry-for-developers</link>
         <pubDate>Mon, 10 Apr 2023 00:40:06 +0000</pubDate>
         <dc:creator><![CDATA[Laravel News]]></dc:creator>
         <category><![CDATA[sponsor]]></category>
         <guid isPermaLink="false">https://laravel-news.com/the-best-practices-guide-to-opentelemetry-for-developers</guid>
         <description><![CDATA[<p><a href="https://laravel-news.com/the-best-practices-guide-to-opentelemetry-for-developers"><img src="https://laravelnews.s3.amazonaws.com/images/blog-image---sponsored-(3).png"></a></p>
                                OpenTelemetry is a free and open-source software initiative with the objective of supplying software developers with the means to create distributed systems.
                <p>The post <a href="https://laravel-news.com/the-best-practices-guide-to-opentelemetry-for-developers">The Best Practices Guide to OpenTelemetry for Developers</a> appeared first on <a href="https://laravel-news.com">Laravel News</a>.</p>
                <p>Join the <a href="https://laravel-news.com/newsletter">Laravel Newsletter</a> to get <a href="https://laravel-news.com">Laravel</a> articles like this directly in your inbox.</p>
                <hr>]]></description>
         <content:encoded><![CDATA[<p><a href="https://laravel-news.com/the-best-practices-guide-to-opentelemetry-for-developers"><img src="https://laravelnews.s3.amazonaws.com/images/blog-image---sponsored-(3).png"></a></p>
                                OpenTelemetry is a free and open-source software initiative with the objective of supplying software developers with the means to create distributed systems.
                <p>The post <a href="https://laravel-news.com/the-best-practices-guide-to-opentelemetry-for-developers">The Best Practices Guide to OpenTelemetry for Developers</a> appeared first on <a href="https://laravel-news.com">Laravel News</a>.</p>
                <hr>
                <p>Join the <a href="https://laravel-news.com/newsletter">Laravel Newsletter</a> to get <a href="https://laravel-news.com">Laravel</a> articles like this directly in your inbox.</p>]]></content:encoded>
      </item>
      <item>
         <title>Let\'s talk about Form Requests</title>
         <link>https://laravel-news.com/form-requests</link>
         <pubDate>Fri, 07 Apr 2023 12:30:13 +0000</pubDate>
         <dc:creator><![CDATA[Laravel News]]></dc:creator>
         <category><![CDATA[tutorials]]></category>
         <guid isPermaLink="false">https://laravel-news.com/form-requests</guid>
         <description><![CDATA[<p><a href="https://laravel-news.com/form-requests"><img src="https://laravelnews.s3.amazonaws.com/images/lets-talk-about-form-requests.png"></a></p>
                                Form Requests are best known for validation logic that will pre-validate for you. They are fantastic, and I lean on them heavily all the time.
                <p>The post <a href="https://laravel-news.com/form-requests">Let&#039;s talk about Form Requests</a> appeared first on <a href="https://laravel-news.com">Laravel News</a>.</p>
                <p>Join the <a href="https://laravel-news.com/newsletter">Laravel Newsletter</a> to get <a href="https://laravel-news.com">Laravel</a> articles like this directly in your inbox.</p>
                <hr>]]></description>
         <content:encoded><![CDATA[<p><a href="https://laravel-news.com/form-requests"><img src="https://laravelnews.s3.amazonaws.com/images/lets-talk-about-form-requests.png"></a></p>
                                Form Requests are best known for validation logic that will pre-validate for you. They are fantastic, and I lean on them heavily all the time.
                <p>The post <a href="https://laravel-news.com/form-requests">Let&#039;s talk about Form Requests</a> appeared first on <a href="https://laravel-news.com">Laravel News</a>.</p>
                <hr>
                <p>Join the <a href="https://laravel-news.com/newsletter">Laravel Newsletter</a> to get <a href="https://laravel-news.com">Laravel</a> articles like this directly in your inbox.</p>]]></content:encoded>
      </item>
      <item>
         <title>Laravel Expectations Plugin for Pest</title>
         <link>https://laravel-news.com/pest-laravel-expectations</link>
         <pubDate>Thu, 06 Apr 2023 06:04:46 +0000</pubDate>
         <dc:creator><![CDATA[Laravel News]]></dc:creator>
         <category><![CDATA[packages]]></category>
         <guid isPermaLink="false">https://laravel-news.com/pest-laravel-expectations</guid>
         <description><![CDATA[<p><a href="https://laravel-news.com/pest-laravel-expectations"><img src="https://laravelnews.s3.amazonaws.com/images/pest-laravel-expectations.png"></a></p>
                                Pest Laravel Expectations is a Pest plugin that adds Laravel-specific expectations to the testing ecosystem.
                <p>The post <a href="https://laravel-news.com/pest-laravel-expectations">Laravel Expectations Plugin for Pest</a> appeared first on <a href="https://laravel-news.com">Laravel News</a>.</p>
                <p>Join the <a href="https://laravel-news.com/newsletter">Laravel Newsletter</a> to get <a href="https://laravel-news.com">Laravel</a> articles like this directly in your inbox.</p>
                <hr>]]></description>
         <content:encoded><![CDATA[<p><a href="https://laravel-news.com/pest-laravel-expectations"><img src="https://laravelnews.s3.amazonaws.com/images/pest-laravel-expectations.png"></a></p>
                                Pest Laravel Expectations is a Pest plugin that adds Laravel-specific expectations to the testing ecosystem.
                <p>The post <a href="https://laravel-news.com/pest-laravel-expectations">Laravel Expectations Plugin for Pest</a> appeared first on <a href="https://laravel-news.com">Laravel News</a>.</p>
                <hr>
                <p>Join the <a href="https://laravel-news.com/newsletter">Laravel Newsletter</a> to get <a href="https://laravel-news.com">Laravel</a> articles like this directly in your inbox.</p>]]></content:encoded>
      </item>
      <item>
         <title>PlanetScale Database Migrations for Laravel</title>
         <link>https://laravel-news.com/planetscale-database-migrations-for-laravel</link>
         <pubDate>Wed, 05 Apr 2023 04:23:24 +0000</pubDate>
         <dc:creator><![CDATA[Laravel News]]></dc:creator>
         <category><![CDATA[packages]]></category>
         <guid isPermaLink="false">https://laravel-news.com/planetscale-database-migrations-for-laravel</guid>
         <description><![CDATA[<p><a href="https://laravel-news.com/planetscale-database-migrations-for-laravel"><img src="https://laravelnews.s3.amazonaws.com/images/laravel-database-copy-featured.png"></a></p>
                                PlanetScale for Laravel is a package that helps you manage database migrations with Artisan and the PlanetScale API.
                <p>The post <a href="https://laravel-news.com/planetscale-database-migrations-for-laravel">PlanetScale Database Migrations for Laravel</a> appeared first on <a href="https://laravel-news.com">Laravel News</a>.</p>
                <p>Join the <a href="https://laravel-news.com/newsletter">Laravel Newsletter</a> to get <a href="https://laravel-news.com">Laravel</a> articles like this directly in your inbox.</p>
                <hr>]]></description>
         <content:encoded><![CDATA[<p><a href="https://laravel-news.com/planetscale-database-migrations-for-laravel"><img src="https://laravelnews.s3.amazonaws.com/images/laravel-database-copy-featured.png"></a></p>
                                PlanetScale for Laravel is a package that helps you manage database migrations with Artisan and the PlanetScale API.
                <p>The post <a href="https://laravel-news.com/planetscale-database-migrations-for-laravel">PlanetScale Database Migrations for Laravel</a> appeared first on <a href="https://laravel-news.com">Laravel News</a>.</p>
                <hr>
                <p>Join the <a href="https://laravel-news.com/newsletter">Laravel Newsletter</a> to get <a href="https://laravel-news.com">Laravel</a> articles like this directly in your inbox.</p>]]></content:encoded>
      </item>
      <item>
         <title>Validated DTO Package for Laravel</title>
         <link>https://laravel-news.com/validated-dto-package-for-laravel</link>
         <pubDate>Tue, 04 Apr 2023 13:59:49 +0000</pubDate>
         <dc:creator><![CDATA[Laravel News]]></dc:creator>
         <category><![CDATA[packages]]></category>
         <guid isPermaLink="false">https://laravel-news.com/validated-dto-package-for-laravel</guid>
         <description><![CDATA[<p><a href="https://laravel-news.com/validated-dto-package-for-laravel"><img src="https://laravelnews.s3.amazonaws.com/images/validated-featured.png"></a></p>
                                The Validated DTO package for Laravel provides Data Transfer Objects with validation and type-casting.
                <p>The post <a href="https://laravel-news.com/validated-dto-package-for-laravel">Validated DTO Package for Laravel</a> appeared first on <a href="https://laravel-news.com">Laravel News</a>.</p>
                <p>Join the <a href="https://laravel-news.com/newsletter">Laravel Newsletter</a> to get <a href="https://laravel-news.com">Laravel</a> articles like this directly in your inbox.</p>
                <hr>]]></description>
         <content:encoded><![CDATA[<p><a href="https://laravel-news.com/validated-dto-package-for-laravel"><img src="https://laravelnews.s3.amazonaws.com/images/validated-featured.png"></a></p>
                                The Validated DTO package for Laravel provides Data Transfer Objects with validation and type-casting.
                <p>The post <a href="https://laravel-news.com/validated-dto-package-for-laravel">Validated DTO Package for Laravel</a> appeared first on <a href="https://laravel-news.com">Laravel News</a>.</p>
                <hr>
                <p>Join the <a href="https://laravel-news.com/newsletter">Laravel Newsletter</a> to get <a href="https://laravel-news.com">Laravel</a> articles like this directly in your inbox.</p>]]></content:encoded>
      </item>
      <item>
         <title>Everything You Can Test in Your Laravel Application</title>
         <link>https://laravel-news.com/everything-you-can-test-in-your-laravel-application</link>
         <pubDate>Mon, 03 Apr 2023 03:25:24 +0000</pubDate>
         <dc:creator><![CDATA[Laravel News]]></dc:creator>
         <category />
         <guid isPermaLink="false">https://laravel-news.com/everything-you-can-test-in-your-laravel-application</guid>
         <description><![CDATA[<p><a href="https://laravel-news.com/everything-you-can-test-in-your-laravel-application"><img src="https://laravelnews.s3.amazonaws.com/images/everything-you-can-test-in-laravel-app.png"></a></p>
                                Christoph Rumpel has an excellent guide, Everything You Can Test in Your Laravel Application, of scenarios you\'ll likely need to test on real applications.
                <p>The post <a href="https://laravel-news.com/everything-you-can-test-in-your-laravel-application">Everything You Can Test in Your Laravel Application</a> appeared first on <a href="https://laravel-news.com">Laravel News</a>.</p>
                <p>Join the <a href="https://laravel-news.com/newsletter">Laravel Newsletter</a> to get <a href="https://laravel-news.com">Laravel</a> articles like this directly in your inbox.</p>
                <hr>]]></description>
         <content:encoded><![CDATA[<p><a href="https://laravel-news.com/everything-you-can-test-in-your-laravel-application"><img src="https://laravelnews.s3.amazonaws.com/images/everything-you-can-test-in-laravel-app.png"></a></p>
                                Christoph Rumpel has an excellent guide, Everything You Can Test in Your Laravel Application, of scenarios you\'ll likely need to test on real applications.
                <p>The post <a href="https://laravel-news.com/everything-you-can-test-in-your-laravel-application">Everything You Can Test in Your Laravel Application</a> appeared first on <a href="https://laravel-news.com">Laravel News</a>.</p>
                <hr>
                <p>Join the <a href="https://laravel-news.com/newsletter">Laravel Newsletter</a> to get <a href="https://laravel-news.com">Laravel</a> articles like this directly in your inbox.</p>]]></content:encoded>
      </item>
      <item>
         <title>Laravel 10.5 Released</title>
         <link>https://laravel-news.com/laravel-10-5-0</link>
         <pubDate>Fri, 31 Mar 2023 02:37:46 +0000</pubDate>
         <dc:creator><![CDATA[Laravel News]]></dc:creator>
         <category><![CDATA[news]]></category>
         <guid isPermaLink="false">https://laravel-news.com/laravel-10-5-0</guid>
         <description><![CDATA[<p><a href="https://laravel-news.com/laravel-10-5-0"><img src="https://laravelnews.s3.amazonaws.com/images/laravel-10-featured.png"></a></p>
                                Laravel 10.5 introduces a case-sensitive flag for string replacement, empty columns support for insertUsing, a selectResultsets method, and more.
                <p>The post <a href="https://laravel-news.com/laravel-10-5-0">Laravel 10.5 Released</a> appeared first on <a href="https://laravel-news.com">Laravel News</a>.</p>
                <p>Join the <a href="https://laravel-news.com/newsletter">Laravel Newsletter</a> to get <a href="https://laravel-news.com">Laravel</a> articles like this directly in your inbox.</p>
                <hr>]]></description>
         <content:encoded><![CDATA[<p><a href="https://laravel-news.com/laravel-10-5-0"><img src="https://laravelnews.s3.amazonaws.com/images/laravel-10-featured.png"></a></p>
                                Laravel 10.5 introduces a case-sensitive flag for string replacement, empty columns support for insertUsing, a selectResultsets method, and more.
                <p>The post <a href="https://laravel-news.com/laravel-10-5-0">Laravel 10.5 Released</a> appeared first on <a href="https://laravel-news.com">Laravel News</a>.</p>
                <hr>
                <p>Join the <a href="https://laravel-news.com/newsletter">Laravel Newsletter</a> to get <a href="https://laravel-news.com">Laravel</a> articles like this directly in your inbox.</p>]]></content:encoded>
      </item>
      <item>
         <title>Replace Raw Query Calls With Laravel Query Expressions</title>
         <link>https://laravel-news.com/query-expressions-for-laravel</link>
         <pubDate>Thu, 30 Mar 2023 06:02:22 +0000</pubDate>
         <dc:creator><![CDATA[Laravel News]]></dc:creator>
         <category><![CDATA[packages]]></category>
         <guid isPermaLink="false">https://laravel-news.com/query-expressions-for-laravel</guid>
         <description><![CDATA[<p><a href="https://laravel-news.com/query-expressions-for-laravel"><img src="https://laravelnews.s3.amazonaws.com/images/laravel-query-expressions-featured.png"></a></p>
                                The Query Expressions package for Laravel replaces raw query calls with expressions. Learn how this package can help you avoid writing database-specific queries.
                <p>The post <a href="https://laravel-news.com/query-expressions-for-laravel">Replace Raw Query Calls With Laravel Query Expressions</a> appeared first on <a href="https://laravel-news.com">Laravel News</a>.</p>
                <p>Join the <a href="https://laravel-news.com/newsletter">Laravel Newsletter</a> to get <a href="https://laravel-news.com">Laravel</a> articles like this directly in your inbox.</p>
                <hr>]]></description>
         <content:encoded><![CDATA[<p><a href="https://laravel-news.com/query-expressions-for-laravel"><img src="https://laravelnews.s3.amazonaws.com/images/laravel-query-expressions-featured.png"></a></p>
                                The Query Expressions package for Laravel replaces raw query calls with expressions. Learn how this package can help you avoid writing database-specific queries.
                <p>The post <a href="https://laravel-news.com/query-expressions-for-laravel">Replace Raw Query Calls With Laravel Query Expressions</a> appeared first on <a href="https://laravel-news.com">Laravel News</a>.</p>
                <hr>
                <p>Join the <a href="https://laravel-news.com/newsletter">Laravel Newsletter</a> to get <a href="https://laravel-news.com">Laravel</a> articles like this directly in your inbox.</p>]]></content:encoded>
      </item>
   </channel>
</rss>';
    }
}

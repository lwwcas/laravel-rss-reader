<?php

namespace Lwwcas\LaravelRssReader\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;
use Lwwcas\LaravelRssReader\Casts\Json;
use Lwwcas\LaravelRssReader\Concerns\ConfigFeed;
use Lwwcas\LaravelRssReader\Concerns\HasDatesFeed;

class RssFeedArticle extends Model
{
    use HasFactory;
    use ConfigFeed;
    use HasDatesFeed;

    public $readingLimit = 20;

    public $defaultArticlesDateFormat = null;

    public $enableCacheRssFeedId = true;

    public $feedKey = null;

    public $onBlackList = true;

    public $activeArticle = true;

    public $feedQuery = null;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'lw_feed_articles';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'uuid',
        'url',
        'title',
        'slug',
        'description',
        'image',
        'language',
        'data',
        'active',
        'black_list',
        'date',
        'custom',
    ];

    /**
     * The model's default values for attributes.
     *
     * @var array
     */
    protected $attributes = [
        'active' => true,
        'black_list' => false,
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'data' => Json::class,
        'custom' => Json::class,
        'visible' => 'boolean',
        'black_list' => 'boolean',
    ];

    public function __construct()
    {
        $_readingLimit = $this->config('article-reading-limit');
        $_defaultArticlesDateFormat = $this->config('default-articles-date-format');
        $_enableCacheRssFeedId = $this->config('enable-caching-in-rss-feed-id');

        $this->readingLimit = $_readingLimit;
        $this->defaultArticlesDateFormat = $_defaultArticlesDateFormat;
        $this->enableCacheRssFeedId = $_enableCacheRssFeedId;
        $this->feedQuery = $this;
    }

    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $model->uuid = (string) Str::uuid();
            $model->slug = (string) Str::of($model->title)->slug('-');
        });
    }

    /**
     * Get the RSS Feed that owns the log.
     */
    public function feed()
    {
        return $this->belongsTo(RssFeed::class, 'feed_id');
    }

    public function read(string $feedKey)
    {
        $rssFeedId = $this->getRssFeedId($feedKey);

        $this->feedQuery = $this->with('feed')
            ->where('feed_id', $rssFeedId);

        return $this;
    }

    protected function getRssFeedId(string $feedKey)
    {
        $this->feedKey = $feedKey;
        $enableCacheRssFeedId = $this->enableCacheRssFeedId;
        $cacheKey = 'lw-rss-feed-' . $feedKey . '-id';

        if (Cache::has($cacheKey) === true && $enableCacheRssFeedId === true) {
            return Cache::get($cacheKey);
        }

        $rssFeed = RssFeed::select('id', 'key')
                ->where('key', $this->feedKey)
                ->first();

        if ($rssFeed === null) {
            throw new \LogicException('The RSS feed key is not valid.');
        }

        $rssFeedId = $rssFeed->id;

        if (Cache::has($cacheKey) === false && $enableCacheRssFeedId === true) {
            Cache::put($cacheKey, $rssFeedId, Carbon::now()->addDays(15));
            return $rssFeedId;
        }

        if (Cache::has($cacheKey) === true) {
            Cache::forget($cacheKey);
        }

        return $rssFeedId;
    }
}

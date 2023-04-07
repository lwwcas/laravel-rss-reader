<?php

namespace Lwwcas\LaravelRssReader\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;
use Lwwcas\LaravelRssReader\Casts\Json;
use Lwwcas\LaravelRssReader\Concerns\HasBlacklist;
use Lwwcas\LaravelRssReader\Concerns\HasConfigFeed;
use Lwwcas\LaravelRssReader\Concerns\HasCustomFilter;
use Lwwcas\LaravelRssReader\Concerns\HasDatesFeed;

class RssFeedArticle extends Model
{
    use HasFactory;
    use HasConfigFeed;
    use HasDatesFeed;
    use HasCustomFilter;
    use HasBlacklist;

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
        'bad_words',
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
        'bad_words' => Json::class,
    ];

    public function __construct()
    {
        $this->readingLimit = $this->config('article-reading-limit');
        $this->defaultArticlesDateFormat = $this->config('default-articles-date-format');
        $this->enableCacheRssFeedId = $this->config('enable-caching-in-rss-feed-id');
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

    public function scopeWhereId($query, string $id)
    {
        return $query->where('id', $id);
    }

    public function scopeWhereUuid($query, string $uuid)
    {
        return $query->where('uuid', $uuid);
    }

    public function scopeWhereUrl($query, string $url)
    {
        return $query->where('url', $url);
    }

    public function scopeWhereTitle($query, string $title)
    {
        return $query->where('title', $title);
    }

    public function scopeWhereSlug($query, string $slug)
    {
        return $query->where('slug', $slug);
    }

    public function hasImage()
    {
        $image = $this->image;

        if ($image === null) {
            return false;
        }

        if ($image === '') {
            return false;
        }

        return true;
    }

    public function hasDescription()
    {
        $description = $this->description;

        if ($description === null) {
            return false;
        }

        if ($description === '') {
            return false;
        }

        return true;
    }

    public function isActive(): bool
    {
        $query = $this->select('active')->first();
        if ($query === null) {
            return false;
        }

        return (bool) $query->active;
    }

    public function isDisable(): bool
    {
        return !$this->isActive();
    }

    public function active()
    {
        return $this->update(['active' => true]);
    }

    public function disable()
    {
        return $this->update(['active' => false]);
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

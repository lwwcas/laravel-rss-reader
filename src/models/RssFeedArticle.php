<?php

namespace Lwwcas\LaravelRssReader\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;
use Lwwcas\LaravelRssReader\Casts\Json;
use Lwwcas\LaravelRssReader\Concerns\ConfigFeed;

class RssFeedArticle extends Model
{
    use HasFactory;
    use ConfigFeed;

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

    public function yesterday()
    {
        $yesterday = Carbon::yesterday()
            ->format($this->defaultArticlesDateFormat);

        $endDay = $this->endOfDay();

        $this->feedQuery = $this->betweenDate($yesterday, $endDay);
        return $this;
    }

    public function lastWeek()
    {
        $lastWeek = $this->lastDays(7);
        $endWeek = $this->endOfDay();

        $this->feedQuery = $this->betweenDate($lastWeek, $endWeek);
        return $this;
    }

    public function lastThreeDays()
    {
        $startDate = $this->lastDays(3);
        $endDate = $this->endOfDay();

        $this->feedQuery = $this->betweenDate($startDate, $endDate);
        return $this;
    }

    public function lastFiveDays()
    {
        $startDate = $this->lastDays(5);
        $endDate = $this->endOfDay();

        $this->feedQuery = $this->betweenDate($startDate, $endDate);
        return $this;
    }

    public function lastTenDays()
    {
        $startDate = $this->lastDays(10);
        $endDate = $this->endOfDay();

        $this->feedQuery = $this->betweenDate($startDate, $endDate);
        return $this;
    }

    public function lastFifteenDays()
    {
        $startDate = $this->lastDays(15);
        $endDate = $this->endOfDay();

        $this->feedQuery = $this->betweenDate($startDate, $endDate);
        return $this;
    }

    public function ofYear(int $year = null)
    {
        if ($year === null) {
            $year = Carbon::now()->format('Y');
        }

        $startYear = Carbon::parse($year . '/01/01')
            ->format($this->defaultArticlesDateFormat);

        $endYear = Carbon::parse($year . '/12/31')
            ->endOfMonth()
            ->format($this->defaultArticlesDateFormat);

        $this->feedQuery = $this->betweenDate($startYear, $endYear);
        return $this;
    }

    public function ofMonth(int $month, int $year = null)
    {
        if ($year === null) {
            $year = Carbon::now()->format('Y');
        }

        $dateSelected = Carbon::parse($year . '/' . $month . '/01');

        $startMonth = $dateSelected->format($this->defaultArticlesDateFormat);

        $endMonth = $dateSelected
            ->endOfMonth()
            ->format($this->defaultArticlesDateFormat);

        $this->feedQuery = $this->betweenDate($startMonth, $endMonth);
        return $this;
    }

    public function currentMonth()
    {
        $startMonth = Carbon::now()
            ->startOfMonth()
            ->format($this->defaultArticlesDateFormat);

        $endMonth = Carbon::now()
            ->endOfMonth()
            ->format($this->defaultArticlesDateFormat);

        $this->feedQuery = $this->betweenDate($startMonth, $endMonth);
        return $this;
    }

    public function lastMonth()
    {
        $startMonth = Carbon::now()
            ->startOfMonth()
            ->subMonth()
            ->format($this->defaultArticlesDateFormat);

        $endMonth = Carbon::now()
            ->subMonth()
            ->endOfMonth()
            ->format($this->defaultArticlesDateFormat);

        $this->feedQuery = $this->betweenDate($startMonth, $endMonth);
        return $this;
    }

    public function betweenDate(string $start, string $end)
    {
        $this->feedQuery = $this->whereBetween('date', [$start, $end]);
        return $this;
    }

    public function lastDays(int $days)
    {
        return Carbon::now()
            ->startOfDay()
            ->subDays($days)
            ->format($this->defaultArticlesDateFormat);
    }

    public function endOfDay()
    {
        return Carbon::now()
            ->endOfDay()
            ->format($this->defaultArticlesDateFormat);
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

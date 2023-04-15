<?php

namespace Lwwcas\LaravelRssReader\Models;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Lwwcas\LaravelRssReader\Database\Factories\RssFeedFactory;

class RssFeed extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'lw_feeds';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'uuid',
        'title',
        'key',
        'read_at',
    ];

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
        });
    }

    protected static function newFactory(): Factory
    {
        return RssFeedFactory::new();
    }

    /**
     * Get the articles for the rss feed.
     */
    public function articles()
    {
        return $this->hasMany(RssFeedArticle::class, 'feed_id');
    }

    /**
     * Get the logs for the rss feed.
     */
    public function logs()
    {
        return $this->hasMany(RssFeedLog::class, 'feed_id');
    }

    public function scopeWhereKey($query, string $key)
    {
        return $query->where('key', $key);
    }
}

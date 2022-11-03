<?php

namespace Lwwcas\LaravelRssReader\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Lwwcas\LaravelRssReader\Casts\Json;

class RssFeedArticle extends Model
{
    use HasFactory;

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
}

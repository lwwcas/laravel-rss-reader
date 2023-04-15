<?php

namespace Lwwcas\LaravelRssReader\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;
use Lwwcas\LaravelRssReader\Database\Factories\RssFeedLogFactory;

class RssFeedLog extends Model
{
    use HasFactory;

    public const ACTION_AUTOSAVE = 'AUTOSAVE';
    public const ACTION_SAVE = 'SAVE';

    public const ACTION_AUTOREAD = 'AUTOREAD';
    public const ACTION_READ = 'READ';

    public $defaultArticlesDateFormat = null;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'lw_feed_logs';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'feed_id',
        'uuid',
        'title',
        'key',
        'action',
        'date',
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
        return RssFeedLogFactory::new();
    }

    /**
     * Get the RSS Feed that owns the log.
     */
    public function feed()
    {
        return $this->belongsTo(RssFeed::class, 'feed_id');
    }
}

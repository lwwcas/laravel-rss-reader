<?php

namespace Lwwcas\LaravelRssReader\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Lwwcas\LaravelRssReader\Concerns\ConfigFeed;

class RssFeedLog extends Model
{
    use HasFactory;
    use ConfigFeed;

    public const ACTION_AUTOSAVE = 'AUTOSAVE';
    public const ACTION_SAVE = 'SAVE';

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
        'uuid',
        'title',
        'key',
        'action',
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

    /**
     * Get the RSS Feed that owns the log.
     */
    public function feed()
    {
        return $this->belongsTo(RssFeed::class, 'feed_id');
    }
}

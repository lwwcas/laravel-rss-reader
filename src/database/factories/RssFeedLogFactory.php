<?php

namespace Lwwcas\LaravelRssReader\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Lwwcas\LaravelRssReader\Models\RssFeed;
use Lwwcas\LaravelRssReader\Models\RssFeedLog;

class RssFeedLogFactory extends Factory
{

    protected $model = RssFeedLog::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $title = fake()->title();
        $actions = [
            RssFeedLog::ACTION_AUTOSAVE,
            RssFeedLog::ACTION_SAVE,
            RssFeedLog::ACTION_AUTOREAD,
            RssFeedLog::ACTION_READ,
        ];

        return [
            'feed_id' => RssFeed::factory()->create()->id,
            'uuid' => fake()->uuid(),
            'title' => $title,
            'key' => Str::slug($title, '-'),
            'action' => $actions[rand(0, 3)],
            'date' => now(),
        ];
    }
}

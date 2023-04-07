<?php

namespace Lwwcas\LaravelRssReader\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Lwwcas\LaravelRssReader\Models\RssFeed;

class RssFeedFactory extends Factory
{

    protected $model = RssFeed::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $title = fake()->name();

        return [
            'title' => $title,
            'key' => Str::slug($title, '-'),
            'read_at' => now(),
        ];
    }
}

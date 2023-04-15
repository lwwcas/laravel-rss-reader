<?php

namespace Lwwcas\LaravelRssReader\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Lwwcas\LaravelRssReader\Models\RssFeed;
use Lwwcas\LaravelRssReader\Models\RssFeedArticle;

class RssFeedArticleFactory extends Factory
{

    protected $model = RssFeedArticle::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $title = fake()->title();

        return [
            'feed_id' => RssFeed::factory()->create()->id,
            'uuid' => fake()->uuid(),
            'url' => fake()->url(),
            'title' => $title,
            'slug' => Str::slug($title, '-'),
            'description' => fake()->paragraph(),
            'image' => fake()->imageUrl(),
            'language' => fake()->languageCode(),
            'data' => [],
            'active' => fake()->boolean(90),
            'black_list' => fake()->boolean(10),
            'bad_words' => [],
            'date' => now(),
            'custom' => [],
        ];
    }
}

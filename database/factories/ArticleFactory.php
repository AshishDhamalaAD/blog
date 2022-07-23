<?php

namespace Database\Factories;

use App\Models\Enums\ArticleStatusEnum;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Article>
 */
class ArticleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'user_id' => User::factory(),
            'title' => $title = $this->faker->sentence(),
            'slug' => Str::slug($title),
            'description' => $this->faker->paragraphs(4, true),
            'image' => $this->faker->sentence() . '.jpg',
            'views' => $this->faker->numberBetween(1, 100),
            'status' => Arr::random(ArticleStatusEnum::values()),
            'published_at' => $this->faker->dateTimeBetween(now()->subWeek(), now()->addWeek()),
        ];
    }
}

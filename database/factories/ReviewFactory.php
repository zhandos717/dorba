<?php

namespace Database\Factories;

use App\Models\Review;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class ReviewFactory extends Factory
{
    protected $model = Review::class;

    public function definition(): array
    {
        return [
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'product_id' => $this->faker->randomNumber(),
            'user_id'    => $this->faker->randomNumber(),
            'rating'     => $this->faker->randomFloat(),
            'comment'    => $this->faker->word(),
        ];
    }
}

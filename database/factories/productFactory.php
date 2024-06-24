<?php

namespace Database\Factories;

use App\Models\product;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class productFactory extends Factory
{
    protected $model = product::class;

    public function definition(): array
    {
        return [
            'created_at'  => Carbon::now(),
            'updated_at'  => Carbon::now(),
            'name'        => $this->faker->name(),
            'barcode'     => $this->faker->word(),
            'image'       => $this->faker->word(),
            'description' => $this->faker->text(),
        ];
    }
}

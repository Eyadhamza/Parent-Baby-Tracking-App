<?php

namespace Database\Factories;

use App\Models\Baby;
use Illuminate\Database\Eloquent\Factories\Factory;

class BabyFactory extends Factory
{
    protected $model = Baby::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->name,
            'birth_date' => $this->faker->dateTimeBetween('-1 years', '-1 days'),
        ];
    }
}

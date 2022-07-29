<?php

namespace Database\Factories;

use App\Models\ParentUser;
use Illuminate\Database\Eloquent\Factories\Factory;

class ParentUserFactory extends Factory
{
    protected $model = ParentUser::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
        ];
    }
}

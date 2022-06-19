<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Suivie;
use Illuminate\Database\Eloquent\Factories\Factory;

class SuivieFactory extends Factory
{
    protected $model = Suivie::class;

    public function definition()
    {
        return [
            'name'        => $this->faker->word,
            'description' => $this->faker->sentence,
            'creator_id'  => function () {
                return User::factory()->create()->id;
            },
        ];
    }
}

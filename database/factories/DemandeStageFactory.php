<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\DemandeStage;
use Illuminate\Database\Eloquent\Factories\Factory;

class DemandeStageFactory extends Factory
{
    protected $model = DemandeStage::class;

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

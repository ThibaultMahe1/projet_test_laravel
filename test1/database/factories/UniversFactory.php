<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Univers;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Univers>
 */
class UniversFactory extends Factory
{
    protected $model = Univers::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nom'=>$this->faker->name,
            'description'=>$this->faker->text(20),
            'img_fond'=>$this->faker->text(20),
            'logo'=>$this->faker->text(20),
            'couleur_principal'=>$this->faker->hexColor(),
            'couleur_secondaire'=>$this->faker->hexColor(),
            //
        ];
    }
}

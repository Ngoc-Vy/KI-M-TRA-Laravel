<?php

namespace Database\Factories;
use App\Models\Mf;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Car>
 */
class CarFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
       
        return [
        'description' => fake()->paragraph(),
        'model' => fake()->bothify(),
        'produced_on' => fake()->date('Y-m-d'),
        'image'=>'hinh'.fake()->numberBetween(1,4).'.png',
        'mf_id'=> Mf::inRandomOrder()->first()->id,
        ];
    }
}

<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Mf>
 */
class MfFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name = ['TOYOTA', 'MITSUBISHI', 'HONDA', 'BMW','HYUNDAI','SUZUKI'];
        return [
            'mf_name' => fake()->unique()->randomElement($name),
        ];
    }
}

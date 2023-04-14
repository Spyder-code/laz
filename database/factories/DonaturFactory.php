<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Donatur>
 */
class DonaturFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'label_id' => rand(1,4),
            'nama' => $this->faker->name,
            'email' => $this->faker->email,
            'alamat' => $this->faker->address,
            'no_telp' => $this->faker->phoneNumber,
        ];
    }
}

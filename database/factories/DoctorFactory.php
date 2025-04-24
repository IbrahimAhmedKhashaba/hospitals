<?php

namespace Database\Factories;

use App\Models\Section;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Casts\Json;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Doctor>
 */
class DoctorFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'email_verified_at' => now(),
            'section_id' => Section::all()->random()->id,
            'phone' => $this->faker->phoneNumber(),
            'password' => Hash::make('789789789'),
        ];
    }
}

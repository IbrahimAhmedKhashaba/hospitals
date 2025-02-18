<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Section>
 */
class SectionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->unique()->randomElement(['قسم الأطفال', 'قسم الجراحة', 'قسم الأشعة', 'قسم المخ و الأعصاب', 'قسم المختبر' , 'قسم العيون' , 'قسم النساء والتوليد']),
            'description' => $this->faker->paragraph
        ];
    }
}

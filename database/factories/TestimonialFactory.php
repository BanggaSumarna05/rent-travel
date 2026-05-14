<?php

namespace Database\Factories;

use App\Models\Testimonial;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Testimonial>
 */
class TestimonialFactory extends Factory
{
    protected $model = Testimonial::class;

    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'occupation' => fake()->randomElement(['Pengusaha', 'Mahasiswa', 'Karyawan Swasta', 'Wisatawan', 'Content Creator']),
            'content' => fake()->paragraph(),
            'rating' => fake()->numberBetween(4, 5),
            'is_active' => fake()->boolean(85),
        ];
    }
}

<?php

namespace Database\Factories;

use App\Models\Motorcycle;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Motorcycle>
 */
class MotorcycleFactory extends Factory
{
    protected $model = Motorcycle::class;

    public function definition(): array
    {
        $brands = ['Honda', 'Yamaha', 'Suzuki'];
        $models = ['Beat Street', 'Vario 160', 'Scoopy', 'NMAX', 'Aerox', 'Fazzio', 'PCX'];

        return [
            'name' => fake()->randomElement($models) . ' ' . fake()->unique()->numerify('###'),
            'brand' => fake()->randomElement($brands),
            'price_per_day' => fake()->numberBetween(85000, 250000),
            'engine_capacity' => fake()->randomElement(['110', '125', '155', '160']),
            'description' => fake()->paragraphs(2, true),
            'status' => fake()->randomElement(['active', 'active', 'active', 'inactive']),
        ];
    }
}

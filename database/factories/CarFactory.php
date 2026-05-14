<?php

namespace Database\Factories;

use App\Models\Car;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Car>
 */
class CarFactory extends Factory
{
    protected $model = Car::class;

    public function definition(): array
    {
        $brands = ['Toyota', 'Honda', 'Mitsubishi', 'Suzuki', 'Daihatsu', 'Hyundai'];
        $models = ['Avanza', 'Innova Zenix', 'Xpander', 'Ertiga', 'Brio', 'Pajero Sport', 'Creta', 'Hiace'];

        return [
            'name' => fake()->randomElement($models) . ' ' . fake()->unique()->numerify('###'),
            'brand' => fake()->randomElement($brands),
            'category' => fake()->randomElement(['lepas_kunci', 'with_driver', 'carter_drop']),
            'price_per_day' => fake()->numberBetween(250000, 1250000),
            'transmission' => fake()->randomElement(['Manual', 'Automatic']),
            'passenger_capacity' => fake()->randomElement([4, 5, 6, 7, 8, 12, 14]),
            'fuel_type' => fake()->randomElement(['Bensin', 'Diesel', 'Hybrid']),
            'year' => (string) fake()->numberBetween(2018, 2025),
            'description' => fake()->paragraphs(3, true),
            'is_featured' => false,
            'status' => fake()->randomElement(['active', 'active', 'active', 'inactive']),
        ];
    }

    public function featured(): static
    {
        return $this->state(fn () => [
            'is_featured' => true,
            'status' => 'active',
        ]);
    }
}

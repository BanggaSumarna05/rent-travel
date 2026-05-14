<?php

namespace Database\Factories;

use App\Models\TourPackage;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<TourPackage>
 */
class TourPackageFactory extends Factory
{
    protected $model = TourPackage::class;

    public function definition(): array
    {
        $destinations = [
            'Eksplor Tasikmalaya Selatan',
            'Wisata Alam Galunggung',
            'Tour Religi Singaparna',
            'Paket Pangandaran Private Trip',
            'City Tour Tasikmalaya',
            'Adventure Curug & Kuliner',
        ];

        $dayCount = fake()->numberBetween(1, 4);
        $itinerary = collect(range(1, $dayCount))
            ->map(fn (int $day) => [
                'day' => "Hari {$day}",
                'activities' => fake()->sentence(10),
            ])
            ->all();

        return [
            'name' => fake()->randomElement($destinations) . ' ' . fake()->unique()->numerify('##'),
            'duration' => "{$dayCount} Hari " . ($dayCount > 1 ? ($dayCount - 1) . ' Malam' : ''),
            'price' => fake()->numberBetween(450000, 3500000),
            'itinerary' => $itinerary,
            'include' => "Transportasi\nDriver berpengalaman\nBBM\nAir mineral",
            'exclude' => "Tiket pribadi\nPengeluaran pribadi\nMakan di luar paket",
            'description' => fake()->paragraphs(3, true),
            'status' => fake()->randomElement(['active', 'active', 'inactive']),
        ];
    }
}

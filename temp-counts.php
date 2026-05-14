<?php
require 'vendor/autoload.php';
$app = require 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();
$counts = [
    'users' => App\Models\User::count(),
    'cars' => App\Models\Car::count(),
    'motorcycles' => App\Models\Motorcycle::count(),
    'tour_packages' => App\Models\TourPackage::count(),
    'testimonials' => App\Models\Testimonial::count(),
    'faqs' => App\Models\Faq::count(),
    'posts' => App\Models\Post::count(),
    'transactions' => App\Models\Transaction::count(),
    'settings' => App\Models\Setting::count(),
];
foreach ($counts as $table => $count) {
    echo $table . ': ' . $count . PHP_EOL;
}

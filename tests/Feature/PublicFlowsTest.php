<?php

namespace Tests\Feature;

use App\Models\Car;
use App\Models\Post;
use App\Models\Setting;
use App\Models\Transaction;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PublicFlowsTest extends TestCase
{
    use RefreshDatabase;

    public function test_booking_rejects_unknown_bookable_type(): void
    {
        $response = $this->post(route('bookings.store'), [
            'customer_name' => 'Test User',
            'customer_phone' => '08123456789',
            'customer_email' => 'test@example.com',
            'bookable_type' => 'User',
            'bookable_id' => 1,
            'start_date' => now()->toDateString(),
            'service_type' => 'Rental Mobil',
        ]);

        $response->assertSessionHasErrors('bookable_type');
        $this->assertDatabaseCount('transactions', 0);
    }

    public function test_contact_form_redirects_to_sanitized_whatsapp_link(): void
    {
        Setting::create([
            'key' => 'whatsapp_number',
            'value' => '+62 812-3456-789',
        ]);

        $response = $this->post(route('contact.store'), [
            'name' => 'Calon Pelanggan',
            'phone' => '0812000000',
            'email' => 'lead@example.com',
            'service_type' => 'Sewa Mobil Mewah',
            'message' => 'Butuh unit untuk 2 hari.',
        ]);

        $location = $response->headers->get('Location');

        $response->assertRedirect();
        $this->assertNotNull($location);
        $this->assertStringStartsWith('https://wa.me/628123456789?text=', $location);
        $this->assertSame(0, Transaction::count());
    }

    public function test_general_booking_persists_structured_fields_and_redirects_to_whatsapp(): void
    {
        Setting::create([
            'key' => 'whatsapp_number',
            'value' => '+62 812-3456-789',
        ]);

        $response = $this->post(route('bookings.store'), [
            'customer_name' => 'Calon Pelanggan',
            'customer_phone' => '081211122233',
            'customer_email' => 'pelanggan@example.com',
            'service_type' => 'Rental Mobil Harian',
            'driver_option' => 'dengan_driver',
            'start_date' => now()->toDateString(),
            'end_date' => now()->addDay()->toDateString(),
            'location' => 'Tasikmalaya Kota',
            'notes' => 'Tolong konfirmasi sore ini.',
        ]);

        $response->assertRedirect();

        $transaction = Transaction::first();

        $this->assertNotNull($transaction);
        $this->assertNull($transaction->bookable_type);
        $this->assertSame('Rental Mobil', $transaction->service_category);
        $this->assertSame('Rental Mobil Harian', $transaction->service_name);
        $this->assertSame('dengan_driver', $transaction->driver_option);
        $this->assertSame('Tasikmalaya Kota', $transaction->location);
        $this->assertSame('Tolong konfirmasi sore ini.', $transaction->notes);
    }

    public function test_car_booking_requires_driver_option(): void
    {
        $car = Car::factory()->create([
            'status' => 'active',
            'price_per_day' => 300000,
        ]);

        $response = $this->from(route('cars.show', $car))->post(route('bookings.store'), [
            'customer_name' => 'Pelanggan Mobil',
            'customer_phone' => '081234567899',
            'bookable_type' => 'Car',
            'bookable_id' => $car->id,
            'start_date' => now()->toDateString(),
            'end_date' => now()->addDay()->toDateString(),
        ]);

        $response->assertRedirect(route('cars.show', $car));
        $response->assertSessionHasErrors('driver_option');
        $this->assertDatabaseCount('transactions', 0);
    }

    public function test_post_detail_returns_not_found_when_published_at_is_missing(): void
    {
        $post = Post::factory()->create([
            'is_published' => true,
            'published_at' => null,
        ]);

        $this->get(route('posts.show', $post))
            ->assertNotFound();
    }

    public function test_post_detail_renders_real_share_links(): void
    {
        $post = Post::factory()->published()->create();

        $response = $this->get(route('posts.show', $post));

        $response->assertOk();
        $response->assertSee('https://twitter.com/intent/tweet', false);
        $response->assertSee('https://www.facebook.com/sharer/sharer.php', false);
    }
}

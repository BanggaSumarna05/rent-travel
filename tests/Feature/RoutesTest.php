<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Route;
use Tests\TestCase;

class RoutesTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_routes_are_registered()
    {
        $this->assertTrue(Route::has('admin.dashboard'));
        $this->assertTrue(Route::has('admin.cars.index'));
        $this->assertTrue(Route::has('admin.motorcycles.index'));
        $this->assertTrue(Route::has('admin.tour-packages.index'));
        $this->assertTrue(Route::has('admin.transactions.export.csv'));
        $this->assertTrue(Route::has('contact.store'));
    }

    public function test_admin_resource_show_routes_are_not_registered_for_content_resources(): void
    {
        $this->assertFalse(Route::has('admin.cars.show'));
        $this->assertFalse(Route::has('admin.motorcycles.show'));
        $this->assertFalse(Route::has('admin.tour-packages.show'));
        $this->assertFalse(Route::has('admin.posts.show'));
        $this->assertFalse(Route::has('admin.testimonials.show'));
        $this->assertFalse(Route::has('admin.faqs.show'));
    }

    public function test_admin_routes_require_authentication()
    {
        $route = Route::getRoutes()->getByName('admin.dashboard');
        $this->assertNotNull($route);

        $middleware = $route->gatherMiddleware();
        $this->assertContains('auth', $middleware);
    }

    public function test_admin_routes_forbid_non_admin_users()
    {
        $route = Route::getRoutes()->getByName('admin.dashboard');
        $this->assertNotNull($route);

        $middleware = $route->gatherMiddleware();
        $this->assertContains('admin', $middleware);
    }

    public function test_dashboard_redirects_admin_to_admin_dashboard(): void
    {
        $admin = User::factory()->create([
            'is_admin' => true,
            'email_verified_at' => now(),
        ]);

        $this->actingAs($admin)
            ->get(route('dashboard'))
            ->assertRedirect(route('admin.dashboard'));
    }

    public function test_dashboard_redirects_regular_user_to_profile(): void
    {
        $user = User::factory()->create([
            'is_admin' => false,
            'email_verified_at' => now(),
        ]);

        $this->actingAs($user)
            ->get(route('dashboard'))
            ->assertRedirect(route('profile.edit'));
    }
}

<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Support\Facades\Route;
use Tests\TestCase;

class RoutesTest extends TestCase
{
    public function test_admin_routes_are_registered()
    {
        $this->assertTrue(Route::has('admin.dashboard'));
        $this->assertTrue(Route::has('admin.cars.index'));
        $this->assertTrue(Route::has('admin.motorcycles.index'));
        $this->assertTrue(Route::has('admin.tour-packages.index'));
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
}

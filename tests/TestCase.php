<?php

namespace Tests;

use App\Models\Users\Role;
use App\Models\Users\User;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Testing\TestResponse;
use Laravel\Passport\Passport;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;
    use WithFaker;

    /**
     * @var User
     */
    protected User $admin;

    /**
     * @var User
     */
    protected User $user;

    /**
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        Artisan::call('migrate:fresh');
        Artisan::call('passport:install');

        Role::create([
            'title' => 'Administrator',
            'slug' => 'admin'
        ]);

        $this->admin = User::create([
            'name' => 'Administrator',
            'email' => 'admin@admin.com',
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi'
        ]);
        $this->admin->roles()->attach(1);

        $this->user = User::create([
            'name' => 'Luffy',
            'email' => 'one@piece.com',
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi'
        ]);
    }

    /**
     * @param string $route
     * @param User|null $user
     * @param array $headers
     * @param int $status
     * @return TestResponse
     */
    protected function http_get(string $route, ?User $user = null, array $headers = [], int $status = 200): TestResponse
    {
        if ($user) {
            Passport::actingAs($user, [$route]);
        }

        return $this->getJson($route, $headers)->assertStatus($status);
    }

    /**
     * @param string $route
     * @param User|null $user
     * @param array $data
     * @param array $header
     * @param int $status
     * @return TestResponse
     */
    protected function http_post(string $route, ?User $user = null, array $data = [], array $header = [], int $status = 200): TestResponse
    {
        if ($user) {
            Passport::actingAs($user, [$route]);
        }

        return $this->postJson($route, $data, $header)->assertStatus($status);
    }

    /**
     * @param $route
     * @param User|null $user
     * @param array $data
     * @param array $header
     * @param int $status
     * @return TestResponse
     */
    protected function http_put($route, ?User $user = null, array $data = [], array $header = [], int $status = 200): TestResponse
    {
        if ($user) {
            Passport::actingAs($user, [$route]);
        }

        return $this->putJson($route, $data, $header)->assertStatus($status);
    }

    /**
     * @param string $route
     * @param User|null $user
     * @param int $status
     * @return TestResponse
     */
    protected function http_delete(string $route, ?User $user = null, int $status = 204): TestResponse
    {
        if ($user) {
            Passport::actingAs($user, [$route]);
        }

        return $this->deleteJson($route)->assertStatus($status);
    }
}

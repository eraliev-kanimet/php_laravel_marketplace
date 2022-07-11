<?php

namespace Tests;

use App\Models\Users\Role;
use App\Models\Users\User;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Artisan;

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
}

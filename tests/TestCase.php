<?php

namespace Tests;

use App\Role;
use App\User;
use App\Exceptions\Handler;
use Illuminate\Support\Facades\Schema;
use Illuminate\Contracts\Debug\ExceptionHandler;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    /**
     * Check if the database is seeded or not
     * @var bool
     */
    private static $migratedDatabase = false;

    public function setUp(): void
    {
        parent::setUp();

        // fresh && seed
        if(config('setting.migrate_test_database')) {
            $this->migrate();
        }
    }

    /**
     * Seed the DB. ONCE
     */
    private function migrate(): void
    {
        if (TestCase::$migratedDatabase === true) {
            return;
        }

        $this->afterApplicationCreated(function() {
             $this->artisan('migrate:fresh', ['--seed' => true]);
        });

        TestCase::$migratedDatabase = true;
    }

    protected function signIn($user = null)
    {
        $user = $user ?: factory(User::class)->create();

        $this->actingAs($user);

        return $this;
    }

    protected function signInAdmin($admin = null)
    {
        $admin = $admin ?: factory(User::class)->create(['role_id' => Role::ADMIN_ROLE]);

        $this->actingAs($admin);

        return $this;
    }

    /**
     * generate user data array
     * 
     * @param  array  $overrides
     * @return array
     */
    public function validParams($overrides = []): array
    {
        $user = factory(User::class)->make()->toArray();
        
        return array_merge(
            array_merge([
                'password' => 'password',
                'password_confirmation' => 'password',
            ], $user), 
            $overrides);
    }
}

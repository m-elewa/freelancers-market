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
        // $this->migrate();

        Schema::enableForeignKeyConstraints();
        // $this->withoutExceptionHandling();
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
}

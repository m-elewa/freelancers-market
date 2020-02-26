<?php

namespace Tests;

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
        $this->migrate();
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
}

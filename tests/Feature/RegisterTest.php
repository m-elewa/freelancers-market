<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\User;
use Faker\Factory;
use Illuminate\Support\Str;

class RegisterTest extends TestCase
{
    // use RefreshDatabase;
    use WithFaker;

    /** @test */
    public function user_can_see_register_page(): void
    {
        $uri = route('register');

        $response = $this->get($uri);
        $response->assertSeeText('First name');
    }

    /** @test */
    public function user_must_be_able_to_register(): void
    {
        $this->withoutExceptionHandling();
        $uri = route('register');

        $response = $this->post($uri, $this->data());
        $response->assertRedirect(route('home'));
    }

    public function data() {
        $user = factory(User::class)->make();
        return [
            'first_name' => $user->first_name,
            'last_name' => $user->last_name,
            'email' => $user->email,
            'password' => 'password',
            'password_confirmation' => 'password',
        ];
    }
}

<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;
use Illuminate\Support\Facades\Event;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LoginTest extends TestCase
{
    // use RefreshDatabase;

    /** @test */
    public function user_can_not_see_setting_page_if_not_logged_in(): void
    {
        $this->assertGuest();
        $uri = route('setting.edit');

        $this->get($uri)->assertRedirect(route('login'));
    }

    /** @test */
    public function user_must_provide_valid_credentials_in_order_to_login(): void
    {
        $uri = route('login');
        $user = factory(User::class)->create();

        $this->assertDatabaseHas('users', [
            'email' => $user->email,
        ]);

        $credentials = [
            'email' => $user->email, 
            'password' => 'wrong-password',
        ];

        $this->assertInvalidCredentials($credentials);

        $this->post($uri, $credentials);

        $this->assertGuest();
    }

    /** @test */
    public function user_must_be_able_to_login(): void
    {
        $uri = route('login');
        $user = factory(User::class)->create();

        $response = $this->post($uri, [
            'email' => $user->email, 
            'password' => 'password',
        ]);
        $this->assertAuthenticated();
        $response->assertRedirect(route('home'));
    }

    /** @test */
    public function user_should_be_able_to_logout()
    {
        $user = factory(User::class)->create();

        $this->actingAs($user)
            ->post(route('logout'))
            ->assertRedirect(route('home'));

        $this->assertFalse($this->isAuthenticated());
    }
}

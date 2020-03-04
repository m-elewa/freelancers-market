<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\User;

class LoginTest extends TestCase
{
    // use RefreshDatabase;

    /** @test */
    public function user_can_not_see_home_page_if_not_logged_in(): void
    {
        $uri = route('setting.edit');

        $response = $this->get($uri);
        $response->assertRedirect(route('login'));
    }

    /** @test */
    public function user_can_see_login_page(): void
    {
        $uri = route('login');

        $response = $this->get($uri);
        $response->assertSeeText('E-Mail Address');
    }

    /** @test */
    public function user_must_provide_valid_credentials_in_order_to_login(): void
    {
        $uri = route('login');
        $user = factory(User::class)->create();

        $this->assertDatabaseHas('users', [
            'email' => $user->email,
        ]);

        $response = $this->post($uri, [
            'email' => $user->email, 
            'password' => 'wrong-password',
        ]);

        $this->user_can_not_see_home_page_if_not_logged_in();
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
        $response->assertRedirect(route('home'));
    }
}

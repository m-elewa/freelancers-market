<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;
use Illuminate\Auth\Events\Logout;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Notification;
use Illuminate\Auth\Notifications\ResetPassword;

class LoginTest extends TestCase
{
    /** @test */
    public function user_can_not_see_setting_page_if_not_logged_in(): void
    {
        $this->assertGuest();
        $uri = route('setting.edit');

        $this->get($uri)->assertRedirect(route('login'));
    }

    /** @test */
    public function user_can_view_a_login_form()
    {
        $this->assertGuest();
        $response = $this->get(route('login'));

        $response->assertSuccessful();
        $response->assertViewIs('auth.login');
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

        $response = $this->post($uri, $credentials);
        $response->assertSessionHasErrors('email');

        $this->assertGuest();

        $user->delete();
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
        $response->assertSessionHasNoErrors();
        $this->assertAuthenticatedAs($user);
        $response->assertRedirect(route('home'));

        auth()->user()->delete();
    }

    /** @test */
    public function user_cannot_view_a_login_form_when_authenticated()
    {
        $user = factory(User::class)->create();

        $response = $this->actingAs($user)->get(route('login'));

        $response->assertRedirect(route('home'));
        $user->delete();
    }

    /** @test */
    public function user_should_be_able_to_logout_and_trigger_logout_event()
    {
        $user = factory(User::class)->create();
        Event::fake();

        $this->actingAs($user)
            ->post(route('logout'))
            ->assertRedirect(route('home'));

        $this->assertFalse($this->isAuthenticated());
        Event::assertDispatched(Logout::class);
        $user->delete();
    }

    /** @test */
    public function user_receives_an_email_with_a_password_reset_link()
    {
        Notification::fake();
      
        $user = factory(User::class)->create();
      
        $response = $this->post(route('password.email'), [
            'email' => $user->email,
        ]);

        $token = DB::table('password_resets')->latest()->first();

        $this->assertNotNull($token);
      
        Notification::assertSentTo($user, ResetPassword::class, function ($notification) use ($token) {
            return Hash::check($notification->token, $token->token) === true;
        });
    }
}

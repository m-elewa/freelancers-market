<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;
use App\Notifications\VerifyEmail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Notification;

class RegisterTest extends TestCase
{
    use WithFaker;

    /** @test */
    public function email_is_required()
    {
        $this->from(route('register'));

        $response = $this->post(route('register'), $this->validParams([
            'email' => '',
        ]));

        $response->assertRedirect(route('register'));
        $response->assertSessionHasErrors('email');
        $this->assertFalse(Auth::check());
    }

    /** @test */
    public function email_is_valid()
    {
        $this->from(route('register'));

        $response = $this->post(route('register'), $this->validParams([
            'email' => 'not-an-email-address',
        ]));

        $response->assertRedirect(route('register'));
        $response->assertSessionHasErrors('email');
        $this->assertFalse(Auth::check());
    }

    /** @test */
    public function email_cannot_exceed_255_chars()
    {
        $this->from(route('register'));

        $response = $this->post(route('register'), $this->validParams([
            'email' => substr(str_repeat('a', 256) . '@example.com', -256),
        ]));

        $response->assertRedirect(route('register'));
        $response->assertSessionHasErrors('email');
        $this->assertFalse(Auth::check());
    }

    /** @test */
    public function email_is_unique()
    {
        $email = 'johndoe@example.com';
        $user = factory(User::class)->create(['email' => $email]);
        $this->from(route('register'));

        $response = $this->post(route('register'), $this->validParams([
            'email' => $email,
        ]));

        $response->assertRedirect(route('register'));
        $response->assertSessionHasErrors('email');
        $this->assertFalse(Auth::check());
        $user->delete();
    }

    /** @test */
    public function users_can_register_an_account_with_email_verification()
    {
        Notification::fake();

        $response = $this->post(route('register'), $this->validParams());
        $response->assertSessionHasNoErrors();

        $response->assertRedirect(route('home'));
        $this->assertTrue(Auth::check());

        Notification::assertSentTo(auth()->user(), VerifyEmail::class);
        
        auth()->user()->delete();
    }
}

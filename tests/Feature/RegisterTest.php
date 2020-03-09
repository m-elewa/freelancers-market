<?php

namespace Tests\Feature;

use App\User;
use Faker\Factory;
use Tests\TestCase;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RegisterTest extends TestCase
{
    // use RefreshDatabase;
    use WithFaker;

    /** @test */
    public function users_can_register_an_account()
    {
        $response = $this->post(route('register'), $this->validParams());

        $response->assertRedirect(route('home'));

        $this->assertTrue(Auth::check());

        auth()->user()->delete();
    }

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
}

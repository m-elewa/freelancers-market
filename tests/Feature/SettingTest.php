<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SttingTest extends TestCase
{
    // use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();

        $this->signIn();
    }

    /** @test */
    public function user_can_see_setting_page(): void
    {
        $uri = route('setting.edit');
        $response = $this->get($uri);

        $response->assertOk()->assertSee('Setting');
    }

    /** @test */
    public function user_can_update_his_setting(): void
    {
        $uri = route('setting.update');
        $job = factory(User::class)->make(['user_id' => null]);

        $response = $this->post($uri, $job->only(['first_name', 'last_name', 'email']) + ['current_password' => 'password']);
        $response->assertSessionHasNoErrors();
        $response->assertRedirect(route('setting.edit'));
    }

    /** @test */
    public function user_can_update_his_password(): void
    {
        $uri = route('setting.update-password');

        $response = $this->post($uri, [
            'password' => 'password2',
            'password_confirmation' => 'password2',
            'current_password_modal' => 'password',
        ]);

        $this->assertTrue(Hash::check('password2', auth()->user()->password));
        $response->assertSessionHasNoErrors();
        $response->assertRedirect(route('setting.edit'));
    }

    /** @test */
    public function validate_current_password(): void
    {
        $uri = route('setting.update-password');

        $response = $this->post($uri, [
            'password' => 'password3',
            'password_confirmation' => 'password3',
            'current_password_modal' => 'wrong-password',
        ]);

        $this->assertFalse(Hash::check('password2', auth()->user()->password));
        $response->assertSessionHasErrors(['current_password_modal']);

        $response->assertRedirect(route('setting.edit'));
    }
}

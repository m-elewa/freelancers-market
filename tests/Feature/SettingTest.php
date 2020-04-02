<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;
use Illuminate\Support\Facades\Hash;

class SettingTest extends TestCase
{
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
        $user = factory(User::class)->make();

        $response = $this->post($uri, $user->toArray() + ['current_password' => 'password']);
        $response->assertSessionHasNoErrors();

        $this->assertEquals(Auth()->user()->profile_link, $user->profile_link);
        $this->assertEquals(Auth()->user()->email, $user->email);

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

        $this->assertFalse(Hash::check('password3', auth()->user()->password));
        $response->assertSessionHasErrors(['current_password_modal']);

        $response->assertRedirect(route('home'));
    }
    
    /** @test */
    public function user_can_not_update_his_profile_link_from_job_page_if_not_empty(): void
    {
        $uri = route('setting.update-profile-link');
        $user = factory(User::class)->make();

        $response = $this->post($uri, [
            'profile_link' => $user->profile_link,
        ]);
        $this->assertNotEquals(Auth()->user()->profile_link, $user->profile_link);
        $response->assertStatus(403);
    }
    
    /** @test */
    public function user_can_update_his_profile_link_from_job_page_if_empty(): void
    {
        $uri = route('setting.update-profile-link');
        $user = factory(User::class)->make();

        auth()->user()->update(['profile_link' => '']);

        $response = $this->post($uri, [
            'profile_link' => $user->profile_link,
        ]);
        $response->assertSessionHasNoErrors();
        $this->assertEquals(Auth()->user()->profile_link, $user->profile_link);
        $response->assertRedirect();
    }

    /**
     * Clean up the testing environment before the next test.
     *
     * @return void
     */
    public function tearDown(): void
    {
        auth()->user()->delete();
        parent::tearDown();
    }
}

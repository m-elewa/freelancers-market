<?php

namespace Tests\Feature;

use Str;
use App\Bid;
use App\Job;
use App\User;
use Tests\TestCase;
use App\Notifications\BidPostedNotification;
use Illuminate\Support\Facades\Notification;

class JobTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();

        $this->signIn();
    }

    /** @test */
    public function user_can_see_jobs_index_page(): void
    {
        $uri = route('jobs.index');
        $response = $this->get($uri);
        $response->assertOk();
        $response->assertSee('My Projects');
    }

    /** @test */
    public function user_can_see_jobs_bids_index_page(): void
    {
        $uri = route('jobs.bid-index');
        $response = $this->get($uri);
        $response->assertOk();
        $response->assertSee('My Bids');
    }

    /** @test */
    public function user_can_see_jobs_search_page(): void
    {
        $uri = route('jobs.search');
        $response = $this->get($uri);
        $response->assertOk();
        $response->assertSee('Find Work');
    }

    /** @test */
    public function user_can_see_create_job_page(): void
    {
        $uri = route('jobs.create');

        $response = $this->get($uri);
        $response->assertStatus(200);
        $response->assertSee('Post a Project');
    }

    /** @test */
    public function user_can_store_job(): void
    {
        $uri = route('jobs.store');
        $job = factory(Job::class)->make(['user_id' => null]);

        $response = $this->post($uri, $job->toArray());
        $response->assertSessionHasNoErrors();

        $this->assertDatabaseHas('jobs', $job->only(['description', 'title', 'job_link']));
        $job = Job::latest()->first();

        $response->assertRedirect(route('jobs.show', ['job' => $job->id, 'title' => Str::slug($job->title)]));

        $job->delete();
    }

    /** @test */
    public function user_can_store_job_bid_and_send_notification(): void
    {
        Notification::fake();
        
        $job = Job::inRandomOrder()->with('user')->first();

        $uri = route('jobs.store-bid', ['job' => $job->id]);
        $bid = factory(Bid::class)->make(['user_id' => null, 'job_id' => null]);

        $response = $this->post($uri, $bid->only(['description', 'amount']));
        $response->assertSessionHasNoErrors();

        $this->assertDatabaseHas('bids', $bid->only(['description', 'amount']) + ['job_id' => $job->id, 'user_id' => auth()->id()]);

        $response->assertRedirect(route('jobs.show', ['job' => $job->id, 'title' => Str::slug($job->title)]));

        Notification::assertSentTo(
            $job->user,
            BidPostedNotification::class);
        
        $job->bids()->latest()->first()->delete();
    }

    /** @test */
    public function user_can_show_a_job(): void
    {
        $user = factory(User::class)->create();

        $job = $user->jobs()->create(factory(Job::class)->make(['user_id' => null])->toArray());
        $uri = route('jobs.show', ['job' => $job->id]);

        $response = $this->get($uri);
        $response->assertOk();

        $job->delete();
        $user->delete();
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

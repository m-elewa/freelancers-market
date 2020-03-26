<?php

namespace App\Policies;

use App\Job;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class JobPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the job bids.
     *
     * @param  \App\User  $user
     * @param  \App\Job  $job
     * @return mixed
     */
    public function viewBids(User $user, Job $job)
    {
        return $user->id === $job->user_id;
    }

    /**
     * Determine whether the user can create a bid on the job.
     *
     * @param  \App\User  $user
     * @param  \App\Job  $job
     * @return mixed
     */
    public function createBid(User $user, Job $job)
    {
        return $user->id !== $job->user_id;
    }

    /**
     * Determine whether the freelancer can view his bid on the job.
     *
     * @param  \App\User  $user
     * @param  \App\Job  $job
     * @return mixed
     */
    public function viewFreelancerBid(User $user, Job $job)
    {
        return $job->bids()->freelancerBid()->count();
    }
}

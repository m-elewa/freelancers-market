<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Auth\Notifications\VerifyEmail as LaravelVerifyEmail;

class VerifyEmail extends LaravelVerifyEmail implements ShouldQueue
{
    use Queueable;
}
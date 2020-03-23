<?php

namespace App\Notifications;

use App\Bid;
use App\Mail\BidPostedMail;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Notifications\Messages\BroadcastMessage;

class BidPostedNotification extends Notification implements ShouldQueue
{
    use Queueable;

    protected $bid;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Bid $bid)
    {
        $this->bid = $bid;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail', 'database', 'broadcast'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new BidPostedMail($this->bid))->to($notifiable);
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            'user' => [
                'id' => $this->bid->user_id,
                'name' => $this->bid->user->name,
            ],
            'job' => [
                'id' => $this->bid->job_id,
                'title' => $this->bid->job->title,
                'url' => route('jobs.show', ['job' => $this->bid->job_id, 'title' => \Str::slug($this->bid->job->title)]),
            ],
            'description' => \Str::words(trim(strip_tags($this->bid->description)), 10),
            'amount' => $this->bid->amount,
            'created_at' => $this->bid->created_at->diffForHumans(),
        ];
    }
}

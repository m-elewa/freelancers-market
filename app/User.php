<?php

namespace App;

use App\Traits\Models\UuidModel;
use App\Notifications\VerifyEmail;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable, UuidModel;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name', 'last_name', 'password', 'role_id', 'status_id', 'email', 'profile_link', 'email_verified_at'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = ['name'];

    protected $attributes = [
        'status_id' => Status::ACTIVE_STATUS,
        'role_id' => Role::USER_ROLE,
    ];

    /**
     * Send the email verification notification.
     *
     * @return void
     */
    public function sendEmailVerificationNotification()
    {
        $this->notify(new VerifyEmail);
    }

    /**
     * Get the full name for the user
     * @return string
     */
    public function name(): string
    {
        return ucfirst("{$this->first_name} {$this->last_name}");
    }

    /**
     * Get the user's full name.
     *
     * @return string
     */
    public function getNameAttribute()
    {
        return $this->name();
    }

    /**
     * Scope a query to only include admin users.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeAdmin($query)
    {
        return $query->where('role_id', Role::ADMIN_ROLE);
    }

    public function jobs(): HasMany
    {
        return $this->hasMany(Job::class);
    }

    public function bids(): HasMany
    {
        return $this->hasMany(Bid::class);
    }

    public function isAdmin(): bool
    {
        return $this->role_id === Role::ADMIN_ROLE;
    }

    public function freelanceWebsiteLink(): string
    {
        return 'https://www.' . config("setting.freelance_website_domain") . $this->profile_link;
    }
}

<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Traits\Models\UuidModel;

class User extends Authenticatable
{
    use Notifiable, UuidModel;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name', 'last_name', 'password', 'role_id', 'status_id', 'email'
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
     * Get the full name for the user
     * @return string
     */
    public function name(): string
    {
        return ucfirst("{$this->first_name} {$this->last_name}");
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
}

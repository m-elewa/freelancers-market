<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Traits\Models\UuidModel;

class Bid extends Model
{
    use UuidModel;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'job_id', 'description', 'status_id', 'amount', 'user_id'
    ];

    protected $attributes = [
        'status_id' => Status::ACTIVE_STATUS,
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function job(): BelongsTo
    {
        return $this->belongsTo(Job::class, 'job_id');
    }

    /**
     * Scope a query to only include freelancer's bid.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeFreelancerBid($query)
    {
        return $query->where('user_id', auth()->id())->first();
    }
}

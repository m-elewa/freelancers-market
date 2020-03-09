<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Traits\Models\UuidModel;

class Job extends Model
{
    use UuidModel;

    const UPWORK_LINK = 'upwork.com/jobs/';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title', 'description', 'status_id', 'user_id', 'upwork_job_link'
    ];

    protected $attributes = [
        'status_id' => Status::ACTIVE_STATUS,
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function bids(): hasMany
    {
        return $this->hasMany(Bid::class);
    }

    public function upworkLink(): string
    {
        return 'https://www.' . SELF::UPWORK_LINK . $this->upwork_job_link;
    }
}

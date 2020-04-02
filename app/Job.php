<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Traits\Models\UuidModel;
use Laravel\Scout\Searchable;

class Job extends Model
{
    use UuidModel, Searchable;

    protected $withCount = ['bids'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title', 'description', 'status_id', 'user_id', 'job_link'
    ];

    protected $attributes = [
        'status_id' => Status::ACTIVE_STATUS,
    ];

    /**
     * Get the indexable data array for the model.
     *
     * @return array
     */
    public function toSearchableArray()
    {
        return $this->only([
            'id',
            'title',
            'description',
        ]);
    }

    public function shouldBeSearchable()
    {
        return $this->status_id === Status::ACTIVE_STATUS;
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function bids(): hasMany
    {
        return $this->hasMany(Bid::class);
    }

    public function freelanceWebsiteLink(): string
    {
        return 'https://www.' . config("setting.freelance_website_domain") . $this->job_link;
    }
}

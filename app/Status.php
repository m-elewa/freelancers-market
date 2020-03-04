<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    const ACTIVE_STATUS = 1;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'key',
    ];
}

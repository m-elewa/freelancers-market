<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    const USER_ROLE = 1;
    const ADMIN_ROLE = 2;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'key',
    ];
}

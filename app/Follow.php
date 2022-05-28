<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Follow extends Model
{
    protected $fillable = [
        'id', 'follow', 'follower', 'created_at'
    ];

    const UPDATED_AT = NULL;
}

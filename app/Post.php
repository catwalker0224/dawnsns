<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
        'id', 'user_id', 'posts', 'created_at', 'updated_at'
    ];

    const UPDATED_AT = NULL;
}

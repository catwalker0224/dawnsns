<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
        'username', 'id', 'user_id', 'posts', 'created_at', 'updated_at'
    ];
}

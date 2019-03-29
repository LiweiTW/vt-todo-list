<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Todo extends Model
{
    protected $fillable = [
        'user_id',
        'title',
        'content',
        'attachment',
        'done_at',
        'created_at',
        'deleted_at',
    ];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Like extends Model
{
    protected $fillable = [
        'post_id',
        'user_id'
    ];

    public function user(){
        return $this->BelongsTo(User::class);
    }
    public function post(){
        return $this->BelongsTo(Post::class);
    }
}

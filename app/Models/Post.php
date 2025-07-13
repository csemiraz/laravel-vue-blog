<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    public function category()
    {
        $this->belongsTo(Category::class);
    }

    public function user()
    {
        $this->belongsTo(User::class);
    }
}

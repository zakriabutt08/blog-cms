<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    //
    protected $fillable = [
        'title',
        'body',
        'published',
    ];

    protected $casts = [
        'published' => 'boolean',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

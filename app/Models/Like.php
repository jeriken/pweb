<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    use HasFactory;

    protected $table = 'likes';

    protected $fillable = [
        'picture_id',
        'user_id'
    ];

    public function picture()
    {
        return $this->belongsToMany(Picture::class);
    }

    public function user()
    {
        return $this->belongsToMany(User::class);
    }
}

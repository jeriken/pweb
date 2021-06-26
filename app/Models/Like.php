<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    use HasFactory;

    protected $table = 'likes';

    protected $fillable = [
        'pict_id',
        'user_id'
    ];

    public function like() {
        return $this->hasMany(Picture::class);
        return $this->hasMany(User::class);
    }
}

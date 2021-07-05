<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bookmark extends Model
{
    use HasFactory;

    protected $table = 'bookmarks';

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

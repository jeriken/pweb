<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bookmark extends Model
{
    use HasFactory;

    protected $table = 'bookmarks';

    public function bookmark() {
        return $this->hasMany(Picture::class);
        return $this->hasMany(User::class);
    }
}

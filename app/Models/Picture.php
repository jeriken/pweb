<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Picture extends Model
{
    use HasFactory;

    protected $table = 'pictures';

    protected $fillable = [
        'title',
        'caption',
        'pict_url',
        'cat_id',
        'user_id'
    ];

    public function picture() {
        return $this->hasMany(User::class);
        return $this->hasMany(Category::class);
    }

    public function relasi()
    {
        return $this->belongsTo('App\Models\Like');
        return $this->belongsTo('App\Models\Bookmark');
    }
}


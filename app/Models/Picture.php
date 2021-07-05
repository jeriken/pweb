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
        'category_id',
        'user_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function like()
    {
        return $this->hasMany(Like::class);
    }

    public function bookmark()
    {
        return $this->hasMany(Bookmark::class);
    }

}

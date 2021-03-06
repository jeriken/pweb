<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $table = 'categories';

    protected $fillable = [
        'title',
    ];

    public function picture()
    {
        return $this->hasMany('App\Models\Picture');
    }

    public function favorite()
    {
        return $this->hasMany(Favorite::class);
    }
}

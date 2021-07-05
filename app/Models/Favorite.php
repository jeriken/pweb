<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Favorite extends Model
{
    use HasFactory;

    protected $table = 'favorites';

    protected $fillable = [
        'category_id',
        'user_id'
    ];

    public function category()
    {
        return $this->hasMany(Category::class);
    }

    public function user()
    {
        return $this->hasMany(User::class);
    }
}

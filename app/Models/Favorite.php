<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Favorite extends Model
{
    use HasFactory;

    protected $table = 'favorites';

    protected $fillable = [
        'cat_id',
        'user_id'
    ];

    public function picture() {
        return $this->hasMany(Category::class);
        return $this->hasMany(User::class);
    }
}

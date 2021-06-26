<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Favorite extends Model
{
    use HasFactory;

    protected $table = 'favorites';

    public function picture() {
        return $this->hasMany(Category::class);
        return $this->hasMany(User::class);
    }
}

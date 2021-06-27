<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use TaylorNetwork\UsernameGenerator\FindSimilarUsernames;
use TaylorNetwork\UsernameGenerator\GeneratesUsernames;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    use FindSimilarUsernames;
	use GeneratesUsernames;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'username',
        'password',
        'picture'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function relasi()
    {
        return $this->belongsTo('App\Models\Picture');
        return $this->belongsTo('App\Models\Bookmark');
        return $this->belongsTo('App\Models\Like');
        return $this->belongsTo('App\Models\Favorite');
    }
}

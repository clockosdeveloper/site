<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $table = 'users';

    protected $fillable = [
        'username',
        'avatar',
        'company',
        'github',
        'blog',
        'location',
        'introduction',
        'profession'
    ];
}

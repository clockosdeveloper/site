<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Activation extends Model
{
    protected $table = 'activations';

    protected $fillable = ['email','token','password'];



    public function confirmEmail()
    {

    }

}

<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class User extends Model implements AuthenticatableContract,
                                    AuthorizableContract,
                                    CanResetPasswordContract
{
    use Authenticatable, Authorizable, CanResetPassword, \Spatie\Permission\Traits\HasRoles;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['username', 'email', 'password', 'avatar', 'company', 'github', 'blog', 'location', 'sponsor_code', 'profession','sponsor_id'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];

    protected $casts = ['settings' => 'json'];

    protected static function boot()
    {
        parent::boot();

        static::created(function(){

            $userNum = Status::usersNum([0,1]);

            Status::updateStatus(['members' => $userNum]);

        });
    }

    /**
     * һ���û������ύ�������
     * A user may submit more than one task to clockOS.
     */

    public function quests()
    {
        return $this->hasMany('App\Quest');
    }

    public function docs()
    {
        return $this->hasMany('App\Doc');
    }

    public function decisions()
    {
        return $this->hasMany('App\Decision');
    }

    public function votes()
    {
        return $this->hasMany('App\Vote');
    }

    public function execution()
    {
        return $this->hasOne('App\Quest','execution_id');
    }

    public function isATeamManager()
    {
        return true;
    }


    /**
     * A user can have many notifications.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function notifications()
    {
        return $this->hasMany('App\Notification');
    }


    /**
     *
     */
    public function skills()
    {
        return $this->belongsToMany('App\Skill')->withTimestamps();
    }


    /**
     *
     */

    public function settings()
    {
        return $this->hasOne('App\Setting','user_id');
    }

    /**
     *
     */

    public function mySponsor()
    {
        return $this->hasOne('App\Setting','user_id');
    }

    /**
     *
     */

    public function SponsorConfirm()
    {
        return $this->hasMany('App\SponsorConfirm');
    }

    //判断该事务的是否是该用户创造
    public function owns($related)
    {
        return $this->id == $related->user_id;
    }

    public function rank()
    {
        return self::where('stock','>=',\Auth::user()->stock)->count();
    }

    public function income()
    {
        return $this->hasMany('App\Income');
    }

    public function outcome()
    {
        return $this->hasMany('App\Outcome');
    }

    public function checkOutcome()
    {
        return $this->hasMany('App\Outcome');
    }

    public function purchase()
    {
        return $this->hasMany('App\Trade','buyer_id');
    }

    public function sell()
    {
        return $this->hasMany('App\Trade','seller_id');
    }



}

<?php

namespace App\Http\Model;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'password',
    ];

    /**
     * @return array
     */
    public function getFillable()
    {
        return $this->fillable;
    }

    /**
     * @param array $fillable
     */
    public function setFillable($fillable)
    {
        $this->fillable = $fillable;
    }

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function userclipped(){
        return $this->hasMany('App\Http\Model\UserClipped', 'user_id');
    }
    public function usersetting(){
        return $this->hasOne('App\Http\Model\UserSettings','user_id');
    }
    public function userdevice(){
        return $this->hasMany('App\Http\Model\Device','user_id');
    }
    public function usermedia(){
        return $this->hasMany('App\Http\Model\Media','user_id');
    }
}

<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

class UserSettings extends Model
{
    //

    protected $table = 'user_settings';
    protected $fillable = [
        'morning', 'noon', 'other','evening', 'push', 'follower','following','limit', 'favor_restaurant_around','radius'
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

    public $timestamps = false;

    public function user()
    {
        return $this->belongsTo('App\Http\Model\User');
    }


}

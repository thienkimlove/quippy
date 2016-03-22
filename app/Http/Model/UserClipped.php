<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

class UserClipped extends Model
{
    protected $table = 'user_clippeds';
    protected $fillable = [
        'googleplace', 'instagram'
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

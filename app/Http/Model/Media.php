<?php
/**
 * Created by PhpStorm.
 * User: hailpt
 * Date: 2/26/2016
 * Time: 9:24 AM
 */

namespace App\Http\Model;


use Illuminate\Database\Eloquent\Model;

class Media extends Model
{

    protected $table = 'media';
    protected $fillable = [
        'name','longitude','latitude'
    ];

    /**
     * @return string
     */
    public function getTable()
    {
        return $this->table;
    }

    /**
     * @param string $table
     */
    public function setTable($table)
    {
        $this->table = $table;
    }

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
    public function user()
    {
        return $this->belongsTo('App\Http\Model\User');
    }


}
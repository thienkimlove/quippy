<?php
namespace App\Http\Model;
use Illuminate\Database\Eloquent\Model;

/**
 * Created by PhpStorm.
 * User: hailpt
 * Date: 2/25/2016
 * Time: 2:45 PM
 */

class Device extends Model
{


    protected $table = 'devices';
    protected $fillable = [
        'name','type'
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
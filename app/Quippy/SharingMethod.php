<?php

namespace App\Quippy;

use App\Http\Model\User;
use Illuminate\Support\Facades\DB;

/**
 * Created by PhpStorm.
 * User: hailpt
 * Date: 1/21/2016
 * Time: 2:27 PM
 */
class SharingMethod


{
    public static function getRequestValues($request, $key)
    {
        $value = $request->input($key);
        if ($value != null) {
            return $value;
        } else {
            return 'Null';}
    }

    // To get all Column's datas from certain Table
    public static function getAllData($table)
    {
        $datas = DB::table($table)->get();
        return $datas;
    }

    // To get data from Table, Column's name and the Value of that column
    public static function  getDataFromTable($table, $column, $value)
    {
        $data = DB::table($table)->where($column, $value)->first();
        return $data;
    }

    // To get data from Table and column Id
    public function getDataFromId($table, $id)
    {
        $data = DB::table($table)->where('id', $id)->first();
        return $data;
    }

    /* FOR RELATIONSHIP*/
    // To get Object Clipped from user_id ( User )
    public static function getClippedFromUSer($id)
    {
        $datas = User::find($id)->userclipped;
        return $datas;
    }

    // To get Object Setting from user_id ( User )
    public function getSettingFromUSer($id)
    {
        $datas = User::find($id)->usersetting;
        return $datas;
    }

    public static function checkRelationshipExistOrNot($user_id, $pMode)
    {
        if ($pMode == Config::$MODE_SETTING) {
            if (User::find($user_id)->usersetting == null) {
                // If the User has relationship with UserSettings already
                return true;
            } else {
                return false;
            }
        } else if ($pMode == Config::$MODE_CLIPPED) {
            if (User::find($user_id)->userclipped == null) {
                // If the User has relationship with UserClipped already
                return true;
            } else {
                return false;
            }
        }
    }

    /* END RELATIONSHIP*/

}
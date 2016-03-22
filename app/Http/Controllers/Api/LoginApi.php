<?php
/**
 * Created by PhpStorm.
 * User: hailpt
 * Date: 1/22/2016
 * Time: 11:29 AM
 */

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Model\User;
use App\Http\Model\UserSettings;
use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Quippy\SharingMethod;

class LoginApi extends Controller
{
// Compare Token from user ( Getting from instagrams's infomation )
// 1. Get Token from DB and Compare - If equal - Successful and Return proper value
    protected function  checkLogin(Request $request)
    {

        foreach (SharingMethod::getAllData('users') as $user) {
            if (SharingMethod::getRequestValues($request, 'system_token') == $user->system_token) {
                return $this->returnDataLogin('1', 'exist!', $request);
            }
        }
        if ($request->input('system_token') != null) {
        DB::table('users')->insert(
            ['system_token' => SharingMethod::getRequestValues($request, 'system_token')]
        );
        $userFromToken = DB::table('users')->where('system_token', $request->input('system_token'))->first();
        $user = User::find($userFromToken->id);
        $setting = new UserSettings(['push' => false, 'morning' => '07:00', 'noon' => '12:00',
            'evening' => '17:00',
            'follower' => false, 'following' => false,
            'limit' => false, 'favor_restaurant_around' => false, 'radius' => 320]);

        $user->usersetting()->save($setting);
        return $this->returnDataLogin('2', 'Insert successfully !', $request);
        } else {
            return $this->returnResult('0','system_token can not be null');
        }
    }

    public function getFullUserInformation(Request $request)
    {
        $userFromToken = DB::table('users')->where('system_token', $request->input('system_token'))->first();
        if ($userFromToken != null) {
            $user = User::find($userFromToken->id);
            $setting = $user->usersetting;

            $data = array(
                'system_token' => $userFromToken->system_token,
                'setting' => $setting
            );

            return $this->returnResultWithData('1', 'The information of user !', $data);
        } else {
            return $this->returnResult('0', 'The user does not exits in DB !');
        }
    }


    public function returnDataLogin($status, $message, $request)
    {
        $data = array('status' => $status,
            'message' => $message,
            'data' => array(
                'system_token' => SharingMethod::getRequestValues($request, 'system_token')
            )
        );
        return $data;
    }


    public function adminPage(Request $request)
    {
        print_r($request->all()['name']);
    }


    /** RETURN DATA **/
    public function returnResult($status, $message)
    {
        return array(
            'status' => $status,
            'message' => $message
        );
    }

    public function returnResultWithData($status, $message, $data)
    {
        return array(
            'status' => $status,
            'message' => $message,
            'data' => $data
        );
    }

    public function abc(Request $request)
    {
        dd($request->all());
    }
    /** END RETURN DATA **/


}
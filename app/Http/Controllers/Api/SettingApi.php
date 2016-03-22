<?php
/**
 * Created by PhpStorm.
 * User: hailpt
 * Date: 1/22/2016
 * Time: 3:26 PM
 */

namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use App\Http\Model\User;
use App\Http\Model\UserSettings;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SettingApi extends Controller
{

    public function updateSettingForUser(Request $request)
    {
        $settingRq = (array)json_decode($request->input('setting'));

        $userFromToken = DB::table('users')->where('system_token', $request->input('system_token'))->first();
//        $user = User::find($userFromToken->id);
        if ($userFromToken != null) {
            $settingDb = User::find($userFromToken->id)->usersetting;
            DB::table('user_settings')
                ->where('id', $settingDb->id)
                ->update(['push' => $settingRq['push'], 'morning' => $settingRq['morning'], 'noon' => $settingRq['noon'],
                    'evening' => $settingRq['evening'], 'other' => $settingRq['other'],
                    'follower' => $settingRq['follower'], 'following' => $settingRq['following'],
                    'limit' => $settingRq['limit'], 'favor_restaurant_around' => $settingRq['favor_restaurant_around']]);

            $data = User::find($userFromToken->id)->usersetting;
            unset($data->id);
            unset($data->created_at);
            unset($data->user_id);
            unset($data->updated_at);
            return $this->returnResultWithData('1', 'Update Successfully',
                $data);
        } else {
            echo 'Check token';
        }

    }

    public function getSettingFromUser(Request $request)
    {
        $userFromToken = DB::table('users')->where('system_token', $request->input('system_token'))->first();
        if ($userFromToken != null) {
            $setting = User::find($userFromToken->id)->usersetting;
            unset($setting->id);
            unset($setting->created_at);
            unset($setting->user_id);
            unset($setting->updated_at);
            return $this->returnResultWithData('1', 'Successfully', $setting);
        } else {
            echo 'Check token';
        }
    }

    public function updateRadiusForSetting(Request $request)
    {
        $userFromToken = DB::table('users')->where('system_token', $request->input('system_token'))->first();
        if ($userFromToken) {
            $settingDb = User::find($userFromToken->id)->usersetting;
            $setting = UserSettings::find($settingDb->id);
            $setting->radius = $request->input('radius');
            $setting->save();

            return $this->returnResultWithData('1', 'Successfully',
                $setting->radius);
        } else {
            echo 'check token';
        }

    }

    public function getingRadiusFromUser(Request $request)
    {
        $userFromToken = DB::table('users')->where('system_token', $request->input('system_token'))->first();
        if ($userFromToken != null) {
            $setting = User::find($userFromToken->id)->usersetting;
            if ($setting != null) {
                return $this->returnResultWithData('1', 'Successfully', $setting->radius);
            } else {
                echo 'Have no setting...';
            }
        } else {
            echo 'check token';
        }
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
<?php
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;

/**
 * Created by PhpStorm.
 * User: hailpt
 * Date: 2/24/2016
 * Time: 3:01 PM
 */

namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use App\Http\Model\Device;
use App\Http\Model\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PushNotifications extends Controller


{
    public function test()
    {
        $now = Carbon::now('Asia/Saigon')->format('H:i');
        echo $now;
        $users = User::whereHas('usersetting', function ($query) {
            $query->where('morning', '=', Carbon::now('Asia/Saigon')->format('H:i'));
        })->get();


        foreach ($users as $user) {
            $devices = User::find($user->id)->userdevice;
            foreach ($devices as $device) {
                if ($device->type == 'ios') {
                    var_dump($device->type);
                    CronSchedule::pushNotificationIos($device->name);
                } elseif ($device->type == 'android') {
                    $this->sendPushNotification($device->name);
                }

            }
        }
    }

    public function setDeviceForUser(Request $request)
    {
        $userFromToken = DB::table('users')->where('system_token', $request->input('system_token'))->first();
        if ($userFromToken != null) {
            $user = User::find($userFromToken->id);
            $devices = User::find($user->id)->userdevice;
            foreach ($devices as $device) {
                if ($device->name == $request->input('device')) {

                    return $this->returnResultWithData('2', 'Device exist', '');
                }
            }
            $device = new Device(['name' => $request->input('device'), 'type' => $request->input('type')]);
            $user->userdevice()->save($device);
            return $this->returnResultWithData('1', 'Successfully', $device);
        } else {
            echo 'check token';
        }
    }

    public function pushNotifications(Request $request)
    {
        $now = Carbon::now('Asia/Saigon')->format('H:i');
        echo $now;
        $type = $request->input('type');
        if ($type == 'ios') {
            $this->pushNotificationForIos($request->input('system_token'));
        } elseif ($type == 'android') {
            $this->sendPushNotification($request->input('regis'));
        }
    }

    /*
     * IOS
     * */
    public static function pushNotificationForIos($system_token)
    {
        $payload['aps']['alert']['action-loc-key'] = (string)"View";
        $payload['aps']['alert']['body'] = 'Check out the photo of nice restaurant and food nearby you now!';
        $payload['aps']['badge'] = (int)1;
        $payload['aps']['sound'] = 'default';
        $payload['poke_id'] = '1';
        $payload = json_encode($payload);
        $apnsCert = app_path() . '/Path/ck.pem';

        $a = '49e8b167 31a82371 1313dfb5 dc3f7da8 19623845 c09ab2ac d6c41a29 93a45068';

        $streamContext = stream_context_create();
        stream_context_set_option($streamContext, 'ssl', 'local_cert', $apnsCert);

        $apns = stream_socket_client('ssl://gateway.sandbox.push.apple.com:2195', $error, $errorString, 2, STREAM_CLIENT_CONNECT, $streamContext);
        //End
        $userFromToken = DB::table('users')->where('system_token', $system_token)->first();
        $devices = User::find($userFromToken->id)->userdevice;
//        foreach ($devices as $device) {
        $apnsMessage = chr(0) . chr(0) . chr(32) . pack('H*', str_replace(' ', '', $a)) . chr(0) . chr(strlen($payload)) . $payload;
        fwrite($apns, $apnsMessage);
//        }
        if ($apns)
            echo 'Connected...';
        //close connection
        @socket_close($apns);
        @fclose($apns);
    }

    /*
     * ANDROID
     * */
//Sending Push Notification
    public function sendPushNotification($deviceRegistration)
    {
        $url = 'https://android.googleapis.com/gcm/send';
        $fields = array(
            'registration_ids' => array($deviceRegistration),
            'data' => array(
                'message' => 'Check out the photo of nice restaurant and food nearby you now!',
            ),
        );

//        define('GOOGLE_API_KEY', 'AIzaSyAY91FALyQ0giYr5EtZR4eMFNbbXNLuKrY');

        if (!defined('GOOGLE_API_KEY')) define('GOOGLE_API_KEY', 'AIzaSyAY91FALyQ0giYr5EtZR4eMFNbbXNLuKrY');

        $headers = array(
            'Authorization:key=' . GOOGLE_API_KEY,
            'Content-Type: application/json'
        );
        echo json_encode($fields);
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));

        $result = curl_exec($ch);
        if ($result === false)
            die('Curl failed ' . curl_error());

        curl_close($ch);
        return $result;
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
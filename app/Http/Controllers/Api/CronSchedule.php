<?php
/**
 * Created by PhpStorm.
 * User: hailpt
 * Date: 3/1/2016
 * Time: 11:24 AM
 */

namespace App\Http\Controllers\Api;


class CronSchedule
{

    public static function pushNotificationIos($deviceName)
    {
        $payload['aps']['alert']['action-loc-key'] = (string)"View";
        $payload['aps']['alert']['body'] = 'です！近くのお店に行ってみませんか？';
        $payload['aps']['badge'] = (int)1;
        $payload['aps']['sound'] = 'default';
        $payload['poke_id'] = '1';
        $payload = json_encode($payload);
        $apnsCert = app_path() . '/Path/ck.pem';

        $streamContext = stream_context_create();
        stream_context_set_option($streamContext, 'ssl', 'local_cert', $apnsCert);

        $apns = stream_socket_client('ssl://gateway.sandbox.push.apple.com:2195', $error, $errorString, 2, STREAM_CLIENT_CONNECT, $streamContext);
        //End
        $apnsMessage = chr(0) . chr(0) . chr(32) . pack('H*', str_replace(' ', '', $deviceName)) . chr(0) . chr(strlen($payload)) . $payload;
        fwrite($apns, $apnsMessage);
        if ($apns)
            echo 'Connected...';
        //close connection
        @socket_close($apns);
        @fclose($apns);
    }

    public static function pushNotificationAndroid($deviceRegistration)
    {

        $url = 'https://android.googleapis.com/gcm/send';
        $fields = array(
            'registration_ids' => array($deviceRegistration),
            'data' => array(
                'message' => 'です！近くのお店に行ってみませんか？',
            ),
        );
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

}
<?php
/**
 * Created by PhpStorm.
 * User: hailpt
 * Date: 2/25/2016
 * Time: 5:07 PM
 */

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Model\Media;
use App\Http\Model\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MediaApi extends Controller
{

    public function insertMediaForUser(Request $request)
    {
        $userFromToken = DB::table('users')->where('system_token', $request->input('system_token'))->first();
        $user = User::find($userFromToken->id);
        $mediaRq = (array)json_decode($request->input('media'));
        $medias = User::find($userFromToken->id)->usermedia;
        foreach($medias as $media){
            if($mediaRq['media_id']== $media->name ){
                return $this->returnResult('0','This media is in DB already !');
            }
        }
        $media = new Media(['name' => $mediaRq['media_id'], 'longitude' => $mediaRq['longitude'], 'latitude' => $mediaRq['latitude']]);
        $user->usermedia()->save($media);
        return $this->returnResultWithData('1', 'Successful', $media);
    }
    public function test(){
        $user = User::find('abc123');

        var_dump($user);
    }

    public function checkMediaExistOrNot(Request $request)
    {
        $userFromToken = DB::table('users')->where('system_token', $request->input('system_token'))->first();
        $medias = User::find($userFromToken->id)->usermedia;
        $mediaList = array();
        foreach ($medias as $media) {
            $radius = $this->getDistanceBetweenPointsNew($media->latitude, $media->longitude, $request->input('latitude'), $request->input('longitude'),"Km");
            if ($radius <= 10000) {
                $data = array(
                    'media_id'=>$media->name
                );
                $mediaList[]=$data;
            }
        }
        if($mediaList){
            return $this->returnResultWithData('1', 'Successful', $mediaList);
        } else {
            return $this->returnResultWithData('0', 'Have no media ', '');
        }
    }

    function getDistanceBetweenPointsNew($latitude1, $longitude1, $latitude2, $longitude2, $unit='Km')
    {
        $theta = $longitude1 - $longitude2;
        $distance = (sin(deg2rad((float)$latitude1)) * sin(deg2rad((float)$latitude2))) + (cos(deg2rad((float)$latitude1)) * cos(deg2rad((float)$latitude2)) * cos(deg2rad($theta)));
        $distance = acos($distance);
        $distance = rad2deg($distance);
        $distance = $distance * 60 * 1.1515;
        switch ($unit) {
            case 'Mi':
                break;
            case 'Km' :
                $distance = $distance * 1.609344*1000;
        }
        return (round($distance, 2));
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
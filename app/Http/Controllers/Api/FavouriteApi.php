<?php
/**
 * Created by PhpStorm.
 * User: hailpt
 * Date: 2/18/2016
 * Time: 11:49 AM
 */
namespace App\Http\Controllers\Api;

use App\Http\Model\User;
use App\Http\Model\UserClipped;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;

class FavouriteApi extends Controller
{

    /*
     * Convert string to array
     * Encode this array before insert into Db
     * */
    public function insertFavouriteRestaurantIntoDb(Request $request)
    {
        $googleplace = $request->input('googleplace');
        $instagram = $request->input('instagram');
        DB::table('user_clippeds')->insert(
            array('googleplace' => $googleplace, 'instagram' => $instagram, 'user_id' => 3)
        );
        $favouriteRestaurant = DB::table('user_clippeds')->where('user_id', 1)->first();
        $googleplace = (array)json_decode($favouriteRestaurant->googleplace);
        return response()->json($googleplace['id']);
    }

    public function getFavouriteRestaurantFromToken(Request $request)
    {
        $userFromToken = DB::table('users')->where('system_token', $request->input('system_token'))->first();
        if ($userFromToken != null) {
            $setting = User::find($userFromToken->id)->usersetting;
            $favouriteRestaurants = User::find($userFromToken->id)->userclipped;
            $data = array();
            foreach ($favouriteRestaurants as $favouriteRestaurant) {

                $instagramRq = (array)json_decode($favouriteRestaurant->instagram, true);
                $radius = $this->getDistanceBetweenPointsNew($instagramRq['location']['latitude'], $instagramRq['location']['longitude'], $request->input('latitude'), $request->input('longitude'),"Km");
                if($setting->favor_restaurant_around==1){
                    if($radius<=$setting->radius){
                        $media = array(
                            'googleplace' => $favouriteRestaurant->googleplace,
                            'instagram' => $favouriteRestaurant->instagram,
                        );
                        $data[] = $media;
                    }
                } else {
                    $media = array(
                        'googleplace' => $favouriteRestaurant->googleplace,
                        'instagram' => $favouriteRestaurant->instagram,
                    );
                    $data[] = $media;
                }
            }
            return $this->returnResultWithData('1','favourite restaurant list',$data);
        }
        else {
            echo 'Check token';
        }
    }

    function getDistanceBetweenPointsNew($latitude1, $longitude1, $latitude2, $longitude2, $unit='Km')
    {
        $theta = $longitude1 - $longitude2;
        $distance = (sin(deg2rad($latitude1)) * sin(deg2rad($latitude2))) + (cos(deg2rad($latitude1)) * cos(deg2rad($latitude2)) * cos(deg2rad($theta)));
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

    public function setFavouriteRestaurantForUser(Request $request)
    {
        $userFromToken = DB::table('users')->where('system_token', $request->input('system_token'))->first();
        if ($userFromToken != null) {
            $user = User::find($userFromToken->id);
            $newFavouriteRestaurant = new UserClipped(['googleplace' => $request->input('googleplace'), 'instagram' => $request->input('instagram')]);
            $user->userclipped()->save($newFavouriteRestaurant);
            return array(
                'status' => '1',
                'message' => 'Successfully !',
                'data' => $newFavouriteRestaurant
            );
        } else {
            return array(
                'status' => '0',
                'message' => 'The user does not exits in DB !',
                'data' => ''
            );
        }
    }

    public function setTestFavouriteRestaurantForUser(Request $request)
    {
        $userFromToken = DB::table('users')->where('system_token', $request->input('system_token'))->first();
        if ($userFromToken != null) {
        $favouriteRestaurants = User::find($userFromToken->id)->userclipped;
        $instagramRq = (array)json_decode($request->input('instagram'), true);
        foreach ($favouriteRestaurants as $favouriteRestaurant) {
            $instagram = (array)json_decode($favouriteRestaurant->instagram, true);
            if (strcmp($instagram['id'],$instagramRq['id']) == 0) {
                return $this->returnResult('1', 'The restaurant is checked');
            }
        }
            $user = User::find($userFromToken->id);
            $newFavouriteRestaurant = new UserClipped(['googleplace' => $request->input('googleplace'), 'instagram' => $request->input('instagram')]);
            $user->userclipped()->save($newFavouriteRestaurant);
            return array(
                'status' => '1',
                'message' => 'Successfully !',
                'data' => $newFavouriteRestaurant
            );
        } else {
            return array(
                'status' => '0',
                'message' => 'The user does not exits in DB !',
                'data' => ''
            );
        }
    }

    public function removeFavouriteRestaurant(Request $request)
    {
        $userFromToken = DB::table('users')->where('system_token', $request->input('system_token'))->first();
        if ($userFromToken != null) {
            $favouriteRestaurants = User::find($userFromToken->id)->userclipped;
            foreach ($favouriteRestaurants as $favouriteRestaurant) {
                $instagram = (array)json_decode($favouriteRestaurant->instagram);

                if (strcmp($instagram['id'],$request->input('media')) == 0) {
                    $deletedRows = UserClipped::where('id', $favouriteRestaurant->id);
                    $deletedRows->delete();
                    return $this->returnResult('1', 'Successfully !');
                }
            }
        } else {
            return $this->returnResult('0', 'The user does not exits in DB !');
        }
    }

    // Check favourite restaurant is in users or not
    public function checkFavouriteRestaurantExistOrNot(Request $request)
    {
        $userFromToken = DB::table('users')->where('system_token', $request->input('system_token'))->first();
        if ($userFromToken != null) {
            $favouriteRestaurants = User::find($userFromToken->id)->userclipped;
            foreach ($favouriteRestaurants as $favouriteRestaurant) {

                $instagram = (array)json_decode($favouriteRestaurant->instagram, true);

                    if (strcmp($instagram['id'],$request->input('media')) == 0) {
                    return $this->returnResult('1', 'The restaurant is checked');
                }
            }

            return $this->returnResult('0', 'The restaurant is not checked');
        } else {
            return array(
                'status' => '0',
                'message' => 'The user does not exits in DB !',
            );
        }
    }

    public function testCheckFavouriteRestaurantExistOrNot(Request $request)
    {
        $userFromToken = DB::table('users')->where('system_token', $request->input('system_token'))->first();
        if ($userFromToken != null) {
            $favouriteRestaurants = User::find($userFromToken->id)->userclipped;
            foreach ($favouriteRestaurants as $favouriteRestaurant) {

                $instagram = (array)json_decode($favouriteRestaurant->instagram);

                if ($request->input('media') == $instagram['id']) {

                    return $this->returnResult('1', 'The restaurant is checked');
                }
            }
            return $this->returnResult('0', 'The restaurant is not checked');
        } else {
            return array(
                'status' => '0',
                'message' => 'The user does not exits in DB !',
            );
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
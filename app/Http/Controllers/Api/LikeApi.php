<?php
/**
 * Created by PhpStorm.
 * User: hailpt
 * Date: 2/17/2016
 * Time: 10:34 AM
 */

namespace App\Http\Controllers\Api;

use Illuminate\Routing\Controller;
use Ixudra\Curl\Facades\Curl;
use Illuminate\Http\Request;

class LikeApi extends Controller
{

    public function likeMedia(Request $request)
    {


        $mediaId = $request->input('media');
        $tokenId = $request->input('system_token');

        $url = 'https://api.instagram.com/v1/media/' . $mediaId . '/likes?access_token=' . $tokenId;

        $ch = curl_init();

        // set url
        curl_setopt($ch, CURLOPT_URL, $url);

        //return the transfer as a string
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        // $output contains the output string
        $output = curl_exec($ch);

        // close curl resource to free up system resources
        curl_close($ch);

        echo $output;
    }

}
<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Model\Media;
use App\Http\Model\UserSettings;
use App\Http\Model\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    const USERNAME = 'admin';
    const PASSWORD = 'richtable';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = User::latest()->paginate(env('ITEM_PER_PAGE'));
        return view('admin.user.index', compact('categories'));
    }

    public function userSetting($id)
    {
        $user = DB::table('users')->where('id', $id)->first();
        $setting = User::find($user->id)->usersetting;
        return view('admin.user.setting.index', compact('setting'));
    }

    public function editSetting($id)
    {
        $setting = DB::table('user_settings')->where('id', $id)->first();
        return view('admin.user.setting.form', compact('setting'));
    }

    public function submitSetting($id)
    {
        DB::table('user_settings')
            ->where('id', $id)
            ->update(['push' => $_GET['push'], 'morning' => $_GET['morning'], 'noon' => $_GET['noon'],
                'evening' => $_GET['evening'], 'other' => $_GET['other'],
                'follower' => $_GET['follower'], 'following' => $_GET['following'],
                'limit' => $_GET['limit'], 'favor_restaurant_around' => $_GET['favor']]);

        $setting = DB::table('user_settings')->where('id', $id)->first();

        return view('admin.user.setting.index', compact('setting'));
    }

    public function userFavourite($id)
    {
        $user = DB::table('users')->where('id', $id)->first();
        $favors = User::find($user->id)->userclipped;
        return view('admin.user.favourite.index', compact('favors'));
    }

    public function removeFavourite($id, $userid)
    {
        $favour = DB::table('user_clippeds')->where('id', $id)->delete();
        return redirect('admin/user/' . $userid . '/favourite');
    }

    public function login()
    {
        return view('admin.user.login.index');
    }

    public function authenticate(Request $request)
    {


        if (isset($_POST['username']) && isset($_POST['password']) && $_POST['username'] != null && $_POST['password'] != null) {


            if ($_POST['username'] === 'admin' && $_POST['password'] === 'richtable') {

                return redirect('admin/user');
            } else {

                return redirect('admin/login');
            }
        }


        return view('admin.user.login.index');
    }

    public function create()
    {
        return view('admin.user.add');
    }

    public function destroy()
    {
        echo 'delete';
    }

    public function update($id, CategoryRequest $request)
    {
        echo 'update' . $id;
    }

    public function edit($id)
    {
        // echo '' . $id;
        return view('admin.user.edit.index');
    }

    public function removeUser($id)
    {
        $user = DB::table('users')->where('id', $id);

        if ($user != null) {
            $user->delete();
            return redirect('admin/user');
        } else {
            return redirect('admin/user');
        }
    }

}

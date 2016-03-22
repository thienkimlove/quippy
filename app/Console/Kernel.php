<?php

namespace App\Console;

use App\Http\Controllers\Api\CronSchedule;
use App\Http\Controllers\Api\PushNotifications;
use App\Http\Model\Device;
use App\Http\Model\User;
use Carbon\Carbon;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\DB;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        Commands\Inspire::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule $schedule
     * @return void
     */

    protected function schedule(Schedule $schedule)
    {
        $schedule->command('inspire')
            ->hourly();


//        $schedule->call(function () {
//            PushNotifications::pushNotificationForIos('abc123');
//        })->everyMinute();


//        $schedule->call(function () {
//            DB::table('users')->insert(
//                ['name' => 'john@example.com']
//            );
//        })->everyMinute();

        /** I Can not use orWhere method so I have to do this way !! **/
        $schedule->call(function () {
            $users = User::whereHas('usersetting', function ($q) {
                $q->where('morning', Carbon::now('Asia/Saigon')->format('H:i'));
            })->get();

            if (count($users) > 0) {
                $this->doPush($users);
            }
        })->everyMinute();

        $schedule->call(function () {
            $users = User::whereHas('usersetting', function ($q) {
                $q->where('noon', Carbon::now('Asia/Saigon')->format('H:i'));
            })->get();

            if (count($users) > 0) {
                $this->doPush($users);
            }
        })->everyMinute();

        $schedule->call(function () {
            $users = User::whereHas('usersetting', function ($q) {
                $q->where('evening', Carbon::now('Asia/Saigon')->format('H:i'));
            })->get();

            if (count($users) > 0) {
                $this->doPush($users);
            }
        })->everyMinute();

        $schedule->call(function () {
            $users = User::whereHas('usersetting', function ($q) {
                $q->where('other', Carbon::now('Asia/Saigon')->format('H:i'));
            })->get();

            if (count($users) > 0) {
                $this->doPush($users);
            }
        })->everyMinute();
    }

    public function doPush($users)
    {
        foreach ($users as $user) {
            $settingDb = User::find($user->id)->usersetting;
            if($settingDb->push==1){
                $devices = User::find($user->id)->userdevice;
                foreach ($devices as $device) {
                    if ($device->type == 'ios') {
                        CronSchedule::pushNotificationIos($device->name);
                    } elseif ($device->type == 'android') {
                        CronSchedule::pushNotificationAndroid($device->name);
                    }
                }
            }

        }
    }
}

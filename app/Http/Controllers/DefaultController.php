<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use Artisan;
use Config;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Storage;
use Carbon\Carbon;

class DefaultController extends Controller
{
    function backupDatabase()
    {
        //run command to take backup for mysql_db_host_list
        Artisan::call("database:backup");

        $db_host_array = Config::get('db_host_list.mysql_db_host_list');

        $status_array = [];
        //processing each host
        foreach ($db_host_array as $host => $credential) {
            //processing each db within a host
            foreach ($db_host_array[$host]['databases'] as $database) {
                $file_path = 'backups/' . $host . '/backup_' . $database . '_' . Carbon::now()->format('Y_m_d') . '.sql';
                //check if database backup exist in db and size is greater then 0
                if (Storage::exists($file_path) && Storage::size($file_path) > 0) {
                    array_push($status_array, ['status' => 'success', 'msg' => 'host:- ' . $host . ', db:- ' . $database . " backup successfully created"]);
                }else{
                    array_push($status_array, ['status' => 'danger', 'msg' => 'host:- ' . $host . ', db:- ' . $database . " backup failed"]);
                }
            }
        }

        //return status back to front
        Session::flash('status_array', $status_array);
        return redirect()->back();
    }
}

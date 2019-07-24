<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Carbon\Carbon;
use Storage;
use Config;

class BackupDatabase extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'database:backup';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'All database backup';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();       
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        //database array with username and passowrd
        $db_host_array = Config::get('db_host_list.mysql_db_host_list');

        //create backups dir if not exist
        if(!Storage::exists('backups')) {
            Storage::makeDirectory('backups', 0775, true); //creates directory
        }

        //processing each host
        foreach ($db_host_array as $host => $credential) {
            //create directory for host if not exist
            if(!Storage::exists('backups/' . $host)) {
                Storage::makeDirectory('backups/' . $host, 0775, true); //creates directory
            }

            //process for each database within a host
            foreach ($db_host_array[$host]['databases'] as $database) {
                $this->process = new Process(sprintf(
                    'mysqldump -h%s -u%s -p%s %s > %s',
                    $host,
                    $credential['username'],
                    $credential['password'],
                    $database,
                    storage_path('app/backups/' . $host . '/backup_' . $database . '_' . Carbon::now()->format('Y_m_d') . '.sql')
                )); 

                try {
                    //run process
                    $this->process->mustRun();

                    $this->info('The backup has been proceed successfully.');
                } catch (ProcessFailedException $exception) {
                    $this->error('The backup process has been failed.');
                }
            }
        }
    }
}

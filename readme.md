# Database Backup Application

 This Application is built in Laravel (version- 5.6). It basically contain a view, a controller, a scheduler and a config file.

# System Requirement
1) PHP Web Server (Apache2)
2) PHP (7.2 and above)
3) Laravel Framework (5.6 and above)
4) MySQL (5.6 and above)	


# Set up Project

#### Clone Application

Open your command line or terminal and enter the directory where you would like to 	copy the repository and type the following command
`git clone https://github.com/ashish-singh-bist/database_backup.git`

This will create a directory name 'database_backup'
Navigate into the directory through the terminal (command prompt).

After cloning the application you need to install the required packages to run the application. For that you need to run the following command.
`composer install	`
This will install all the required packages for laravel application.

check the laravel version install on your system, type the command
`php artisan --version`

Now you need to set Laravel config file "env" in the root folder of your application.
copy the .env.example file from root folder of the application and save it as .env

The next thing you need to do is to set up the application key for your application.
you have to type the following command in the terminal,
`php artisan key:generate`

This will create the application key.

## Set-up Config

You have to configure the database list in the application. Navigate to the Config folder.

Rename the db_host_list.example.php file into db_host_list.php.

open db_host_list.php file.
```
'mysql_db_host_list' => [
	'localhost' => [
		'database' => ['#database_name'],
		'username' => '#username',
		'password => '#password'
		]
	]
	

```
Replace #database_name, #username and #password with your database_name, Username and Password.
Also you can set-up multiple host in the db_host_list.php file to take backup.


# Files
1) Controller
 DefaultController.php
2) View
 welcome.blade.php
3) config file
 db_host_list.php (path => ''/config/)
4) Scheduler
  BackupDatabase.php (path => '/app/Console/Commands')


## Functionality

you need to type the following command on the terminal to start the server

`php artisan serve`

Now open 'http://localhost:8000' in the browser.      

when you click "Backup Database" button, it will create  all the database backup which you have mention in the db_host_list.php file and save them in the following path.
path "database_backup/storage/app/backups".

## Schedule Database Backup

You need to create a cron for scheduling the database backup.

 `* * * * *  php /path-to-your-project/artisan schedule:run >> /dev/null 2>&1`

also you can manually run the scheduler by using the following command
`php artisan schedule:run`

The database scheduler will run once a day.

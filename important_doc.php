/*
*
<!-- laravel install -->
composer create-project laravel/laravel your-project-name version
composer global require laravel/installer
laravel new example-app

<!-- set database -->
<!-- add ui in laravel  -->
composer require laravel/ui

php artisan ui:auth

php artisan ui:controllers

php artisan ui bootstrap

npm install
npm run development





php artisan migrate

<!-- yajra datatable  -->

composer require yajra/laravel-datatables

<!-- config/app.php  -->
'providers' => [
    ...,
    Yajra\DataTables\DataTablesServiceProvider::class,
]
'aliases' => [
    ...,
    'DataTables' => Yajra\DataTables\Facades\DataTables::class,
]
php artisan vendor:publish --provider="Yajra\DataTables\DataTablesServiceProvider"

php artisan datatables:make nameOfController
php artisan datatables:make Posts --model-namespace="Models\Client"
php artisan datatables:make Post --model="App\Models\Post"
<!-- after link asset  datatable -->

<!-- laravel-debugbar -->
composer require barryvdh/laravel-debugbar --dev
DEBUGBAR_ENABLED=false # deguger is disabled but error reporting works
<!-- if remove -->
composer remove vendor/barryvdh/laravel-debugbar
composer update

<!-- laravel-telescope -->
composer require laravel/telescope
php artisan telescope:install
php artisan migrate
next see docs
App\Providers\AppServiceProvider update
composer.json update

'password' =>['required','string','confirmed',
                Password::min(8)->letters()->numbers()->mixedCase()->symbols()]

https://github.com/spatie/laravel-permission

https://github.com/Wulfheart/pretty-routes
composer require wulfheart/pretty_routes
php artisan route:pretty
php artisan route:pretty --except-path=horizon --method=POST --reverse
php artisan route:pretty --only-path=app --method=POST --reverse
php artisan route:pretty --only-name=app --method=POST
php artisan route:pretty --only-name=app --method=POST --group=path --reverse-group
php artisan route:pretty --only-name=app,horizon,debugbar --except-path=foo,bar --group=name --reverse


https://github.com/andreaselia/laravel-api-to-postman
composer require andreaselia/laravel-api-to-postman
php artisan vendor:publish --provider="AndreasElia\PostmanGenerator\PostmanGeneratorServiceProvider" --tag="postman-config"
php artisan export:postman
php artisan export:postman --bearer="1|XXNKXXqJjfzG8XXSvXX1Q4pxxnkXmp8tT8TXXKXX"
php artisan export:postman --bearer=123456789


https://github.com/spatie/laravel-mail-preview
composer require spatie/laravel-mail-preview

// in config/mail.php

'mailers' => [
    'smtp' => [
        'transport' => 'preview',
        // ...
    ],
    // ...
],

https://github.com/bennett-treptow/laravel-migration-generator
https://github.com/mattkingshott/axiom
https://github.com/diglactic/laravel-breadcrumbs

https://github.com/nascent-africa/jetstrap
https://github.com/michaeldyrynda/laravel-cascade-soft-deletes
composer require dyrynda/laravel-cascade-soft-deletes
/// fake-disposable mail validation
https://github.com/Propaganistas/Laravel-Disposable-Email

https://github.com/anhskohbo/no-captcha
https://github.com/mewebstudio/captcha

https://github.com/spatie/laravel-activitylog

https://drawsql.app/templates  /// for sql table

php artisan vendor:publish
after press 0
https://blog.quickadminpanel.com/ ///laravel resource site
<!-- https://wampserver.aviatechno.net/ -->

https://www.cloudways.com/blog/best-laravel-packages/

install breeze
 composer require laravel/breeze --dev

  php artisan breeze:install
  npm install
  npm run development

php artisan migrate

https://learninglaravel.net/cheatsheet/


// Added in 5.1.11:http://laravel.com/docs/authorization#creating-policies
php artisan make:policy PostPolicy
// Displays help for a given command
php artisan --help OR -h
// Do not output any message
php artisan --quiet OR -q
// Display this application version
php artisan --version OR -V
// Do not ask any interactive question
php artisan --no-interaction OR -n
// Force ANSI output
php artisan --ansi
// Disable ANSI output
php artisan --no-ansi
// The environment the command should run under
php artisan --env
// -v|vv|vvv Increase the verbosity of messages: 1 for normal output, 2 for more verbose output and 3 for debug
php artisan --verbose
// Remove the compiled class file
php artisan clear-compiled
// Display the current framework environment
php artisan env
// Displays help for a command
php artisan help
// Lists commands
php artisan list
// Interact with your application
php artisan tinker
// Put the application into maintenance mode
php artisan down
// Bring the application out of maintenance mode
php artisan up
// Optimize the framework for better performance
// --force    Force the compiled class file to be written.
// --psr      Do not optimize Composer dump-autoload.
php artisan optimize [--force] [--psr]
// Serve the application on the PHP development server
php artisan serve
// Change the default port
php artisan serve --port 8080
// Get it to work outside localhost
php artisan serve --host 0.0.0.0
// Set the application namespace
php artisan app:name namespace
// Flush expired password reset tokens
php artisan auth:clear-resets
// Flush the application cache
php artisan cache:clear
// Create a migration for the cache database table
php artisan cache:table
// Create a cache file for faster configuration loading
php artisan config:cache
// Remove the configuration cache file
php artisan config:clear
// In program
$exitCode = Artisan::call('config:cache');
// Seed the database with records
// --class      The class name of the root seeder (default: "DatabaseSeeder")
// --database   The database connection to seed
// --force      Force the operation to run when in production.
php artisan db:seed [--class[="..."]] [--database[="..."]] [--force]

// Generate the missing events and handlers based on registration
php artisan event:generate

// Create a new command handler class
// --command      The command class the handler handles.
php artisan handler:command [--command="..."] name
// Create a new event handler class
// --event        The event class the handler handles.
// --queued       Indicates the event handler should be queued.
php artisan handler:event [--event="..."] [--queued] name

// Set the application key
php artisan key:generate

// By default, this creates a self-handling command that isn't pushed to the queue.
// Pass this the --handler flag to generate a handler, and the --queued flag to make it queued.
php artisan make:command [--handler] [--queued] name
// Create a new Artisan command
//  --command     The terminal command that should be assigned. (default: "command:name")
make:console [--command[="..."]] name
// Create a new resourceful controller
// --plain      Generate an empty controller class.
php artisan make:controller [--plain] name
php artisan make:controller App\\Admin\\Http\\Controllers\\DashboardController
// Create a new event class
php artisan make:event name
// Create a new middleware class
php artisan make:middleware name
// Create a new migration file
// --create     The table to be created.
// --table      The table to migrate.
php artisan make:migration [--create[="..."]] [--table[="..."]] name
// Create a new Eloquent model class
php artisan make:model name
// Create a new service provider class
php artisan make:provider name
// Create a new form request class
php artisan make:request name
// Database migrations
// --database   The database connection to use.
// --force      Force the operation to run when in production.
// --path       The path of migrations files to be executed.
// --pretend    Dump the SQL queries that would be run.
// --seed       Indicates if the seed task should be re-run.
php artisan migrate [--database[="..."]] [--force] [--path[="..."]] [--pretend] [--seed]
// Create the migration repository
php artisan migrate:install [--database[="..."]]
// Create a new migration file
// --seeder     The class name of the root seeder.
php artisan migrate:refresh [--database[="..."]] [--force] [--seed] [--seeder[="..."]]
// Rollback all database migrations
// --pretend    Dump the SQL queries that would be run.
php artisan migrate:reset [--database[="..."]] [--force] [--pretend]
// Rollback the last database migration
php artisan migrate:rollback [--database[="..."]] [--force] [--pretend]
// Show a list of migrations up/down
php artisan migrate:status
// Create a migration for the queue jobs database table
php artisan queue:table
// Listen to a given queue
// --queue      The queue to listen on
// --delay      Amount of time to delay failed jobs (default: 0)
// --memory     The memory limit in megabytes (default: 128)
// --timeout    Seconds a job may run before timing out (default: 60)
// --sleep      Seconds to wait before checking queue for jobs (default: 3)
// --tries      Number of times to attempt a job before logging it failed (default: 0)
php artisan queue:listen [--queue[="..."]] [--delay[="..."]] [--memory[="..."]] [--timeout[="..."]] [--sleep[="..."]] [--tries[="..."]] [connection]
// List all of the failed queue jobs
php artisan queue:failed
// Create a migration for the failed queue jobs database table
php artisan queue:failed-table
// Flush all of the failed queue jobs
php artisan queue:flush
// Delete a failed queue job
php artisan queue:forget
// Restart queue worker daemons after their current job
php artisan queue:restart
// Retry a failed queue job(id: The ID of the failed job)
php artisan queue:retry id
// Subscribe a URL to an Iron.io push queue
// queue: The name of Iron.io queue.
// url: The URL to be subscribed.
// --type       The push type for the queue.
php artisan queue:subscribe [--type[="..."]] queue url
// Process the next job on a queue
// --queue      The queue to listen on
// --daemon     Run the worker in daemon mode
// --delay      Amount of time to delay failed jobs (default: 0)
// --force      Force the worker to run even in maintenance mode
// --memory     The memory limit in megabytes (default: 128)
// --sleep      Number of seconds to sleep when no job is available (default: 3)
// --tries      Number of times to attempt a job before logging it failed (default: 0)
php artisan queue:work [--queue[="..."]] [--daemon] [--delay[="..."]] [--force] [--memory[="..."]] [--sleep[="..."]] [--tries[="..."]] [connection]

// Create a route cache file for faster route registration
php artisan route:cache
// Remove the route cache file
php artisan route:clear
// List all registered routes
php artisan route:list

// Run the scheduled commands
php artisan schedule:run

// Create a migration for the session database table
php artisan session:table

// Publish any publishable assets from vendor packages
// --force        Overwrite any existing files.
// --provider     The service provider that has assets you want to publish.
// --tag          The tag that has assets you want to publish.
php artisan vendor:publish [--force] [--provider[="..."]] [--tag[="..."]]
php artisan tail [--path[="..."]] [--lines[="..."]] [connection]


payment gatway
https://test.instamojo.com/

composer require maatwebsite/excel
https://github.com/Maatwebsite/Laravel-Excel

*/

<?php
require 'vendor/autoload.php';

$f3 = \Base::instance();

// $f3->route('GET /',
//     function() {
//         echo 'Hello, world!';
//     }
// );

$f3->set('CORS.origin', '*');

date_default_timezone_set("Africa/Johannesburg");

$f3->config('Application/config/routes/routes.ini');

$f3->config('Application/config/environment.ini');

if($f3->get('env') == "dev") {
    $f3->config('Application/config/dev/setup.ini');
    $f3->config('Application/config/dev/mysql.ini');
}

if($f3->get('env') == "prod"){
    $f3->config('Application/config/prod/setup.ini');
    $f3->config('Application/config/prod/mysql.ini');
}
$f3->run();
?>
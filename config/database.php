<?php
header('Content-Type: application/json');
date_default_timezone_set('America/La_Paz');
use Illuminate\Database\Capsule\Manager as Capsule;
$capsule = new Capsule();
$capsule->addConnection([
    'driver' => 'mysql',
    'database' => 'esgapi',
    'username' => 'esgapi',
    'password' => '965933',
    'charset' => 'utf8',
    'port' => '3306',
    'host' => '127.0.0.1',
    'collation' => 'utf8_unicode_ci',
    'prefix'    => '',
    //'unix_socket' => '/Applications/MAMP/tmp/mysql/mysql.sock'
]);

$capsule->setAsGlobal();
$capsule->bootEloquent();
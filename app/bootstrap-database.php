<?php
require __DIR__ . '/vendor/autoload.php';

use Illuminate\Database\Capsule\Manager as Capsule;

$capsule = new Capsule;

$capsule->addConnection([
   "driver" => "pgsql",
   "host" =>"db",
   "database" => "laravel",
   "username" => "postgres",
   "password" => "postgres_root_password"
]);

$capsule->setAsGlobal();

$capsule->bootEloquent();
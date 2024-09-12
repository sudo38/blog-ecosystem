<?php
ob_start();

$helpers_dir = __DIR__.'/helpers';
$helpers = scandir($helpers_dir);

foreach ($helpers as $helper) {
   if (!in_array($helper, ['.', '..'])) {
         include $helpers_dir."/$helper";
   }
}

session_save_path(config('session.session_save_path'));
ini_set('session.gc_probability', 1);
session_start(['cookie_lifetime' => config('session.delay_timeout')]);

$database = config('connect.database');

try {
   $database->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
   // echo 'Connected successfully';
   
} catch (Exception $e) {
   echo 'Connection failed: ' . $e->getMessage();
}

require_once base_path('/routes/web.php');
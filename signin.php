<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require 'vendor/autoload.php';
$config = ['host' => '127.0.0.1', 'port' => 9308];

$client = new \Manticoresearch\Client($config);

include("settings.php");

header("Location: " .  $signin_url  );


?>
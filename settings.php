<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require 'vendor/autoload.php';
$config = ['host' => '127.0.0.1', 'port' => 9308];
$client = new \Manticoresearch\Client($config);


$redirect_url = "https://marketplace.tube/home";
$signin_url = "https://tubie.casdoor.com/login/oauth/authorize?client_id=5ba66fc84fa1946c9b55&response_type=code&redirect_uri=https://marketplace.tube/auth&scope=read,profile&state=casdoor";
$signout_url = "https://tubie.casdoor.com/logout/oauth/authorize?client_id=5ba66fc84fa1946c9b55&state=casdoor";
//$signout_url = "https://tubie.casdoor.com/api/logout";

$create_channel_url = "https://my.audition.tube/";
$master = "marketplace";
$users_index = "my_marketplace_tube_users";
$watch_later_index = "my_marketplace_tube_watch_later";
$liked_index = "my_marketplace_tube_liked";
$subscriptions_index = "my_marketplace_tube_subscriptions";
$views_index = "my_marketplace_tube_views";
$recommended_index = "my_marketplace_tube_recommended";
$saved_index = "my_marketplace_tube_saved";
$channels_index = "channels";
$message_index = "my_marketplace_tube_messages";
$message_dir = "/var/www/html/api/tmp/";


function timeFormat($duration)
{
  $formattedDuration = gmdate('H:i:s', $duration);
  $hour = substr($formattedDuration, 0, 3);
  if ($hour == "00:") {
    $formattedDuration = substr($formattedDuration, 3);
  }
  return $formattedDuration;
}

if (isset($_COOKIE['user'])) {
  $uid = $_COOKIE['user'];
} else {
  $uid = "0";
}




?>
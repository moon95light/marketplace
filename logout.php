<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require 'vendor/autoload.php';
$config = ['host' => '127.0.0.1', 'port' => 9308];

$client = new \Manticoresearch\Client($config);

include("settings.php");
// $cURLConnection = curl_init($signout_url);
// curl_setopt($cURLConnection, CURLOPT_RETURNTRANSFER, true);
// $apiResponse = curl_exec($cURLConnection);
// curl_close($cURLConnection);
// $curl = json_decode($apiResponse, true);
// print_r($curl);

// $user_id_curl = curl_init($signin_url);
// curl_setopt($user_id_curl, CURLOPT_RETURNTRANSFER, true);
// $user_info_response = curl_exec($user_id_curl);
// header("Location: " . $signin_url);

if (isset($_COOKIE['user'])) {
    setcookie("user", '', 1);
    setcookie("user", '', 1, '/');

    unset($_COOKIE['user']);
    $response1 = file_get_contents($signout_url);
    $data1 = json_decode($response1, true);

    if ($data1["status"] == "ok") {
        header("Location: " . $signin_url);
    }

} else {
    header("Location: " . $signin_url);
}

?>
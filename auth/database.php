<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require '/var/www/html/vendor/autoload.php';
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

echo "<pre>";


// 1. GET ACCESS TOKEN

$req['grant_type'] = 'authorization_code';
$req['client_id'] = '5ba66fc84fa1946c9b55';
$req['client_secret'] = 'a09ae018e9b562b7add5af8230d7921161fa853e';
$req['code'] = trim($_GET['code']);
//print_r( $req );
$cURLConnection = curl_init('https://tubie.casdoor.com/api/login/oauth/access_token');
curl_setopt($cURLConnection, CURLOPT_POSTFIELDS, $req);
curl_setopt($cURLConnection, CURLOPT_RETURNTRANSFER, true);
$apiResponse = curl_exec($cURLConnection);
curl_close($cURLConnection);
$curl = json_decode($apiResponse, true);
//print_r( $curl );
//echo $curl["access_token"];

// 2. GET UDER ID 

$user_id_curl = curl_init('https://tubie.casdoor.com/api/userinfo');
curl_setopt($user_id_curl, CURLOPT_HTTPHEADER, ['Authorization: Bearer ' . $curl["access_token"],]);
curl_setopt($user_id_curl, CURLOPT_RETURNTRANSFER, true);
$user_info_response = curl_exec($user_id_curl);
if ($user_info_response === false) {
    die('Error: ' . curl_error($user_id_curl));
}
$user_info_response = json_decode($user_info_response, true);
$userId = trim((string) $user_info_response["preferred_username"]);
//print_r($user_info_response);
//echo $userId;
//echo "\n";
// print_r("*************************************** => userID");
print_r($userId);

$data = array(
    'id' => "built-in/$userId",
    'clientId' => $req['client_id'],
    'clientSecret' => $req['client_secret']
);
// print_r("/////////////////////////////////////////////=> data");
// print_r($data);
// 3. GET USER INFO

$url = "https://tubie.casdoor.com/api/get-user?" . http_build_query($data);
//echo "\n";
//echo $url;
//echo "\n";  
$curl = curl_init($url);
curl_setopt($curl, CURLOPT_URL, $url);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

$resp = curl_exec($curl);
curl_close($curl);
echo $resp;
$user = json_decode($resp, true);
print_r($user);

// print_r("----------------------------------------- => data");
// print_r($user["data"]["id"]);

// 4. UPSERT USER INFO INTO POSTGRESQL  

// Database connection details


$host = "host = postgresql-154883-0.cloudclusters.net";
$port = "port = 19815";
$dbname = "dbname = marketplace";
$credentials = "user = root password=E3kSs77s1Npem0bR";

$db = pg_connect("$host $port $dbname $credentials");
if (!$db) {
    echo "Error : Unable to open database\n";
} else {
    echo "Opened database successfully\n";
}

$id = 123;
$jsonData = json_encode(["name" => "Mykhailo", "email" => "johndoe@.com"]);

$upsertQuery = "INSERT INTO users (id, info)
                VALUES ($id, '$jsonData')
                ON CONFLICT (id) DO UPDATE SET info = excluded.info";
$result = pg_query($db, $upsertQuery);

if ($result) {
    echo "Data upserted successfully.\n";
} else {
    echo "Error: Failed to upsert data.\n";
}

pg_close($db);

echo 200;
?>
<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require '/var/www/html/vendor/autoload.php';
use Firebase\JWT\JWT;
use Firebase\JWT\Key;


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
$userId = "85";
$mycasdoorId = "sd788-54e4-6465s-df5e55";
// INSERT jsonb data 
$query = "INSERT INTO subscriptions (id, info)
    VALUES ('$mycasdoorId', '[]')
    ON CONFLICT (id) DO UPDATE
    SET info = CASE 
                WHEN subscriptions.info @> JSONB_BUILD_ARRAY('$userId') 
                THEN subscriptions.info 
                ELSE subscriptions.info || JSONB_BUILD_ARRAY('$userId')
              END
    WHERE subscriptions.id = '$mycasdoorId'
    RETURNING *;
";


//delete jsonb data
// $query = "UPDATE subscriptions
// SET info = info - '$userId'
// WHERE subscriptions.id = '$mycasdoorId';";

// $result = pg_query($db, $query);




if ($result) {
    echo "Data upserted successfully.\n";
} else {
    echo "Error: Failed to upsert data.\n";
}


pg_close($db);

// echo 200;
?>
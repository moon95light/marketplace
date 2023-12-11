<?php
// require  __DIR__ . '/sanitization.php';

$message = $_POST['data'];

echo $message;

$response = "success";

/**
 * Connection PostgreSQL
 */
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

/**
 *@  INSERT jsonb data  
 * */ 
$message1 = json_encode($message);
$i = 3;
$query = "INSERT INTO messages (id, info) VALUES ('$i', '$message1')";

$result = pg_query($db, $query);
if ($result) {
    echo "Data upserted successfully.\n";
} else {
    echo "Error: Failed to upsert data.\n";
}
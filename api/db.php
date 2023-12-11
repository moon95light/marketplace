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
// $query = "ALTER TABLE subscriptions ADD CONSTRAINT unique_user_channel_constraint UNIQUE (userid, channelid)";
$query = "ALTER TABLE liked ADD CONSTRAINT unique_user_video_constraint UNIQUE (userid, videoid)";

// pg_query($db, $createConstraintQuery);
// $query = "CREATE TABLE messages (
//     id  SERIAL PRIMARY KEY,
//     userid VARCHAR(255),
//     videoid INTEGER,
//     channelid VARCHAR(255),
//     message VARCHAR(255),
//     created_at TIMESTAMP
//   );";

// $query = "CREATE TABLE subscriptions (
//     id SERIAL PRIMARY KEY,
//     userid VARCHAR(255) ,
//     channelid VARCHAR(255) ,
//     created_at TIMESTAMP
// );";
// $query = "CREATE TABLE playlists (
//     id SERIAL PRIMARY KEY,
//     userid VARCHAR(255) ,
//     videoid INTEGER UNIQUE,
//     channelid VARCHAR(255) ,
//     later VARCHAR(255),
//     created_at TIMESTAMP
// );";

// $result = pg_query($db, $query);

// $query = "CREATE TABLE liked (
//     id SERIAL PRIMARY KEY,
//     userid VARCHAR(255) ,
//     videoid INTEGER ,
//     channelid VARCHAR(255),
//     thumb VARCHAR(255),
//     created_at TIMESTAMP
// );";

// $query = "DROP TABLE subscriptions";

$result = pg_query($db, $query);


if ($result) {
    echo "Data upserted successfully.\n";
} else {
    echo "Error: Failed to upsert data.\n";
}
if (!$result) {
    // Get the error message
    $errorMessage = pg_last_error($db);

    // Output or handle the error message
    echo "Error with query: $errorMessage";
}
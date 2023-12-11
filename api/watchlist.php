<?php
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);
// require '/var/www/html/vendor/autoload.php';
// use Firebase\JWT\JWT;
// use Firebase\JWT\Key;


// $host = "host = postgresql-154883-0.cloudclusters.net";
// $port = "port = 19815";
// $dbname = "dbname = marketplace";
// $credentials = "user = root password=E3kSs77s1Npem0bR";

// $db = pg_connect("$host $port $dbname $credentials");
// if (!$db) {
//     echo "Error : Unable to open database\n";
// } else {
//     echo "Opened database successfully\n";
// }
// $channel_id = $_POST['channelid'];
// $video_id = $_POST['videoid'];
// $later = $_POST['later'];
// $mycasdoorId = $_COOKIE['user'];

// $query = "INSERT INTO playlists (userid, videoid, channelid, later, created_at)
// VALUES ('$mycasdoorId', '$video_id', '$channel_id', '$later', CURRENT_TIMESTAMP)
// ON CONFLICT (videoid) 
// DO UPDATE SET later = EXCLUDED.later, created_at = CURRENT_TIMESTAMP";

// $result = pg_query($db, $query);

// if ($result) {
//     echo "Data upserted successfully.\n";
// } else {
//     echo "Error: Failed to upsert data.\n";
// }


// pg_close($db);

// echo 200;

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require '../vendor/autoload.php';
 

$config = ['host' => '127.0.0.1', 'port' => 9308];
$client = new \Manticoresearch\Client($config);


echo "<pre>";
$save = 0;
$uid = $_COOKIE['user'];
$video = (int) $_POST['videoid'];
$saved = [];

$index = $client->index('my_marketplace_tube_saved');
$results = $index->search('*')->match('@uid' . $uid)->limit(1)->get();



foreach ($results as $doc) {
print_r( $doc );


    $id = $doc->getId();
     $saved = $doc->videos; 
   
}
print_r($saved); 

if ($save) {
 echo "add\n";
array_unshift($saved, (int) $video); 
} else {
      echo "remove\n";


foreach ($saved as $key => $value ) {
    if ( $value == $video  ) { unset($saved[$key]);   }
}


}

 
$saved = array_values($saved);
$saved = array_unique($saved);
print_r($saved);
//exit;

//print_r($saved);

 if ( isset($id) ) {
    echo "$id\n";
    echo "upsert\n";
    $doc = $index->replaceDocument([
    'uid' => (string) $uid,
    'videos' => json_encode($saved)     
    ], (int) $id );           
    print_r($doc);
} else {
    echo "add\n";
    $index->addDocuments([['uid' => (string) $uid, 'videos' => json_encode($saved) ]]);
}


exit;

?>
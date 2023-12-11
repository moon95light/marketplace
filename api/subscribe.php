<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require '../vendor/autoload.php';
 

$config = ['host' => '127.0.0.1', 'port' => 9308];
$client = new \Manticoresearch\Client($config);


//$_POST['action'] = "add";
//$_POST['ownerid'] = 7;

echo "<pre>";
// $subscribe = 0;
$uid = $_COOKIE['user'];

$subscriptions = [];

$action = trim($_POST['action']);
$channel = (int) $_POST['ownerid'];
$channels = [];
$index = $client->index('my_marketplace_tube_subscriptions');
$doc = $index->getDocumentById($uid);
print_r($doc);


if ( isset( $doc->channels  )  ) {
    $channels = $doc->channels;
    foreach ($channels as $key => $value ) {
        if ( $value == $channel  ) { 
            unset($channels[$key]);   
        }
    }     
}

print_r($channels); 

if (  $action == "add" ) {
    echo "add\n";
    array_push($channels, (int) $channel); 
}
//$channels = array_values($channels);
print_r($channels); 

    $doc = $index->replaceDocument([
    'uid' => (string) $uid,
    'channels' => json_encode($channels)     
    ], (int) $uid ); 
    
print_r($doc);
    
    
?>
<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require '../vendor/autoload.php';
 

$config = ['host' => '127.0.0.1', 'port' => 9308];
$client = new \Manticoresearch\Client($config);

if (isset($_COOKIE["user"])) {
    $cookieflag = 1;
} else {  exit; } 


//$_COOKIE["user"] = "jason";
//$_POST['action'] = "add";
//$_POST['videoid'] = 45;

$action = trim($_POST['action']);

echo "<pre>";
$uid = (string) $_COOKIE['user'];
$video = (int) $_POST['videoid'];
$video = (int) $_POST['videoid'];
$videos = [];
$index = $client->index('my_marketplace_tube_saved');
$doc = $index->getDocumentById($uid);
if ( isset( $doc->videos  )  ) {
    $videos = $doc->videos;
    foreach ($videos as $key => $value ) {
        if ( $value == $video  ) { 
            unset($videos[$key]);   
        }
    }     
}


if (  $action == "add" ) {
    echo "add\n";
    array_push($videos, (int) $video); 
}
$videos = array_values($videos);
print_r($videos); 

    $doc = $index->replaceDocument([
    'uid' => (string) $uid,
    'videos' => json_encode($videos)     
    ], (int) $uid ); 

?>
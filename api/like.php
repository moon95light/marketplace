<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require '../vendor/autoload.php';
 $config = ['host' => '127.0.0.1', 'port' => 9308];
$client = new \Manticoresearch\Client($config);

//$_COOKIE["user"] = "jason";
//$_POST['liked'] = false;
//$_POST['videoid'] = 87;
 
echo "<pre>";

//$cid = "03d3787a-f761-4355-8528-acfbdc45f3d2";
//$rid = $unpack = unpack('I*', $cid)[1];
//$nid = preg_replace("/[^0-9]/", "", $cid );
//$uid = (int) "$rid$nid";
//echo $uid;
//print_r($_COOKIE);
//exit;

if (isset($_COOKIE["user"])) {
    $cookieflag = 1;
} else {  exit; } 

//$_POST['videoid'] = 138;
//$_POST['action'] = "add";

$action = trim($_POST['action']);


 

//echo "<pre>";

$uid = (int) $_COOKIE['uid'];
$video = (int) $_POST['videoid'];
$videos = [];
$index = $client->index('my_marketplace_tube_liked');
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


//print_r($doc);
 
// RECOMMENDED

$id = (int) $video;
if (  $action == "add"   ) { $count = (int) 1;  } else { $count = (int) -1;  }
$index = $client->index('my_marketplace_tube_recommended');    
$doc = $index->getDocumentById($id);
if ( isset($doc->total)  ) {
    $likes = (int) $doc->total + (int) $count;
} else {
$likes = $count;
}
$index->replaceDocument([ 'total' => (int) $likes ], (int) $id ); 
echo $likes;

?>
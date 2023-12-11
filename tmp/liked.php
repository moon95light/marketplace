<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require '../vendor/autoload.php';
 

$config = ['host' => '127.0.0.1', 'port' => 9308];
$client = new \Manticoresearch\Client($config);


echo "<pre>";
$like = 0;
$uid = "03d3787a-f761-4355-8528-acfbdc45f3d2";
$video = (int) 52;
$liked = [];

$index = $client->index('my_marketplace_tube_liked');
$results = $index->search('*')->match('@uid' . $uid)->limit(1)->get();



foreach ($results as $doc) {
print_r( $doc );


    $id = $doc->getId();
     $liked = $doc->videos; 
   
}
print_r( "--------------" );
print_r($liked); 

if ($like) {
 echo "add\n";
array_unshift($liked, (int) $video); 
} else {
      echo "remove\n";


foreach ($liked as $key => $value ) {
    if ( $value == $video  ) { 
        unset($liked[$key]);   
    }
}

 

}

 
$liked = array_values($liked);
$liked = array_unique($liked);

print_r("**********");
print_r($liked);
//exit;



 


//print_r($liked);

 


if ( isset($id) ) {
    echo "$id\n";
    echo "upsert\n";
    $doc = $index->replaceDocument([
    'uid' => (string) $uid,
    'videos' => json_encode($liked)     
    ], (int) $id );           
    print_r($doc);
} else {
    echo "add\n";
    $index->addDocuments([['uid' => (string) $uid, 'videos' => json_encode($liked) ]]);
}


exit;

?>
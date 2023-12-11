<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require '../vendor/autoload.php';
 

$config = ['host' => '127.0.0.1', 'port' => 9308];
$client = new \Manticoresearch\Client($config);


echo "<pre>";
$save = 0;
$uid = "03d3787a-f761-4355-8528-acfbdc45f3d2";
$video = (int) 55;
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
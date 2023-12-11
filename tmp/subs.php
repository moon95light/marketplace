<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require '../vendor/autoload.php';
 

$config = ['host' => '127.0.0.1', 'port' => 9308];
$client = new \Manticoresearch\Client($config);


echo "<pre>";
$subscribe = 0;
$uid = "03d3787a-f761-4355-8528-acfbdc45f3d2";
$channel = (int) 33;
$subscriptions = [];

$index = $client->index('my_marketplace_tube_subscriptions');
$results = $index->search('*')->match('@uid' . $uid)->limit(1)->get();



foreach ($results as $doc) {
//print_r( $doc );


    $id = $doc->getId();
     $subscriptions = $doc->channel; 
   
}
//print_r($subscriptions); 

if ($subscribe) {
 echo "add\n";
array_unshift($subscriptions, (int) $channel); 
} else {
      echo "remove\n";


foreach ($subscriptions as $key => $value ) {
    if ( $value == $channel  ) { unset($subscriptions[$key]);   }
}

    //if ( $key = array_search( (int) $channel,  $subscriptions ) !== false ) {
    //$key = array_search( (int) $channel,  $subscriptions );
   // echo $key . "\n";
    
    //unset($subscriptions[$key]);
    //$subscriptions = array_values($subscriptions);    
    //}

}

//$subscriptions = array_filter($subscriptions, function ( $element) use ($channel) { return intval( ($element != (int) $channel)) ;}); 
//$subscriptions = array_map('intval', $subscriptions );

$subscriptions = array_values($subscriptions);
$subscriptions = array_unique($subscriptions);
//print_r($subscriptions);
//exit;



 


//print_r($subscriptions);

 


if ( isset($id) ) {
    echo "$id\n";
    echo "upsert\n";
    $doc = $index->replaceDocument([
    'uid' => (string) $uid,
    'channel' => json_encode($subscriptions)     
    ], (int) $id );           
    print_r($doc);
} else {
    echo "add\n";
    $index->addDocuments([['uid' => (string) $uid, 'channel' => json_encode($subscriptions) ]]);
}


exit;

?>
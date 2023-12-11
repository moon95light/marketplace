<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require '../vendor/autoload.php';
 

$config = ['host' => '127.0.0.1', 'port' => 9308];
$client = new \Manticoresearch\Client($config);



$id = (int) 95;
$liked = true;
if ( $liked == false ) { $count = (int) -1;  } else { $count = (int) 1; }
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
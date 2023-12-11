<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require '../vendor/autoload.php';
 

$config = ['host' => '127.0.0.1', 'port' => 9308];
$client = new \Manticoresearch\Client($config);

echo "<pre>";
 
 

$id = (int) 95;
$index = $client->index('my_marketplace_tube_trending');    
$doc = $index->getDocumentById($id);
print_r($doc);

if ( isset($doc->total)  ) {
    $total = (int) $doc->total + (int) 1;
    $trending  = (int) time() + (int) $total;
} else {
    $total = (int) 1;
    $trending = (int) time();
}
echo 222;
  
$res = $index->replaceDocument([ 'total' => (int) $total, 'trending' => (int) $trending  ], (int) $id ); 
 
print_r( $res );


exit;

 
$index = $client->index('my_marketplace_tube_views'); 
$results = $index->search('*')->sort( 'total', 'desc'  )->get();
print_r( $results ); 
 
 
 
exit;

$id = (int) 95;
$index = $client->index('my_marketplace_tube_trending');    
$doc = $index->getDocumentById($id);



exit;

if ( is_array($doc)  ) {
$total = (int) $doc->total;
$dd = (int) $doc->dd;
$d0 = (int) $doc->d0;  
$d1 = (int) $doc->d1; 
$d2 = (int) $doc->d2; 
$d3 = (int) $doc->d3; 
$d4 = (int) $doc->d4; 
$d5 = (int) $doc->d5; 
$d6 = (int) $doc->d06; 
$trending = (int) $doc->trending;
}

if ( $dd == 0 && $dd != $current ) {  $d0 = (int) 0; }
if ( $dd == 1 && $dd != $current ) {  $d1 = (int) 0; } 
if ( $dd == 2 && $dd != $current ) {  $d2 = (int) 0; }
if ( $dd == 3 && $dd != $current ) {  $d3 = (int) 0; }
if ( $dd == 4 && $dd != $current ) {  $d4 = (int) 0; }
if ( $dd == 5 && $dd != $current ) {  $d5 = (int) 0; }
if ( $dd == 6 && $dd != $current ) {  $d6 = (int) 0; }


$views = (int) $doc->total + (int) 1;
$current = (int) $doc->dd;
$dd = date('w');
if (  $current == 0 ) { (int) $doc->d0 + (int) 1; } 
if (  $current == 1 ) { (int) $doc->d1 + (int) 1; } 
if (  $current == 2 ) { (int) $doc->d2 + (int) 1; } 
if (  $current == 3 ) { (int) $doc->d3 + (int) 1; } 
if (  $current == 4 ) { (int) $doc->d4 + (int) 1; } 
if (  $current == 5 ) { (int) $doc->d5 + (int) 1; } 
if (  $current == 6 ) { (int) $doc->d6 + (int) 1; }
 

   


$trending = (int) $d0 + (int) $d1 + (int) $d2 + (int) $d3 + (int) $d4 + (int) $d5 + (int) $d6;
  

$index->replaceDocument([ 
'total' => (int) $views,
'dd' => (int) $dd,
'd0' => (int) $d0,
'd1' => (int) $d1,
'd2' => (int) $d2,
'd3' => (int) $d3,
'd4' => (int) $d4,
'd5' => (int) $d5,
'd6' => (int) $d6,
'trending' => (int) $trending
 ], (int) $id ); 
echo $views;
 



?>
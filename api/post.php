<?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    require '../vendor/autoload.php';
    use Firebase\JWT\JWT;
    use Firebase\JWT\Key;

    $config = ['host'=>'127.0.0.1','port'=>9308];
    $client = new \Manticoresearch\Client($config);


echo "<pre>"; 


$index = $client->index('my_marketplace_tube_users');
$results = $index->search('*')->limit(1000)->offset(0)->get();
print_r($results);


exit;

$vid = 138;
$title = "hello world";
$user_id = 1;
$uid = 1234567890;

    $index = $client->index('my_marketplace_tube_messages');
    $doc = $index->addDocument([
    'vid' => (int) $vid,  
    'title' => (string) $title,               
    'user_id' => (int) $user_id,
    'uid' => (int) $uid,
    'created_at' => (int) time()
    ]);           


$id = $doc['_id'];
echo $id;
//print_r($doc);


exit;
$index = $client->index('my_marketplace_tube_views');
$docs = $index->search('*')
->setSource(['id' ])
->sort(['total'=>'desc'])
->limit(1000)
->get();
//print_r( $docs );

$videos = [];
foreach ($docs as $doc) {
//echo  $doc->getId();
array_push( $videos, (int) $doc->getId() );
}
print_r( $videos );


exit;




$cid = "03d3787a-f761-4355-8528-acfbdc45f3d2";
$rid = $unpack = unpack('I*', $cid)[1];
$nid = preg_replace("/[^0-9]/", "", $cid );
$uid = (int) "$rid$nid";
echo $uid;

 // 1819043144
//echo unpack('I*', 'jason')[1];
 


exit;


$channel = "xAlphabet";
$user_id = (int) 7;

$index = $client->index('marketplace');
$results = $index->search('*')->filter('user_id', 'equals',  (int) $user_id )->sort('created_at','desc')->limit(1000)->offset(0)->get();
foreach ($results as $doc) {
$id = $doc->getId();

//['data']['_source']['channel'] = $channel;

//$doc['channel'] = $channel;
print_r( (array) $doc ); 
exit;    
}



//$doc = $index->getDocumentById(143);
//print_r(  $doc ); 



 
$index->updateDocuments([ 'channel' => (string) $channel  ],['match'=>['*'=>'Alphabet']]);
 

$results = $index->updateDocuments(['channel' => (string) $channel ], new \Manticoresearch\Query\Equals('user_id', 7)   );

// $results = $index->updateDocuments([ 'channel'=> $channel ], ['match'=>['user_id'=> (int) $user_id ]]);
print_r(  $results ); 
 
 
exit;    
$uid = $_COOKIE['user'];
    
echo "<pre>"; 
echo $uid;

$index = $client->index('my_marketplace_tube_liked');
$results = $index->search('*')->match('@uid ' . $uid)->limit(1)->get();

foreach ($results as $doc) {
print_r( $doc->videos );
}



exit;

$index = $client->index('my_marketplace_tube_liked');
$results = $index->search('*')->match('@uid ' . $uid)->limit(1)->get();
print_r(  $results );


 
exit;

//$results = $client->sql('SELECT title FROM marketplace WHERE id IN ( 95, 138  ) ');


//$results = $client->sql('SELECT id FROM my_marketplace_tube_trending ORDER BY views.total desc '); 
//print_r(  $results );


// VIEWS AND TRENDING COUNTER

$id = (int) 95;
$views = [];
$index = $client->index('my_marketplace_tube_views');    
$doc = $index->getDocumentById($id);
if ( isset( $doc->views )) { $views =  $doc->views; }
$date = date("ymd");
$d1 = date('ymd', strtotime('-1 days'));
$d2 = date('ymd', strtotime('-2 days'));
$d3 = date('ymd', strtotime('-3 days'));
$d4 = date('ymd', strtotime('-4 days'));
$d5 = date('ymd', strtotime('-5 days'));
$d6 = date('ymd', strtotime('-6 days'));
$d7 = date('ymd', strtotime('-7 days'));

$trending[$date] = (int) 0;
if (isset( $views[$d1])) { $trending[$d1] = (int) $views[$d1]; }
if (isset( $views[$d2])) { $trending[$d2] = (int) $views[$d2]; }
if (isset( $views[$d3])) { $trending[$d3] = (int) $views[$d3]; }
if (isset( $views[$d4])) { $trending[$d4] = (int) $views[$d4]; }
if (isset( $views[$d5])) { $trending[$d5] = (int) $views[$d5]; }
if (isset( $views[$d6])) { $trending[$d6] = (int) $views[$d6]; }
if (isset( $views[$d7])) { $trending[$d7] = (int) $views[$d7]; }

if (!isset( $views[$date] )) { $views[$date] = (int) 0; }
if (!isset( $views['total'] )) { $views['total'] = (int) 0; }

$views[$date] = (int) $views[$date] + (int) 1;
$views['total'] = (int) $views['total'] + (int) 1;
$views['trending'] = (int) array_sum($trending);

ksort($views);
$index->replaceDocument([ 'views' => json_encode($views) ], (int) $id ); 

//print_r($views);




exit;

$results = $client->sql('SELECT user_id, channel FROM marketplace GROUP BY user_id ORDER BY created_at desc LIMIT 40'); 
foreach ($results['hits']['hits'] as $doc ) {


//print_r( $doc );
 
echo  "<a class='dropdown-item py-2 px-4 small' href='/channel/?id=".$doc['_source']['user_id']."'>".$doc['_source']['channel']."</a>";
}

print_r( $results );


exit;
$subscribe = false;
$uid = "03d3787a-f761-4355-8528-acfbdc45f3d2";
$channel = (int) 45;
$subscriptions = [];

$index = $client->index('my_marketplace_tube_subscriptions'); 
$results = $index->search( '*' )->match('@uid' . $uid )->limit(1)->get();
//print_r( $doc );
foreach($results as $doc) { 
$id = $doc->getId();
$subscriptions = $doc->channel;

 


}

if ( $subscribe === false &&  ($key = array_search(  (int) $channel, (array) $doc->channel )) !== false) {
     echo $key . "\n";;
    unset($subscriptions[$key]);
} else {
    array_push($subscriptions, $channel );
}  
//$subscriptions = array_merge($subscriptions, $doc->channel );
 



$subscriptions = array_unique( $subscriptions );
print_r( $subscriptions );

echo $id;

if ($id) {
    $index->replaceDocument([  'uid' =>  (string) $uid,   'channel' =>  (array) $subscriptions ], (int) $id ); 
} else {
    $index->addDocuments([ [  'uid' =>  (string) $uid,   'channel' =>  (array) $subscriptions ]]); 
}




exit;
$index = $client->index('marketplace');
$results = $index->search( '*' )->match('@file_name cbe96865-e31e-4643-932e-891197899ac6')->setSource(['file_name','user_id'])->get();
print_r( $results );

exit;


// liked

$id = (int) 95;
$liked = true;
if ( $liked == false ) { $count = (int) -1;  } else { $count = (int) 1; }
$index = $client->index('my_marketplace_tube_liked');    
$doc = $index->getDocumentById($id);
if ( isset($doc->total)  ) {
    $likes = (int) $doc->total + (int) $count;
} else {
$likes = $count;
}
$index->replaceDocument([ 'total' => (int) $likes ], (int) $id ); 
echo $likes;


exit;


//echo date("j"). "\n";
//echo date("z"). "\n";
//echo date('w') . "\n";
//echo date('y') . "\n";

// liked






// subscriptions
 
$id = (int) 1; 
$channel = (int) 5;
$subscriptions = [];
array_push($subscriptions, $channel );
$index = $client->index('my_marketplace_tube_subscriptions'); 
$doc = $index->getDocumentById($id);
if (is_array($doc->channel)) { $subscriptions = array_merge($subscriptions, $doc->channel );  }
$subscriptions = array_unique( $subscriptions );
//print_r( $subscriptions );
//print_r( $doc->channel );
//print_r( $doc );

// unsubscribed
if ( $subscribe == false && ($key = array_search($channel, $subscriptions )) !== false) {
    unset($subscriptions[$key]);
}
$index->replaceDocument([ 'channel' =>  (array) $subscriptions ], (int) $id ); 

exit;
$index = $client->index('my_marketplace_tube_views');
$query = "SELECT * from my_marketplace_tube_views WHERE id=95";
//$response = $client->sql($query);
//print_r( $response );



$id = (int) 95;
$index = $client->index('my_marketplace_tube_views');    
$doc = $index->getDocumentById($id);
$views = (int) $doc->total + (int) 1;
$index->replaceDocument([ 'total' => (int) $views ], (int) $id ); 
echo $views;
   


//print_r( $doc ); 
exit;


 

    

exit;



$day = 1;
$week = 1;
$month = 1;
$year = 1;

$doc = $index->replaceDocument([
    'total' => (int) $total,   
    'day' => (int) $day,               
    'week' => (int) $week,
    'month' => (int) $month,
    'year' => (int) $year
    ], (int) $id );  
 
print_r( $doc ); 
exit; 
   
    // PARSE PAYLOAD    
    $data = file_get_contents("tmp/1699998149.json");
    $data = json_decode($data, true);
    foreach ($data[0] as $key => $value) { $$key = $value; }
    $jwt = $data['token'];
    $event = $data['event'];
//echo $file_title;
//echo $jwt;    
print_r( $data );
//exit;

    // DECODE TOKEN   
    $key = 'jwtkey2023';
    $decoded = JWT::decode($jwt, new Key($key, 'HS256'));
    $array = (array) $decoded; 
    if (strcmp($array[0], $file_name) !== 0) {  exit; }




if ( $file_title &&  ($event == "create" || $event == "update" || $event == "restore")  ) {

    $index = $client->index('marketplace');
    $doc = $index->replaceDocument([
    'file_name' => (string) $file_name,
    'user_id' => (int) $user_id,
    'channel' => (string) $channel,    
    'boost' => (int) 1,               
    'title' => (string) $file_title,
    'description' => (string) $description,
    'duration' => (int) $file_duration,
    'width' => (int) $file_width,
    'height' => (int) $file_height,
    'category' => [],    
    'tags' => (string) $file_tags,
    'created_at' => (int) strtotime($created_at),
    'updated_at' => (int) strtotime($updated_at)
    ], (int) $id );           
    print_r($doc);
}
if ($event == "remove" ) {
     $index = $client->index('marketplace');
    $doc = $index->deleteDocument( (int) $id );
    print_r($doc);
}


exit;
$results = $index->search('')->get();
foreach($results as $doc) {
echo $doc->title; 
print_r( $doc  );  
}

echo "111<pre>";
//print_r();        
    
?>  
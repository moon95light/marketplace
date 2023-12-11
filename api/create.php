<?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    require '../vendor/autoload.php';
    use Firebase\JWT\JWT;
    use Firebase\JWT\Key;

    $config = ['host'=>'127.0.0.1','port'=>9308];
    $client = new \Manticoresearch\Client($config);

$index = $client->index('my_marketplace_tube_users'); 
$index->drop(true);
$response = $index->create([                
    'info'=>['type'=>'json']     
]);

print_r( $response  ); 

exit;




 $index = $client->index('my_marketplace_tube_messages'); 
$index->drop(true);
$response = $index->create([               
    'vid'=>['type'=>'integer'],
    'title'=>['type'=>'text'],
     'user_id'=>['type'=>'integer'],  
    'uid'=>['type'=>'integer'],   
    'created_at'=>['type'=>'integer']   
]);

print_r( $response  ); 

exit;

$index = $client->index('my_marketplace_tube_views'); 
$index->drop(true);
$response = $index->create([               
    'total'=>['type'=>'integer'],  
    'trending'=>['type'=>'integer'],
    'views'=>['type'=>'json']    
]);

print_r( $response  ); 

exit;


$index = $client->index('my_marketplace_tube_subscriptions'); 
$index->drop(true);
$response = $index->create([         
    'uid'=>['type'=>'text'],
    'channels'=>['type'=>'json']
]);
print_r( $response  ); 

exit;





$index = $client->index('my_marketplace_tube_recommended'); 
$index->drop(true);
$response = $index->create([         
    'total'=>['type'=>'float']
]);
print_r( $response  );



exit;
echo date("W");


//exit;




$index = $client->index('my_marketplace_tube_saved'); 
$index->drop(true);
$response = $index->create([         
    'uid'=>['type'=>'text'],
    'videos'=>['type'=>'json']
]);
print_r( $response  ); 

$index = $client->index('my_marketplace_tube_watch_later'); 
$index->drop(true);
$response = $index->create([         
    'uid'=>['type'=>'text'],
    'videos'=>['type'=>'json']
]);
print_r( $response  ); 

$index = $client->index('my_marketplace_tube_liked'); 
$index->drop(true);
$response = $index->create([         
    'uid'=>['type'=>'text'],
    'videos'=>['type'=>'json']
]);
print_r( $response  ); 





//exit;   
 
$index = $client->index('my_marketplace_tube_subscriptions'); 
$index->drop(true);
$response = $index->create([         
    'uid'=>['type'=>'text'],
    'channel'=>['type'=>'json']
]);
print_r( $response  ); 


exit;


//$index->drop(true); 
//exit;    
//$index->drop(true);
//exit;

$index = $client->index('my_marketplace_tube_subscriptions'); 
//$index->drop(true);
$response = $index->create([         
    'channel'=>['type'=>'multi']
]);
print_r( $response  );
$index = $client->index('my_marketplace_tube_playlists'); 
//$index->drop(true);
$response = $index->create([         
    'videos'=>['type'=>'multi'],
    'watch_later'=>['type'=>'multi']
]);
print_r( $response  );



exit;
$index = $client->index('my_marketplace_tube_views'); 
//$index->drop(true);
$response = $index->create([         
    'total'=>['type'=>'integer'],  
    'day'=>['type'=>'integer'],
    'week'=>['type'=>'integer'],
    'month'=>['type'=>'integer'],
    'year'=>['type'=>'integer']
]);
print_r( $response  ); 


exit;
$index = $client->index('channels'); 
$index->drop(true);
$response = $index->create([
    'avatar'=>['type'=>'text'],    
    'name'=>['type'=>'text'],    
    'description'=>['type'=>'text'],   
    'facebook'=>['type'=>'text'],
    'twitter'=>['type'=>'text'],    
    'linkedin'=>['type'=>'text'],
    'instagram'=>['type'=>'text'],    
    'web'=>['type'=>'text'],            
    'available_space'=>['type'=>'integer'],
    'first_name'=>['type'=>'text'],
    'last_name'=>['type'=>'text'], 
    'email'=>['type'=>'text'],
    'email_verified_at'=>['type'=>'integer'],     
    'trusted'=>['type'=>'integer'],
    'banned_at'=>['type'=>'integer'],
    'created_at'=>['type'=>'integer'],
    'updated_at'=>['type'=>'integer']
]);
print_r( $response  ); 
 

/*
$index = $client->index('marketplace');
$response = $index->create([
    'file_name'=>['type'=>'text'],
    'user_id'=>['type'=>'integer'],
    'channel'=>['type'=>'text'],    
    'boost'=>['type'=>'integer'],               
    'title'=>['type'=>'text'],
    'description'=>['type'=>'text'],
    'duration'=>['type'=>'integer'],
    'width'=>['type'=>'integer'],
    'height'=>['type'=>'integer'],
    'category'=>['type'=>'multi'],    
    'tags'=>['type'=>'text'],
    'created_at'=>['type'=>'integer'],
    'updated_at'=>['type'=>'integer']
]);
print_r( $response  );
*/ 
echo "222 111<pre>";
      
    
?>  
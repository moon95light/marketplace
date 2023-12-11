<?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    require '../vendor/autoload.php';
    use Firebase\JWT\JWT;
    use Firebase\JWT\Key;
    $config = ['host'=>'127.0.0.1','port'=>9308];
    $client = new \Manticoresearch\Client($config);
        

$data = file_get_contents('php://input');
$id = time();


file_put_contents("tmp/$id.json", $data );

//file_put_contents("tmp/$id.json", $jsonData );
//exit;


if (!empty($data)) {

    // PARSE PAYLOAD    
    //$data = file_get_contents("tmp/1699998149.json");
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


if ( $channel &&  $event == "settings"    ) {

    $index = $client->index('channels');
    $doc = $index->replaceDocument([
    'avatar' => (string) $avatar,   
    'name' => (string) $channel,    
    'description' => (string) $description,   
    'facebook' => (string) $facebook,
    'twitter' => (string) $twitter,    
    'linkedin' => (string) $linkedin,
    'instagram' => (string) $instagram,    
    'web' => (string) $web,            
    'available_space' => (int) $available_space,
    'first_name' => (string) $first_name,
    'last_name' => (string) $last_name, 
    'email' => (string) $email,
    'email_verified_at' => (int) strtotime($email_verified_at),     
    'trusted' => (int) $trusted,
    'banned_at' => (int) strtotime($banned_at),
    'created_at' => (int) strtotime($created_at),
    'updated_at' => (int) strtotime($updated_at)
    ], (int) $id );           
    print_r($doc);
}




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


header('Content-Type: application/json');
echo json_encode($response);

}


?>

 
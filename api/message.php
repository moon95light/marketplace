<?php
    include("../settings.php");
    $path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    parse_str(parse_url($_SERVER['REQUEST_URI'], PHP_URL_QUERY), $get);
    $data = json_decode(file_get_contents('php://input'), true);
 

    if (isset($_COOKIE["user"])) {
        $_POST['uid'] = $_COOKIE["user"]; 
    } else {
        exit;
    }

 

if ( is_array( $_POST )  ) {
    $_POST['message'] = trim($_POST['message']);
    $uid = (int) $_COOKIE["user"];
    $vid =  (int) trim($_POST['vid']);;
    $title = (string) trim($_POST['title']);
    $user_id = (int) trim($_POST['user_id']);
 

    $index = $client->index($message_index);
    $doc = $index->addDocument([
    'vid' => (int) $vid,  
    'title' => (string) $title,               
    'user_id' => (int) $user_id,
    'uid' => (int) $uid,
    'created_at' => (int) time()
    ]);           
    $id = (int) $doc['_id'];
    //print_r($doc);
    file_put_contents($message_dir . "$id.json", json_encode(  $_POST  ) );
    echo true;
} else {
    echo false;
}


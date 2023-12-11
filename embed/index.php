<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require '../vendor/autoload.php';
$config = ['host' => '127.0.0.1', 'port' => 9308];
$client = new \Manticoresearch\Client($config);

// $id = (int) trim($_GET["v"]);
// $index = $client->index('marketplace');
// $doc = $index->getDocumentById($id);
// $vid = $doc->file_name;
//    $source = "https://cdn.audition.tube/audition/uploads/$vid/$vid/playlist.m3u8";
//echo  $source;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width" />
    <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
    <meta http-equiv="Pragma" content="no-cache" />
    <meta http-equiv="Expires" content="0" />
    <title></title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/video.js/8.6.1/video-js.min.css"
        integrity="sha512-lByjBFPoRLnSCpB8YopnHGrqH1NKWff5fmtJ6z1ojUQE6ZQnhiw8T0L3FtezlyThDLViN4XwnKBaSCrglowvwA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        div#my-video {
            width: 100%;
            height: 100%;
        }
    </style>
</head>

<body style="position:absolute; padding:0; margin:0; width:100vw; height:100vh; ">

    <video id="my-video" class="video-js" controls preload="auto" width="100vw" height="100vh" data-setup="{}"
        class="video-js my-video-dimensions vjs-controls-enabled vjs-workinghover vjs-v8 vjs-has-started vjs-playing vjs-user-inactive"
        auto="true">
        <source
            src="https://cdn.audition.tube/audition/uploads/5850fb10-ada9-42c0-89cb-eca3786534eb/5850fb10-ada9-42c0-89cb-eca3786534eb/playlist.m3u8"
            type="application/x-mpegURL" />
    </video>
</body>

<script src="https://cdnjs.cloudflare.com/ajax/libs/video.js/8.6.1/video.min.js"
    integrity="sha512-19kPqSYAN3EiTxmPPFeInu0KiE6ZpYntGctkdtc2LGShfM1QcZQA2O8y25og2lufK5bE2gSnYn5PO2+9Iex4Bg=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script>
    var x = document.getElementById("myVideo");
    document.body.addEventListener('click', function () {
        alert('Body Clicked!');
    });
    // window.onload = function () {
    //     setTimeout(function () {
    //         document.body.click();
    //     }, 3000); // Delay of 5 seconds 
    // };
    // const video = document.getElementById('my-video');
    // video.addEventListener("click", function( event ) {
    //     video.play();
    // });

    // const button = document.getElementsByClassName('vjs-big-play-button');

    // if (button) {
    //     console.log("hello", button);

    //     // button.onClick = function() {
    //     //     alert('Mouse Over the Button!');
    //     // };
    // }
</script>
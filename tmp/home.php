<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require '../vendor/autoload.php';
$config = ['host' => '127.0.0.1', 'port' => 9308];
$client = new \Manticoresearch\Client($config);
$index = $client->index('videos');
$index = $client->index('marketplace');







//echo "<pre>";
//print_r( $results  );
//exit;


//echo "<pre>";
//print_r( $results  );
//exit;


//exit;

$title = "Home";
include("../header.php");
function timeFormat($duration)
{
    $formattedDuration = gmdate('H:i:s', $duration);
    $hour = substr($formattedDuration, 0, 3);
    if ($hour == "00:") {
        $formattedDuration = substr($formattedDuration, 3);
    }
    return $formattedDuration;
}
?>



<!-- Jumbotron -->

<div class="p-5 bg-dark text-white mt-5">
    <div class="px-4 py-5 my-4">
        <h1 class="display-4">Stream Webinars </h1>
        <p class="w-75 ">
            Stream on-demand webinars to your phone, laptop, desktop or smart TV with the the best
            video quality and viewer experience possible - no matter the connection, software, or device.
        </p>

        <button type="button" class="btn btn-danger btn-lg px-5 roumded-0 shadow-none">
            browse
        </button>

        <button type="button" class="btn btn-link btn-lg text-white px-5 roumded-0 shadow-none">
            create a channel
        </button>

    </div>
</div>
<!-- Jumbotron -->

<div class="container-fluid px-5 py-4">
    <h6 class="mt-2 mb-3 small"> LATEST WEBINARS </h6>
    <div class="row ">
        <?php
        //  $search->match('Ryobi','title,long_title');
        // ->sort('id','desc')

        $results = $index->search('', 'title,description,channel')->limit(1000)->get();
        //echo "<pre>";
        //print_r( $results  );
        //exit;

        foreach ($results as $doc) {
            //print_r( $doc  );

            $duration = $doc->duration;

            //echo date('H:i:s',  $duration ); 
            echo "
                <div class='col-3 mb-2'>
                <div class='bg-image'>
                    <img src='https://my.audition.tube/images/videos/" . $doc->file_name . ".jpeg' class='img-fluid' alt='Sample'/>
                    <div class='mask'>
                    <div class='d-flex align-items-center h-100'>
                        <p class='text-white duration'>" . timeFormat($duration) . "</p>
                    </div>
                    </div>
                </div>
                <a href='/watch/?v=" . $doc->getId() . "'>" . $doc->title . "</a>
                </div>
            ";

            // echo "
            // <div class='col-3 mb-2'>
            // <div class='duration'>" . timeFormat($duration) . "</div>  
            // <a href='/watch/?v=" . $doc->getId() . "'>
            //     <img  class='img-fluid border' src='https://my.audition.tube/images/videos/" . $doc->file_name . ".jpeg'>
            //   </a>
            //   <br>
            //   <a href='/watch/?v=" . $doc->getId() . "'>" . $doc->title . "</a>
            //   <br>" . $doc->channel . "</div>";   

            //    //echo 'Document:'.$doc->getId()."\n";

        }



        ?>
    </div>
</div>









<?php include("footer.php"); ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/video.js/8.5.3/video.min.js" integrity="sha512-wUWE15BM3aEd9D+01qFw8QdCoeB/wDYmOOqkgeeKiYXE+kiPOboLcOES+1lJMa5NiPBPBQenZYoOWRhf5jv4sw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/7.0.0/mdb.umd.min.js"></script>
<script type="text/javascript" src="dist/js/social-share-kit.js"></script>
<?php
    include("../settings.php");
    $title = "Channel Guide";
    include("../header.php");
?>



<!-- Jumbotron -->



<div class="bg-dark text-white p-5 mt-5">

  <div class="row my-5">
    <div class="col-md-8">
      <div class="pb-3">
        <h1>Notifications</h1>
      </div>
      <div class="row">
        <div class="col-md-6 py-5">


        </div>
        <div class="col-md-6"> </div>
      </div>
    </div>
    <div class="col-md-4"> </div>
  </div>


</div>
<!-- Jumbotron -->



<div class="container-fluid px-5 py-4 mt-5">






  <div class="row">
    <?php


//echo "<pre>";

$channels = [];
$index = $client->index($subscriptions_index);
$doc = $index->getDocumentById($uid);
if ( isset( $doc->channels  )  ) {
    $channels = $doc->channels;    
}
//print_r( $channels  );

    //exit;

if ( !empty( $channels )  ) {
    $channels = array_values($channels);
    $index = $client->index($mster);
    $docs = $index->search('*')
      ->setSource(['file_name','title','channel','user_id','duration' ])
      ->filter('user_id', 'in', $channels )
      ->sort('created_at', 'desc')
      ->limit(1000)
      ->offset(0)
      ->get();

//print_r( $docs  ); 
      
      
      
//exit;
    foreach ($docs as $doc) {
      $duration = $doc->duration;

      echo "
        <div class='col-3 mb-3'>
          <a href='/watch/?v=" . $doc->getId() . "'>
          <div class='bg-image mb-2'>
            <img src='https://my.audition.tube/images/videos/" . $doc->file_name . ".jpeg' class='img-fluid' />
            <div class='mask'>
              <div class='d-flex align-items-center h-100'>
                <p class='text-white duration'>" . $duration . "</p>
              </div>
            </div>
          </div>
          </a>
          <a href='/watch/?v=" . $doc->getId() . "'>  <p class='truncate mb-0'>" . $doc->title . "</p> </a>
          
          <a class='small' href='/search/?channel=" . $doc->user_id . "'>" . $doc->channel . "</a>
        </div>
      ";
    
    }
    }


    ?>
  </div>
</div>



<?php include("../footer.php"); ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/video.js/8.5.3/video.min.js"
  integrity="sha512-wUWE15BM3aEd9D+01qFw8QdCoeB/wDYmOOqkgeeKiYXE+kiPOboLcOES+1lJMa5NiPBPBQenZYoOWRhf5jv4sw=="
  crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/7.0.0/mdb.umd.min.js"></script>
<script type="text/javascript" src="dist/js/social-share-kit.js"></script>

 
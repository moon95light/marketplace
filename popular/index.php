<?php
    include("../settings.php");
    $title = "Popular Videos";
    include("../header.php");
?>



<!-- Jumbotron -->



<div class="bg-dark text-white p-5 mt-5">

  <div class="row my-5">
    <div class="col-md-8">
    
            <h1 class="display-2">Popular Videos</h1>
            
      <div class="pb-3">
        .col-md-8
      </div>
      <div class="row">
        <div class="col-md-6 py-5">.col-md-6</div>
        <div class="col-md-6">.col-md-6</div>
      </div>
    </div>
    <div class="col-md-4">.col-md-4</div>
  </div>


</div>
<!-- Jumbotron -->



<div class="container-fluid px-5 py-4 mt-5">

 




  <div class="row">
    <?php

// get most views

$index = $client->index($views_index);
$docs = $index->search('*')
->setSource(['id' ])
->sort(['total'=>'desc'])
->limit(1000)
->offset(0)
->get();
//print_r( $docs );

$videos = [];
foreach ($docs as $doc) {
array_push( $videos, (int) $doc->getId() );
}
//print_r( $videos );

    //exit;

if ( !empty( $videos )  ) {
    $videos = array_values($videos);

    $index = $client->index($master);
    $docs = $index->search('*')
      ->setSource(['file_name','title','channel','user_id','duration' ])
      ->filter('id', 'in', $videos )
      //->sort('_score', 'desc')
      ->limit(1000)
      ->offset(0)
      ->get();
      foreach($docs as $doc) {
    
        $duration = $doc->duration;
        echo "
        <div class='col-3 mb-3' id='".$doc->getId()."'>
        <input type='button'  class='unliked' name='".$doc->getId()."|".$doc->user_id."' value='X'>

  <a href='/watch/?v=".$doc->getId()."'>
  <div class='bg-image mb-2'>
    <img src='https://my.audition.tube/images/videos/".$doc->file_name.".jpeg' class='img-fluid' alt='Sample'/>
    <div class='mask'>
      <div class='d-flex align-items-center h-100'>
        <p class='text-white duration'>".timeFormat($duration)."</p>
      </div>
    </div>
  </div></a>
  <a href='/watch/?v=".$doc->getId()."'>  <p class='truncate mb-0'>".$doc->title."</p> </a>
   <a class='small' href='/channel/?v=".$doc->user_id."'>".$doc->channel."</a>
</div>
";
      }
    }


    ?>
  </div>
</div>



<?php include("../footer.php"); ?>

<?php
    include("../settings.php");
    $title = "Home";
    include("../header.php");
?>



<!-- Jumbotron -->
 


<div class="bg-dark text-white p-5 mt-5">

<div class="row my-5">
  <div class="col-md-8">
    <div class="pb-3">
      
        <h1 class="display-2">Featured Videos</h1>
      
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
 
     $index = $client->index($master);    
    $results = $index->search('*')
    ->setSource(['file_name','title','channel','user_id','duration' ])
    ->limit(1000)
    ->offset(0)
    ->get();
    //echo "<pre>";
    //print_r( $results  );
    //exit;

    foreach ($results as $doc) {
      //print_r( $doc  );

      $duration = $doc->duration;

      //echo date('H:i:s',  $duration ); 
      echo "
<div class='col-3 mb-3'>
  <a href='/watch/?v=" . $doc->getId() . "'>
  <div class='bg-image mb-2'>
    <img src='https://my.audition.tube/images/videos/" . $doc->file_name . ".jpeg' class='img-fluid' alt='Sample'/>
    <div class='mask'>
      <div class='d-flex align-items-center h-100'>
        <p class='text-white duration'>". timeFormat($duration) ."</p>
      </div>
    </div>
  </div></a>
  <a href='/watch/?v=" . $doc->getId() . "'>  <p class='truncate mb-0'>" .$doc->title ."</p> </a>
   <a class='small' href='/channel/?v=" . $doc->user_id . "'>" . $doc->channel . "</a>
</div>
";


    }



    ?>
  </div>
</div>



<?php include("../footer.php"); ?>
 
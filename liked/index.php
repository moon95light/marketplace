<?php
    include("../settings.php");
    $title = "Liked Videos";
    include("../header.php");
?>



<!-- Jumbotron -->



<div class="bg-dark text-white p-5 mt-5">

  <div class="row my-5">
    <div class="col-md-8">
    
               <h1 class="display-2">Liked Videos</h1>
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
 
//echo "<pre>";
 
    $uid = (int) $_COOKIE['user'];
$videos = [];
$index = $client->index($liked_index);
$doc = $index->getDocumentById($uid);
if ( isset( $doc->videos  )  ) {
    $videos = $doc->videos;    
}
//print_r( $videos  );

    //exit;

if ( !empty( $videos )  ) {
    $videos = array_values($videos);
    //print_r( $videos  );
 
    
    $index = $client->index($master);
    $docs = $index->search('*')
        ->setSource(['file_name','title','channel','user_id','duration' ])
        ->filter('id', 'in', $videos )
        ->sort('created_at', 'desc')
        ->limit(1000)
        ->offset(0)
        ->get();
    foreach ($docs as $doc) {
      //print_r( $doc  );
    
      $duration = $doc->duration;

      //echo date('H:i:s',  $duration ); 
      echo "
<div class='col-3 mb-3' id='". $doc->getId() ."'>
<input type='button'  class='unliked' name='" . $doc->getId() . "|" . $doc->user_id . "' value='X'>
  <a href='/watch/?v=" . $doc->getId() . "'>
  <div class='bg-image mb-2'>
    <img src='https://my.audition.tube/images/videos/" . $doc->file_name . ".jpeg' class='img-fluid' alt='Sample'/>
    <div class='mask'>
      <div class='d-flex align-items-center h-100'>
        <p class='text-white duration'>" . timeFormat($duration) . "</p>
      </div>
    </div>
  </div></a>
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
<script type="text/javascript" src="../dist/js/social-share-kit.js"></script>

<script>
  $(document).ready(function () {
    $(".unliked").click(function () {
      var id = $(this).attr('name');
      var parts = id.split('|');
      var video_id = parts[0];
      var owner_id = parts[1];
      $("div#" + video_id).hide();
      // console.log(parent);
      $.ajax({
        url: '/api/like.php',
        type: 'POST',
        data: {
          "channelid": owner_id, "videoid": video_id, action: "remove"
        },
        success: function (response) {
          console.log(response);
          // $(this).parent("div").hide();

        }
      });
      // location.reload(true);
    });
  })
</script>
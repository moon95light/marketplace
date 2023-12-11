<?php
    include("../settings.php");
    $title = "Subscriptions";
    include("../header.php");
?>



<!-- Jumbotron -->



<div class="bg-dark text-white p-5 mt-5">

  <div class="row my-5">
    <div class="col-md-8">
      <div class="pb-3">
        <h1>Subscriptions </h1>
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
    $index = $client->index($channels_index);
    $docs = $index->search('*')
        ->setSource(['name','avatar' ])
        ->filter('id', 'in', $channels )
        ->sort('created_at', 'desc')
        ->limit(1000)
        ->offset(0)
        ->get();
        


      foreach ($docs as $doc) {
        echo "
<div class='col-3 mb-3' id='" . $doc->getId() . "'>
<input type='button' class='unliked' name='" . $doc->getId() . "' value='X'>

  <a href='/channel/?v=" . $doc->getId() . "'>
  <div class='bg-image mb-2 border bg-light' style='
  height:169px;
  background: url(" . $doc->avatar . ");
 background-size: cover; 
  '>
    
    <div class='mask'>
      <div class='d-flex align-items-center h-100'>
         
      </div>
    </div>
  </div></a>
  <a href='/channel/?v=" . $doc->getId() . "'>  <p class='truncate mb-0'>" . $doc->name . "</a>
   
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


<script>
  $(document).ready(function () {
    $(".unliked").click(function () {
      var id = $(this).attr('name');
      var owner_id = id;
      $("div#" + id).hide();

      $.ajax({
        url: '/api/subscribe.php',
        type: 'POST',
        data: {
          "ownerid": owner_id,
          action: "remove"
        },
        success: function (response) {
          console.log("success");
          $('#success-subscription').show();
          $('#success-subscription').fadeIn(1000).delay(2000).fadeOut(1000);
        }
      });
      // location.reload(true);
    });
  })
</script>
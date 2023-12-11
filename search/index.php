<?php
    include("../settings.php");
    $title = "Search";
    include("../header.php");
?>


<div class="container-fluid p-5 mt-5">
  <br>
  <div class="row">
    <?php
  
    
    if (isset($_GET['q'])) {
      $q = trim($_GET['q']);
    } else {
      $q = "";
    }


    if (isset($_GET['page'])) {
      $page = (int) $_GET['page'];
    } else {
      $page = 1;
    }
    $current_page = $page;
    $limit = 8;
    $index = $client->index($master);
    $results = $index->search($q)
      ->limit($limit)
      ->offset(($page - 1) * $limit)
      ->sort('created_at', 'desc')
      ->get();
    $allcount = $results->getTotal();

    $pagecount = ceil($allcount / $limit);

    foreach ($results as $doc) {
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



    ?>



  </div>


  <?php
  include("../api/pagination.php");
  $url = "/search/?q=$q&";
  pagenationBar($current_page, $url, $pagecount);
  ?>


</div>


<script src="https://cdnjs.cloudflare.com/ajax/libs/video.js/8.5.3/video.min.js"
  integrity="sha512-wUWE15BM3aEd9D+01qFw8QdCoeB/wDYmOOqkgeeKiYXE+kiPOboLcOES+1lJMa5NiPBPBQenZYoOWRhf5jv4sw=="
  crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/7.0.0/mdb.umd.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/social-share-kit/1.0.15/css/social-share-kit.css"
  integrity="sha512-Y7Mdm2mGmjT2Q4pOK0Re0r9dj2zPj1Vw9C3QkvTxgoLuzqkAMRFsDCd77Yvq5p36ZR9cIQh/0JVYp4r0McqPTg=="
  crossorigin="anonymous" referrerpolicy="no-referrer" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/social-share-kit/1.0.15/js/social-share-kit.min.js"
  integrity="sha512-u+G+A9V0BM4zKp6aN99fyfpqcU5YI2abpmhVLN0/br2xux0kVKatJCEFABjA80fYzOjCih4G+qkb5HSVMA1zOg=="
  crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="../js/watch.js"></script>

<?php include("../footer.php"); ?>
<?php
include("../settings.php");
$index = $client->index('marketplace');


//echo "<pre>";
//print_r( $results  );
//exit;


//echo "<pre>";
//print_r( $results  );
//exit;


if (isset($_COOKIE["user"])) {
  $cookieflag = 1;
} else {
  $cookieflag = 0;
}



$id = (int) trim($_GET["v"]);

$index = $client->index('channels');
$doc = $index->getDocumentById((int) $id);
if ( isset($doc) ) {
    $avatar = $doc->avatar;
    $channelid = $id;
    $channel = $doc->name;
    $title = $doc->name;
   $description = $doc->description; 

    $linkedin = $doc->linkedin; 
    $facebook = $doc->facebook;
    $twitter = $doc->twitter;
    $instagram = $doc->instagram;
    $web = $doc->web;
  
   
   
   
} else {
    echo 404;
    exit;
}


//echo "<pre>";
//print_r( $doc );
//exit;
 

include("../header.php");

?>



<!-- Jumbotron -->



<div class="bg-dark text-white p-5 mt-5">

  <div class="row my-5">
    <div class="col-md-8 pt-3">

      <h1 class="display-2 mb-0">
        <?= $title; ?>
      </h1>

      <div class="pb-3">

      </div>
      <div class="row">
        <div class="col-7 pb-5">
          <div class="channel-description">
            <p class="channeldescription" id="channeldescription">
              <?= $description; ?>
            </p>


          </div>

          <button type="button" id="subscribe" class="btn btn-light btn-lg mr-5 mt-3">Subscribe</button>
          <button type="button" class="btn btn-link btn-lg text-white bg-dark mx-4" data-mdb-ripple-init
            data-mdb-modal-init data-mdb-target="#aboutusModal">About Us</button>
          <button type="button" class="btn btn-link btn-lg text-white bg-dark px-0 mx-0" data-mdb-ripple-init
            data-mdb-modal-init data-mdb-target="#sendModal" id="sendmessage">Send Message</button>

          <p class="error-msg" style="margin-top: 5px;" id="success-subscription">You are now subscribed to this
            channel.</p>
        </div>
        <div class="col-5"></div>
      </div>

    </div>
    <div class="col-md-4"></div>
  </div>

</div>
<!-- Jumbotron -->

<div class="container-fluid px-5 py-4 mt-5">
  <div class="row">
    <?php
    if (isset($_GET['v'])) {
      $id = trim($_GET['v']);
    } else {
      $id = 1;
    }

    if (isset($_GET['page'])) {
      $page = $_GET['page'];
    } else {
      $page = 1;
    }
    $current_page = $page;
    $limit = 4;
    $index = $client->index($master);
    $results = $index->search('*')
      ->filter('user_id', 'equals', (int) $id)
      ->sort('created_at', 'desc')
      ->limit($limit)
      ->offset(($page - 1) * $limit)
      ->get();
    $pagecount = ceil($results->getTotal() / $limit);

    //echo "<pre>";
    //print_r( $results  );
    //exit;
    

    $index = $client->index('channels');
    $res = $index->getDocumentById((int) $id);
    if ($res !== null) {
      if ($res->avatar == null) {
        $avatar = "";
      } else {
        $avatar = $res->avatar;
      }
    } else {
      $avatar = ""; // or set a default avatar or take appropriate action
    }

    foreach ($results as $doc) {
      // print_r( $doc  );

      $duration = $doc->duration;
      echo "
<div class='col-3 mb-3'>
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
   <a class='small' href='/channel/?v=" . $doc->user_id . "'>" . $doc->channel . "</a>
</div>
";

    }

    ?>

  </div>

  <!-- Modal -->


  <div class="modal fade right" id="sendModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-bottom-right">
      <div class="modal-content">
        <div class="modal-header bg-primary text-white">
          <img src='<?php echo $avatar; ?>' class="img-fluid-message">
          <h5 class="modal-title" id="">
            <?=$channel;?>
          </h5>
          <button type="button" class="btn-close btn-close-white" data-mdb-ripple-init data-mdb-dismiss="modal"
            aria-label="Close"></button>
        </div>
        <div class="modal-body p-0">
          <textarea class="p-3" name="message" id="message" cols="30" rows="10" maxlength="1000"
            placeholder="Enter your messsage."></textarea>
        </div>
        <div class="modal-footer">
          <div class="footer-left">
            <p class="bottom-text">Your name and email address will be appended to your message.</p>
          </div>
          <div class="footer-right">
            <button class="btn btn-primary" id="send" data-mdb-ripple-init="" disabled>Send</button>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="aboutusModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="">
            <?=$channel;?>
          </h5>
          <button type="button" class="btn-close" data-mdb-ripple-init data-mdb-dismiss="modal"
            aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <?=$description;?>
        </div>
        <div class="modal-footer border-0" id="social-icons-footer">
          <div class="social-icons-channel">
             <?= ($web == null) ? "<a class='social-icons-link' href='".$res->web."' alt='Web Site' title='Web Site' target='_window'><i class='fa fa-globe fa-2x'></i></a>" : "" ?> 
            <?= ($facebook == null) ? "<a class='social-icons-link' href='".$res->facebook."' alt='Facebook' title='Facebook' target='_window'><i class='fab fa-facebook fa-2x'></i></a>" : "" ?>
            <?= ($instagram == null) ? "<a class='social-icons-link' href='".$res->instagram."' alt='Instagram' title='Instagram' target='_window'><i class='fab fa-instagram fa-2x'></i></a>" : "" ?>
            <?= ($linkedin == null) ? "<a class='social-icons-link' href='".$res->linkedin."' alt='Linkedin' title='Linkedin' target='_window'><i class='fab fa-linkedin fa-2x'></i></a>" : "" ?>
            <?= ($twitter == null) ? "<a class='social-icons-link' href='".$res->twitter."' alt='Twitter' title='Twitter' target='_window'><i class='fab fa-twitter fa-2x'></i></a>" : "" ?>
          </div>
        </div>
      </div>
    </div>
  </div>


  <?php
  include("../api/pagination.php");
  $url = "/channel/?v=$id&";
  pagenationBar($current_page, $url, $pagecount);
  ?>

  <?php include("../footer.php"); ?>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/video.js/8.5.3/video.min.js"
    integrity="sha512-wUWE15BM3aEd9D+01qFw8QdCoeB/wDYmOOqkgeeKiYXE+kiPOboLcOES+1lJMa5NiPBPBQenZYoOWRhf5jv4sw=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/7.0.0/mdb.umd.min.js"></script>
  <script type="text/javascript" src="dist/js/social-share-kit.js"></script>

  <script src="../js/watch.js"></script>
  <script>

    const auth = () => {
      var user = <?php echo json_encode($cookieflag); ?>;
      if (user == 0) {
        return window.location.href = "https://tubie.casdoor.com/login/oauth/authorize?client_id=5ba66fc84fa1946c9b55&response_type=code&redirect_uri=https://marketplace.tube/auth&scope=read,profile&state=casdoor"
      }
    }
    var owner_id = <?php echo json_encode($id); ?>;
    var video_id = "0";
    var $description = $('#channeldescription');
    var $showMore = $('#showMore');
    if ($description.prop('scrollHeight') > $description.innerHeight()) {
      $showMore.show();
    } else {
      $showMore.hide();
    }

    $("#subscribe").click(function () {
      var owner_id = <?php echo $channelid; ?>;
      $.ajax({
        url: '/api/subscribe.php',
        type: 'POST',
        data: {
          "ownerid": owner_id,
          action: "add"
        },
        success: function (response) {
          console.log("success");
          $('#success-subscription').show();
          $('#success-subscription').fadeIn(1000).delay(2000).fadeOut(1000);
        }
      });
      // location.reload(true);
    });
  </script>
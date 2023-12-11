<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require '../vendor/autoload.php';
$config = ['host' => '127.0.0.1', 'port' => 9308];
$client = new \Manticoresearch\Client($config);

//$date1 = new DateTime('2022-04-01');
//$date2 = new DateTime('2022-04-10');
//$interval = $date1->diff($date2);
//echo $interval->days;
//exit;

//$x = [ 5, 23, 68   ];
//echo json_encode( $x );
//exit;




//echo "<pre>";
//$query = "SELECT * FROM marketplace where MATCH('@file_name 5850fb10-ada9-42c0-89cb-eca3786534eb')";
//$response = $client->sql($query);
//print_r($response);  

//echo date('l jS F (Y-m-d)', strtotime('-3 days'));

//$seconds = int() 146;  
//$output = sprintf('%02d:%02d:%02d', ($seconds/ 3600),($seconds/ 60 % 60), $seconds% 60);
//echo $output; 

//echo date('H:i:s', strtotime('1 hour 1 minute 1 second', strtotime('midnight')));



//exit;    


//echo getName($n);

//$array = str_split( 1234567890  );

//print_r( $array  );
//echo uniqid(43);
//exit;

$id = (int) trim($_GET["v"]);
$index = $client->index('marketplace');
$doc = $index->getDocumentById($id);
$vid = $doc->file_name;
$owner = $doc->owner_id;
$cookieflag = 0;
if (isset($_COOKIE["user"])) {
  $cookieflag = 1;
} else {
  $cookieflag = 0;
}
if ($_GET["v"]) {
  $host = "host = postgresql-154883-0.cloudclusters.net";
  $port = "port = 19815";
  $dbname = "dbname = marketplace";
  $credentials = "user = root password=E3kSs77s1Npem0bR";

  $db = pg_connect("$host $port $dbname $credentials");
  /**
   * Upsert the data
   */

  $id = $doc->user_id;

  $sql = "INSERT INTO views (id, total)
                  VALUES ($id, 0)
                  ON CONFLICT (id) DO UPDATE SET total = views.total + 1 RETURNING total";
  $result = pg_query($db, $sql);
}


//print_r($doc);
//exit;
//echo "<pre>";
//print_r( $_GET );
//exit;


$title = $doc->title;
include("searchbox.php");
include("3.php");
?>


<br><br>

<div class="container-fluid pt-5">
  <div class="row">
    <div class="col-8 px-4">

      <div class="bg-dark">
        <video controls autoplay id="my-video" preload="auto" data-setup="{}" class="video-js vjs-default-skin xvjs-big-play-centered vjs-16-9 ">
      </div>


      <h6 class="my-2 mb-0">
        <?= $doc->title; ?>
      </h6>
      <div class="row">
        <div class="col-sm">
          <?= $doc->channel; ?>
        </div>
        <div class="col-7 text-end mb-3">
          <div style="width:fit-content; position:relative;" class="float-end">

            <button type="button" id="subscription" class="btn btn-light shadow-none ">Subscribe</button>
            <button type="button" id="modalbutton" class="btn btn-light shadow-none" data-mdb-toggle="modal" data-mdb-target="#messageModal">Message</button>

            <div class="btn-group shadow-none ssk-group ssk-round">
              <button type="button" class="btn btn-light shadow-none dropdown" data-mdb-dropdown-init data-mdb-ripple-init aria-expanded="false">
                Share
              </button>
              <ul class="p-2 dropdown-menu">
                <li class="pb-1"><a href="" class="ssk ssk-tumblr ssk-xs"></a> Tumblr</li>
                <li class="pb-1"><a href="" class="ssk ssk-facebook ssk-xs"></a> Facebook</li>
                <li class="pb-1"><a href="" class="ssk ssk-google-plus ssk-xs"></a> Google plus</li>
                <li class="pb-1"><a href="" class="ssk ssk-pinterest ssk-xs"></a> Pinterest</li>
                <li class="pb-1"><a href="" class="ssk ssk-twitter ssk-xs"></a> Twitter</li>
              </ul>
            </div>
            <div class="position-absolute" style="width: fit-content; bottom: -40px;">
              <p class="error-msg" id="success-subscription">You are now subscribed to this channel.</p>
              <p class="error-msg" id="success-message">Message sent.</p>
            </div>
          </div>

        </div>
      </div>

      <div class="bg-light p-3 small my-2">
        <?php print_r(getViews($doc->user_id)); ?> Views
        &bull;

        <?php
        echo timeAgo($doc->created_at);
        ?>



        <br>
        <?= $doc->description; ?>

      </div>
    </div>
    <div class="col-4">

      <?php
      $index = $client->index('marketplace');
      $results = $index->search('')->limit(1000)->get();
      foreach ($results as $doc) {
        echo "<div class='row mb-3'><div class='col-4'><a href='/watch/?v=" . $doc->getId() . "'><img  class='img-fluid border' src='https://my.audition.tube/images/videos/" . $doc->file_name . ".jpeg'></a></div><div class='col-8 small'><a href='/watch/?v=" . $doc->getId() . "'>" . $doc->title . "</a><br>" . $doc->channel . "</div></div>";
      }
      ?>
    </div>
  </div>
</div>



<div class="modal fade right" id="messageModal" tabindex="-1" data-mdb-backdrop="false" aria-labelledby="exampleSideModal2" style="display: none;" data-gtm-vis-first-on-screen2340190_1302="545643" data-gtm-vis-total-visible-time2340190_1302="100" data-gtm-vis-has-fired2340190_1302="1" aria-hidden="true">
  <div class="modal-dialog modal-side modal-bottom-right">
    <div class="modal-content">
      <div class="modal-header bg-primary text-white">
        <img src="https://f6b3.c13.e2-3.dev/audition/storage/avatars/bd1878e9-f693-4de6-af4a-f1b95900767e.JPEG" class="img-fluid-message" alt="Hollywood Sign">
        <h5 class="modal-title" id="">Cisco Systems</h5>
        <button type="button" class="btn-close btn-close-white" data-mdb-ripple-init data-mdb-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body p-0">
        <textarea class="p-3" name="message" id="message" cols="30" rows="10" maxlength="1000" placeholder="Enter your messsage."></textarea>
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


<?php include("../footer.php"); ?>





<script src="https://cdnjs.cloudflare.com/ajax/libs/video.js/8.5.3/video.min.js" integrity="sha512-wUWE15BM3aEd9D+01qFw8QdCoeB/wDYmOOqkgeeKiYXE+kiPOboLcOES+1lJMa5NiPBPBQenZYoOWRhf5jv4sw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/7.0.0/mdb.umd.min.js"></script>
<script type="text/javascript" src="dist/js/social-share-kit.js"></script>

<script>
  SocialShareKit.init();

  //const urlParams = new URLSearchParams(window.location.search);
  //const vid = urlParams.get('v');
  const vid = '<?php echo trim($vid); ?>';
  //alert( vid  );

  //const vid = '<?php echo trim($_GET["v"]); ?>';
  //alert( "https://cdn.audition.tube/audition/uploads/"+vid+"/"+vid+"/playlist.m3u8"  );

  // 004183fb-3956-492e-93c5-4899ac3a601a
  const player = videojs('my-video');

  player.src({
    src: "https://cdn.audition.tube/audition/uploads/" + vid + "/" + vid + "/playlist.m3u8",
    type: 'application/x-mpegURL',
  });
  player.play();

  $('#btn-search').on('click', function() {
    if ($('#search').is(':visible')) {
      $('#search').fadeOut(500); 
    } else {
      $('#search').fadeIn(500);
    }
  });

  /**
   * @description: POST subscription
   */

  const sanitize = (str) => {
    const div = document.createElement('div');
    div.textContent = str;
    return div.innerHTML;
  }

  const auth = () => {
    var user = <?php echo json_encode($cookieflag); ?>;
    console.log(user);
    if (user == 0) {
      window.location.href = "https://marketplace.tube/"
    }
  }

  $(document).ready(function() {
    const owner_id = <?php echo json_encode($doc->user_id); ?>;
    $("#subscription").on('click', function() {
      auth();
      $.ajax({
        url: '5-1.php',
        type: 'POST',
        data: {
          "ownerid": owner_id
        },
        success: function(response) {
          console.log("success");
          // $('#success-subscription').show();
          $('#success-subscription').fadeIn(1000).delay(2000).fadeOut(1000);
        }
      });
    });

    /**
     * @description: Message sent.
     */
    const textarea = $('#message');
    const button = $('#send');
    $('#modalbutton').click(function() {
      auth();

    });
    $('#message').on('keyup', function() {
      if (textarea.val().trim() !== '') {
        button.removeAttr('disabled');
      }
    });

    $("#send").click(function() {
      const formData = $('#message').val();
      console.log(sanitize(formData));
      const msg = sanitize(formData);
      const firstdecode = msg.replace(/&lt;/g, "");
      const seconddecode = firstdecode.replace(/&gt;/g, "");
      console.log(seconddecode);
      $.ajax({
        url: '6-1.php',
        type: 'POST',
        data: {
          "data": seconddecode,
          "id": owner_id
        },
        success: function(response) {
          $('#message').val('');
          $('#success-message').fadeIn(1000).delay(2000).fadeOut(1000);
          button.prop('disabled', true);
          $('.btn-close').trigger('click');
          $('#modalbutton').prop('disabled', true);
        }
      });
    });
  });
</script>


<script>

</script>
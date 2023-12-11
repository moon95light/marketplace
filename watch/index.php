<?php
    include("../settings.php");
    



 
 
function get_time_ago( $time ) {
    $time_difference = time() - $time;
    if( $time_difference < 1 ) { return 'less than 1 second ago'; }
    $condition = array( 12 * 30 * 24 * 60 * 60 =>  'year',
                30 * 24 * 60 * 60       =>  'month',
                24 * 60 * 60            =>  'day',
                60 * 60                 =>  'hour',
                60                      =>  'minute',
                1                       =>  'second'
    );
    foreach( $condition as $secs => $str )
    {
        $d = $time_difference / $secs;

        if( $d >= 1 )
        {
            $t = round( $d );
            return '' . $t . ' ' . $str . ( $t > 1 ? 's' : '' ) . ' ago';
        }
    }
} 
 

if (isset($_COOKIE["user"])) {
    $cookieflag = 1;
} else {
    $cookieflag = 0;
}
 
$id = (int) trim($_GET["v"]);
if (isset($id)) {

// TRACK VIEWS AND TRENDING DATA

$id = (int) $id;
$views = [];
$index = $client->index($views_index);    
$doc = $index->getDocumentById($id);
if ( isset( $doc->views )) { $views =  $doc->views; }
$date = date("ymd");
$d1 = date('ymd', strtotime('-1 days'));
$d2 = date('ymd', strtotime('-2 days'));
$d3 = date('ymd', strtotime('-3 days'));
$d4 = date('ymd', strtotime('-4 days'));
$d5 = date('ymd', strtotime('-5 days'));
$d6 = date('ymd', strtotime('-6 days'));
$d7 = date('ymd', strtotime('-7 days'));

$trending[$date] = (int) 0;
if (isset( $views[$d1])) { $trending[$d1] = (int) $views[$d1]; }
if (isset( $views[$d2])) { $trending[$d2] = (int) $views[$d2]; }
if (isset( $views[$d3])) { $trending[$d3] = (int) $views[$d3]; }
if (isset( $views[$d4])) { $trending[$d4] = (int) $views[$d4]; }
if (isset( $views[$d5])) { $trending[$d5] = (int) $views[$d5]; }
if (isset( $views[$d6])) { $trending[$d6] = (int) $views[$d6]; }
if (isset( $views[$d7])) { $trending[$d7] = (int) $views[$d7]; }

if (!isset( $views[$date] )) { $views[$date] = (int) 0; }
if (!isset( $views['total'] )) { $views['total'] = (int) 0; }

$views[$date] = (int) $views[$date] + (int) 1;
$views['total'] = (int) $views['total'] + (int) 1;
$views['trending'] = (int) array_sum($trending);

ksort($views);
$index->replaceDocument([ 'views' => json_encode($views) ], (int) $id ); 
$views = $views['total'];
//print_r($views);

// GET VIDEO INFO

$index = $client->index($master);
$doc = $index->getDocumentById($id);
$channel = $doc->channel;
$user_id = $doc->user_id;
$title = $doc->title;
$vid = $doc->file_name;

$channel_id = $doc->user_id;

$index = $client->index($channels_index);
$res = $index->getDocumentById( (int) $user_id);
$avatar = $res->avatar;

//echo "<pre>";
//echo $user_id;
//print_r( $res );
//exit;
 


} else {
    echo "404";
    exit;
} 
 
// print_r($id);
//echo "<pre>";
//print_r( $res );
//print_r($doc);
//exit;
//echo "<pre>";
//echo $doc->title;
//exit;


 
 
include("../header.php");

?>




<br><br>

<div class="container-fluid pt-5">
  <div class="row">
    <div class="col-8 px-4">

      <div class="bg-dark">
        <video controls autoplay id="my-video" preload="auto" data-setup="{}"
          class="video-js vjs-default-skin xvjs-big-play-centered vjs-16-9 ">
      </div>
<?php
//echo  $doc->title;
//exit;
?>



      <h6 class="my-2 mb-0">
        <?= $doc->title; ?>
      </h6>
      <div class="row">
        <div class="col-sm">
          <img class="channel-avatar" src="<?=$avatar;?>">
          <a href="/channel?v=<?= $doc->user_id ?> ">
            <?= $doc->channel; ?>
          </a>



          <br>
          <button type="button" id="subscribe" class="btn btn-light btn-sm shadow-none text-capitalize "><i
              class="fa fa-bell"></i>
            Subscribe</button>
          <button type="button" id="modalbutton" class="btn btn-light btn-sm shadow-none  text-capitalize "
            data-mdb-toggle="modal" data-mdb-target="#messageModal"><i class="fa fa-message"></i>
            Message</button>
          <button type="button" class="btn btn-light btn-sm shadow-none text-capitalize  dropdown"
            data-mdb-dropdown-init data-mdb-ripple-init aria-expanded="false"><i class="fa fa-share"></i>
            Share</button>
          <button type="button" id="watchlater" class="btn btn-light btn-sm shadow-none  text-capitalize "><i
              class="fa fa-eye"></i>
            Watch Later</button>
          <button type="button" id="videosave" class="btn btn-light btn-sm shadow-none  text-capitalize "><i
              class="fa fa-save"></i>
            Save</button>
          <button type="button" id="thumbup" class="btn btn-light btn-sm shadow-none  text-capitalize "><i
              class="fa fa-thumbs-up"></i></button>
          <button type="button" id="thumbdown" class="btn btn-light btn-sm shadow-none  text-capitalize "><i
              class="fa fa-thumbs-down"></i></button>

          <ul class="p-2 dropdown-menu">
            <li class="pb-1"><a href="" class="ssk ssk-tumblr ssk-xs"></a> Tumblr</li>
            <li class="pb-1"><a href="" class="ssk ssk-facebook ssk-xs"></a> Facebook</li>
            <li class="pb-1"><a href="" class="ssk ssk-google-plus ssk-xs"></a> Google plus</li>
            <li class="pb-1"><a href="" class="ssk ssk-pinterest ssk-xs"></a> Pinterest</li>
            <li class="pb-1"><a href="" class="ssk ssk-twitter ssk-xs"></a> Twitter</li>
          </ul>


        </div>
        <p class="error-msg" id="success-subscription">You are now subscribed to this channel.</p>
        <p class="error-msg" id="success-message">Message sent.</p>

        <div class="col-1 text-end">



        </div>


      </div>

      <div class="p-3 small my-2" id="description">
        <?=$views; ?>
        views &bull; <?= get_time_ago( $doc->created_at ); ?><br>

        <textarea name="description" id="descriptions-content" rows="3" readonly><?= $doc->description; ?></textarea>
        <p id="more" class="mb-0 pe-auto "> More</p>
      </div>
      <!-- <div class="fb-comments" data-href="https://marketplace.tube/watch/index.php" data-width="100%" data-numposts="10"></div> -->
      <div class="fb-comments" data-href="https://marketplace.tube/watch/?v="<?php print_r($id); ?> data-width="100%" data-numposts="25"></div>
      <div id="fb-root"></div>
    </div>
    <div class="col-4">

      <?php
      $index = $client->index($master);
      $results = $index->search('')
      ->setSource(['file_name','title','channel','user_id','duration' ])
      ->limit(1000)->get();
      foreach ($results as $doc) {
        echo "
        <div class='row mb-3'>
          <div class='col-4'>
            <a href='/watch/?v=" . $doc->getId() . "'>
              <img  class='img-fluid border' src='https://my.audition.tube/images/videos/" . $doc->file_name . ".jpeg'>
            </a>
          </div>
          <div class='col-8 small'>
            <a href='/watch/?v=" . $doc->getId() . "'>  <p class='truncate mb-0'>" .$doc->title ."</p> </a>" . $doc->channel . "
          </div>
        </div>";
      }
      ?>
    </div>

  </div>
</div>

 
<!-- Modal -->
 
<div class="modal fade right" id="messageModal"  tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-bottom-right">
    <div class="modal-content">
      <div class="modal-header bg-primary text-white">
        <img src='<?php echo $avatar; ?>'
          class="img-fluid-message">
        <h5 class="modal-title"><?=$channel;?></h5>
        <button type="button" class="btn-close btn-close-white" data-mdb-ripple-init data-mdb-dismiss="modal"
          aria-label="Close"></button>
      </div>
      <div class="modal-body p-0">
         <input type="hidden" name="title" id="title" value="<?=$title;?>">
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
 


</form>

 


<?php include("../footer.php"); ?>





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
  
  
  
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jQuery-slimScroll/1.1.0/jquery.slimscroll.min.js" integrity="sha512-DtOES2n7InRLizt/nYVZKC0LZbCfStBYIXCYWhzvptihCe0TA69mqJW+USqNn4ZRB2mYEJ5r57+LEMiPNsMNYw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>



<script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v18.0" nonce="UN1bgqDZ"></script>
<script>

  //const urlParams = new URLSearchParams(window.location.search);
  //const vid = urlParams.get('v');
  const vid = '<?php echo trim($vid); ?>';
  //alert( vid  );

  //const vid = '<?php echo trim($_GET["v"]); ?>';
  //alert( "https://cdn.audition.tube/audition/uploads/"+vid+"/"+vid+"/playlist.m3u8"  );

  // 004183fb-3956-492e-93c5-4899ac3a601a
  const player = videojs('my-video');
  //alert( "https://cdn.audition.tube/audition/uploads/" + vid + "/" + vid + "/playlist.m3u8" );
  player.src({ src: "https://cdn.audition.tube/audition/uploads/" + vid + "/" + vid + "/playlist.m3u8", type: 'application/x-mpegURL', });
  player.play();


  /**
   * @description: Authorization
   */
  const auth = () => {
    var user = <?php echo json_encode($cookieflag); ?>;
    if (user == 0) {
      return window.location.href = "https://tubie.casdoor.com/login/oauth/authorize?client_id=5ba66fc84fa1946c9b55&response_type=code&redirect_uri=https://marketplace.tube/auth&scope=read,profile&state=casdoor"
    }
  }

  const owner_id = <?php echo json_encode($channel_id); ?>;
  const video_id = <?php echo json_encode((int) trim($_GET["v"])); ?>;


  // auth();
</script>


<?php 
    if ($_SERVER['PHP_SELF'] != '/watch/index.php' ) {
        include("../footer.inc");
    } 
?>



  

        </div>
    </div>

<?php
//echo "<pre>";
//echo $_SERVER['PHP_SELF'];
//print_r( $_SERVER );
?>


<?php 
    if ($_SERVER['PHP_SELF'] == '/watch/index.php' ) {
        include("../footer.inc");
    } 
?>
</div>



</div>
</div>
</div>




<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.4.2/mdb.min.js"></script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script type="text/javascript" src="../tmp/dist/js/social-share-kit.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.min.js"></script>

<script>
  $(document).ready(function () {
    $(document).on('click', '.sidebar', function (e) {
      $('#sidebar').toggle();
    });
    // $("#sidebar").show();
    // var hh = $("#sidebarcom").prop("scrollHeight");
    // console.log(hh);
    // if(hh > $(window).height()-77){
    //   $("#sidebar").hide();
    // } else {
    //   $("#sidebar").show();
    // }


    var didScroll;
    var lastScrollTop = 0;
    var delta = 5;
    var navbarHeight = $('header').outerHeight();

    $(window).scroll(function (event) {
      didScroll = true;
    });

    setInterval(function () {
      if (didScroll) {
        hasScrolled();
        didScroll = false;
      }
    }, 250);

    function hasScrolled() {
      var st = $(this).scrollTop();

      // Make sure they scroll more than delta
      if (Math.abs(lastScrollTop - st) <= delta)
        return;

      // If they scrolled down and are past the navbar, add class .nav-up.
      // This is necessary so you never see what is "behind" the navbar.
      if (st > lastScrollTop && st > navbarHeight) {
        // Scroll Down
        $('header').removeClass('nav-down').addClass('nav-up');
        $(".navbar").css("padding-top", "0");
        $(".navbar").css("padding-bottom", "0");
        $("#search").css("bottom", "-55px");

      } else {
        // Scroll Up
        if (st + $(window).height() < $(document).height()) {
          $('header').removeClass('nav-up').addClass('nav-down');
          $(".navbar").css({
            "padding-top": "",
            "padding-bottom": ""
          });
          $("#search").css("bottom", "-45px");

        }
      }

      lastScrollTop = st;
    }

    // $(document).on('click', '#xsearch', function(e){   
    //  });    

    /**
     * @description : Search box X button
     */

    $("#q").on('input', function () {
      $("#search-x").show();
    });
    $("#search-x").click(function (e) {
      e.preventDefault(); // Prevent form submission
      $("#q").val(''); // Clear input value
      $("#search-x").hide(); // Hide the clear button
    });
    if ($("#q").val() != '') {
      $("#search-x").show();
    } else {
      $("#search-x").hide();
    }

  });

</script>
</body>

</html>
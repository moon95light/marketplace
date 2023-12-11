/**
   * @description: Sanitize Function
   */
const sanitize = (str) => {
  const div = document.createElement('div');
  div.textContent = str;
  return div.innerHTML;
}

$(document).ready(function () {

  $("#subscribe").click(function () {
    auth();
    isSubscribe("add");
  });
  $("#unsuscribe").click(function () {
    auth();
    isSubscribe("remove");
  });
  function isSubscribe(istrue) {
    $.ajax({
      url: '/api/subscribe.php',
      type: 'POST',
      data: {
        "ownerid": owner_id,
        action: istrue
      },
      success: function (response) {
        console.log("success");
        $('#success-subscription').show();
        $('#success-subscription').fadeIn(1000).delay(2000).fadeOut(1000);
      }
    });
  }

  /**
   * @description: Modal Button Function 
   */
  const textarea = $('#message');
  const button = $('#send');
  $('#modalbutton').click(function () {
    auth();

  });
  $('#message').on('keyup', function () {
    if (textarea.val().trim() !== '') {
      button.removeAttr('disabled');
    }
  });

  $("#send").click(function () {
    auth();
    const formData = $('#message').val();
    const titleData = $('#title').val();
    const msg = sanitize(formData);
    const firstdecode = msg.replace(/&lt;/g, "");
    const seconddecode = firstdecode.replace(/&gt;/g, "");
    if(video_id == null){
      video_id = "0";
    }
    $.ajax({
      url: '/api/message.php',
      type: 'POST',
      data: {
        "message": seconddecode,
        "owner_id": owner_id,
        "vid": video_id,
        "title": titleData
      },
      success: function (response) {
        $('#message').val('');
        $('#success-message').fadeIn(1000).delay(2000).fadeOut(1000);
        button.prop('disabled', true);
        $('.btn-close').trigger('click');
        $('#modalbutton').prop('disabled', true);
        $('#sendmessage').prop('disabled', true);
      }
    });
  });


  // $("#remove").click(function () {
  //   saveorwatchlater(false);
  // });
  $('#videosave').click(function () {
    saveorunsave("add");
  });
  $('#videounsaved').click(function (){
    saveorunsave("remove");
  });
  function saveorunsave(trueorfalse) {
    $.ajax({
      url: '/api/saved.php',
      type: 'POST',
      data: {
        "channelid": owner_id,
        "videoid": video_id,
        // "saved" : trueorfalse,
        action: trueorfalse,

      },
      success: function (response) {
        console.log("success");
      }
    });
  }
  $("#watchlater").click(function () {
    saveorwatchlater("add");
  });
  function saveorwatchlater(flag) {
    const player = videojs('my-video');
    let cur_time;
    if (flag == "add") {
      cur_time = '0'
    } else {
      cur_time = player.currentTime();
    }
    $.ajax({
      url: '/api/later.php',
      type: 'POST',
      data: {
        "channelid": owner_id,
        "videoid": video_id,
        "later": cur_time,
        action: flag,
      },
      success: function (response) {
        console.log("success");
      }
    });
  };

  $("#thumbup").click(function () {
    return rating("add");
  });
  $("#thumbdown").click(function () {
    return rating("remove");
  });

  function rating(rate) {
    $.ajax({
      url: '/api/like.php',
      type: 'POST',
      data: {
        "channelid": owner_id, 
        "videoid": video_id, 
        "liked": rate, 
        action: rate
      },
      success: function (response) {
        console.log(response);
      }
    })
  }
  var descriptionsContent = $("#descriptions-content");
  if (descriptionsContent.prop("scrollHeight") <= descriptionsContent.innerHeight()) {
    $('#more').remove();
  }
  $("#more").click(function () {
    
    // Toggle the 'auto' and 'hidden' classes on each click
    descriptionsContent.toggleClass('auto-height');

    // Set the height based on scroll height if 'auto' class is present
    if (descriptionsContent.hasClass('auto-height')) {
      descriptionsContent.css('overflow', 'auto');
      descriptionsContent.css('height', descriptionsContent.prop('scrollHeight') + 'px');
      $('#more').text('Less');

    } else {
      // Set the height to a fixed value or any other desired value
      $('#more').text('More');
      descriptionsContent.css('overflow', 'hidden');
      descriptionsContent.css('height', '71px');
    }
  });
  // $(document).ready(function () {
  //   var descriptionsContent = $("#descriptions-content");
  //   var moreButton = $("#more");

  //   // Check on page load
  //   toggleMoreButtonVisibility();

  //   moreButton.click(function () {
  //     descriptionsContent.toggleClass('auto-height');
  //     toggleMoreButtonVisibility();
  //   });

  //   function toggleMoreButtonVisibility() {
  //     var initialScrollHeight = descriptionsContent.prop('scrollHeight');

  //     // If content overflows, show the "More" button, else hide it
  //     moreButton.toggle(descriptionsContent.prop('scrollHeight') > initialScrollHeight);
  //   }
  // });



});
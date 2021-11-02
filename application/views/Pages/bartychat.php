<?php
  include "db.php";
?>
        <div class="categories-container noindex">
          <?php include"includes/cat_karusel.php"; ?>
          <div class="to-top">
              <p class="text-center">
                  <i class="fas fa-angle-up"></i>
              </p>
          </div>
    </header>
    <main>
        <div class="container">
            <p class="main-text">
                <a href="/" class="gray">Əsas Səhifə</a>
                <img src="/Images/arrow-right.svg" alt="">
                <a href="" class="black">BartiChat</a>
            </p>
            <section class="bartychat-container">
                <div class="bartyChat d-flex">
                    <div class="left-side">
                        <p class="bc-text">
                            <span>
                                <b>BartiChat</b>
                            </span>
                        </p>
                        <div class="search d-flex">
                            <div class="icon">
                                <img src="/Images/search-gray.svg" alt="">
                            </div>
                            <input type="search" name="" id="">
                        </div>
                        <div class="bc-profiles">
                            <div class="scrollBox1" id="box">
                                  <div class="contentBox">
                                      <div id="user_list"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="right-side">
                        <div class="profile-details d-flex">
                            <div class="back d-md-none">
                                <img src="/Images/previous.svg" alt="">
                            </div>
                            <div id="load_user"></div>
                        </div>
                        <p class="chatDate text-center"><?=date('d.m.Y') ?></p>
                        <div class="messages-container d-flex flex-column">
                            <div class="scrollBox2" id="box">
                                <div class="contentBox" id="contentBox">
                                    <div id="load_barti_chat"></div>
                                </div>
                            </div>
                        </div>
                        <div class="message">
                            <div class="d-flex message-container">
                                <div class="icons d-flex">
                                    <a href="" class="smile">
                                        <img src="/Images/smile.svg">
                                    </a>
                                    <div id="emojis" class="position-absolute"></div>
                                </div>
                                <div class="input">
                                    <form name='mform' method='post' onsubmit="return false;" id="mform">
                                        <input type="hidden" id="bartychat_token" name="<?=$this->security->get_csrf_token_name(); ?>" value="<?=$this->security->get_csrf_hash(); ?>">
                                        <input type="hidden" name="qid" value="<?=$qid; ?>">
                                        <input type="text" autocomplete="off" id='msg' name='msg' placeholder="Mesajınızı Yazın" onkeydown="ajax_submit(event);">
                                    </form>
                                </div>
                                <div class="like" onclick="ajax_button();">
                                    <img src="/Images/send.svg">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bc-ad">
                    <div class="image-container">
                        <img src="/Images/banner-4.png" alt="">
                    </div>
                </div>
            </section>
        </div>
    </main>


<script>

    var barty_token = $('#bartychat_token').val();

    $(document).ready(function(){
       setInterval(function(){
         $('#user_list').load("/pages/chatuserlistfetch", {otomoto: barty_token}).fadeIn("slow");
       }, 3000);
    });

    $(document).ready(function(){
       setInterval(function(){
         $('#load_user').load("/pages/chatuserfetch", {otomoto: barty_token}).fadeIn("slow");
       }, 1000);
    });

    $(document).on('click', '.uid_click', function(){
        var qid = $(this).attr("id");

        $.ajax({
            url:"/pages/chatuserfetch",
            method:"POST",
            data:{qid: qid, status: 1, otomoto: barty_token},
            success: function(data) {
                $('#modalpreview').html('');
                $('#modalpreview').append(data);
            }
        });
      });

      function ajax_submit(event)
      {
          var x = event.keyCode;
          if (x == 13) {
              $.ajax({
                  type:'POST',
                  url:'/pages/ajaxfetch',
                  data: {qid: $('form[name="mform"]').find('input[name="qid"]').val(),
                         msg: $('form[name="mform"]').find('input[name="msg"]').val(),
                         otomoto: barty_token
                        },
                  success: function(data){
                      $("#mform")[0].reset();
                  }
              });
          }
          return false;
      }

      function ajax_button()
      {
          $.ajax({
              type:'POST',
              url:'/pages/ajaxfetch',
              data: {qid: $('form[name="mform"]').find('input[name="qid"]').val(),
                     msg: $('form[name="mform"]').find('input[name="msg"]').val(),
                     otomoto: barty_token
                    },
              success: function(data){
                  $("#mform")[0].reset();
              }
          });
          return false;
      }

</script>
<script src="/Js/header.js" ></script>
<script src="/Js/bartychat.js"></script>

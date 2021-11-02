<?php

  function google_auth()
  {
    if(!isset($_SESSION['uid']))
    {
      $client_id = '137276581019-j835731t76o9bn6bb06furkvhv7s8rtk.apps.googleusercontent.com'; // Client ID
      $client_secret = '-xl_wsYQBs6YuRJI0sKLwocA'; // Client secret
      $redirect_uri = 'https://new.otomoto.az/'; // Redirect URIs

      $url = 'https://accounts.google.com/o/oauth2/auth';

      $params = array(
        'redirect_uri'  => $redirect_uri,
        'response_type' => 'code',
        'client_id'     => $client_id,
        'scope'         => 'https://www.googleapis.com/auth/userinfo.email https://www.googleapis.com/auth/userinfo.profile'
      );

      echo'<a href="' . $url . '?' . urldecode(http_build_query($params)) . '"><img src="/Images/Google-register.svg" alt=""></a>';
      include "google.php";
    }
  }

?>

<?=isset($add_header)?"<header>":''; ?>
  <div class="fixed">
      <div class="contacts">
          <div class="container">
              <p class="d-flex">
                  <span class="left">
                      <a href="/contact.php" class="ad">Saytda Reklam</a>
                      <a href="/contact.php" class="contact">Əlaqə</a>
                      <a href="https://www.facebook.com/bartiazerbaijan/" target="_blank" style="margin:0;"><i class="fab fa-facebook-f"></i></a>
                      <a href="https://www.instagram.com/bartiazerbaijan/" target="_blank" style="margin:0;"><i class="fab fa-instagram-square"></i></a>
                  </span>
                  <span class="ml-auto right">
                      <a class="like <?php if(!isset($_SESSION['uid'])){echo'nr';} ?>" <?php if(isset($_SESSION['uid'])){echo'href="/pages/choosenads"';} ?> style="cursor:pointer;">
                          <img src="/Images/heart.svg">
                          <img src="/Images/heart-red.svg" class="hover">
                      </a>
                      <a href="compare.php" class="compair <?php if(!isset($_SESSION['uid'])){echo'nr';} ?>">
                          <img src="/Images/compair.svg">
                          <img src="/Images/compair-red.svg" class="hover">
                      </a>
                  </span>
              </p>
          </div>
      </div>
      <div class="menu">
          <div class="container d-flex">
              <div class="logo">
                  <a href="/">
                      <img src="/Images/logo.svg">
                  </a>
              </div>

              <div class="mx-auto">
              </div>

              <div class="right text-center">
                  <div class="login">
                      <div class="login-container text-center">
                          <a href="#" <?php if(empty($_SESSION['uid'])) {echo'class="a"';} ?>>
                              <img src="/Images/user-icon.svg" alt="">
                              <img src="/Images/user-red.svg" class="red" alt="">
                              <?=(!empty($_SESSION['ad']))?'<b>'.$_SESSION['ad'].'</b>':'<b>Giriş</b>'; ?>
                          </a>

                          <?php
                          if(!empty($_SESSION['ad'])) {
                            echo '<i class="fas fa-angle-down"></i>
                                  <div class="login-dropdown">
                                    <nav>
                                      <ul>
                                          <li><p><a href="/dashboard/main">İdarə paneli</a></p></li>
                                          <li><p><a href="/dashboard/profile">Profil Ayarları</a></p></li>
                                          <li><p><a href="/dashboard">Mənim Elanlarım</a></p></li>
                                          <li><p><a href="/dashboard/favourite">Seçilmiş Elanlar</a></p></li>
                                          <li><p><a href="/auth/logout">Çıxış</a></p></li>
                                      </ul>
                                    </nav>
                                  </div>';
                            }
                          ?>
                      </div>
                      <div class="login-register">
                          <div class="login-register-container">
                              <div class="buttons">
                                  <div class="login-btn">
                                      <a href="" class="login-text">
                                          <span>Giriş</span>
                                      </a>
                                  </div>
                                  <a href="" class="register-btn">
                                      <span>Qeydiyyat</span>
                                  </a>
                              </div>
                          </div>
                      </div>
                  </div>
                  <div class="modal login-modal"></div>
                  <div class="register-dropdown">
                      <ul class="nav nav-tabs" id="myTab" role="tablist">
                          <li class="nav-item">
                              <a class="nav-link active" id="login-tab" data-toggle="tab" href="#login" role="tab" aria-controls="login" aria-selected="true">
                                  <b>Giriş</b>
                              </a>
                          </li>
                          <li class="nav-item">
                              <a class="nav-link" id="register-tab" data-toggle="tab" href="#register" role="tab" aria-controls="register" aria-selected="false">
                                  <b>Qeydiyyat</b>
                              </a>
                          </li>
                      </ul>
                      <div class="tab-content" id="myTabContent">
                          <div class="tab-pane fade show active" id="login" role="tabpanel" aria-labelledby="login-tab">
                              <div class="fb-google">
                                  <div class="col-md-12 google">
                                      <?php google_auth(); ?>
                                  </div>
                              </div>
                              <form name="sform" method="post" class="login-form" action="/auth/login">
                                <input type="hidden" id="token" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
                                  <div class="name">
                                      <label for="email">Telefon və ya E-mail
                                          <span class="asteriks">*</span>
                                      </label>
                                      <input type="text" required name="email">
                                  </div>
                                  <div class="password">
                                      <label for="password">Şifrəniz
                                          <span class="asteriks">*</span>
                                      </label>
                                      <input type="password" required name="password">
                                      <a href="forgetpassword.php" class="forget">Şifrənizi unutmusunuz?</a>
                                  </div>
                                  <button type="submit" class="submit mx-auto col-6 ssubmit">Giriş</button>
                              </form>
                          </div>
                          <div class="tab-pane fade" id="register" role="tabpanel" aria-labelledby="register-tab">
                              <div class="fb-google">
                                  <div class="col-md-12 google">
                                      <?php google_auth(); ?>
                                  </div>
                              </div>

                              <form name="rform" method="post" class="register-form" id="rform" action="/auth/registration">
                                <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
                                <div class="name">
                                    <label for="firstname">Adınız
                                        <span class="asteriks">*</span>
                                    </label>
                                    <input type="text" required name="firstname">
                                </div>
                                <div class="phone-email">
                                    <label for="email">E-mail
                                        <span class="asteriks">*</span>
                                    </label>
                                    <input type="text" required name="email">
                                </div>
                                <div class="phone-email">
                                    <label for="email">Telefon</label>
                                    <input type="text" required name="phone" class="phone_format">
                                </div>
                                <div class="password">
                                    <label for="passwd">Şifrəniz
                                        <span class="asteriks">*</span>
                                    </label>
                                    <input type="password" required name="passwd">
                                    <span class="eye">
                                        <svg aria-hidden="true" class="stUf5b" fill="currentColor" focusable="false" width="24px" height="24px" viewBox="0 0 24 24" xmlns="https://www.w3.org/2000/svg">
                                            <path d="M12,7c-2.48,0-4.5,2.02-4.5,4.5S9.52,16,12,16s4.5-2.02,4.5-4.5S14.48,7,12,7z M12,14.2c-1.49,0-2.7-1.21-2.7-2.7 c0-1.49,1.21-2.7,2.7-2.7s2.7,1.21,2.7,2.7C14.7,12.99,13.49,14.2,12,14.2z"></path>
                                            <path d="M12,4C7,4,2.73,7.11,1,11.5C2.73,15.89,7,19,12,19s9.27-3.11,11-7.5C21.27,7.11,17,4,12,4z M12,17 c-3.79,0-7.17-2.13-8.82-5.5C4.83,8.13,8.21,6,12,6s7.17,2.13,8.82,5.5C19.17,14.87,15.79,17,12,17z"></path>
                                        </svg>
                                    </span>
                                </div>
                                <div class="re-password">
                                    <label for="repasswd">Şifrənizi təsdiq edin
                                        <span class="asteriks">*</span>
                                    </label>
                                    <input type="password" required name="repasswd">
                                    <span class="eye">
                                        <svg aria-hidden="true" class="stUf5b" fill="currentColor" focusable="false" width="24px" height="24px" viewBox="0 0 24 24" xmlns="https://www.w3.org/2000/svg">
                                            <path d="M12,7c-2.48,0-4.5,2.02-4.5,4.5S9.52,16,12,16s4.5-2.02,4.5-4.5S14.48,7,12,7z M12,14.2c-1.49,0-2.7-1.21-2.7-2.7 c0-1.49,1.21-2.7,2.7-2.7s2.7,1.21,2.7,2.7C14.7,12.99,13.49,14.2,12,14.2z"></path>
                                            <path d="M12,4C7,4,2.73,7.11,1,11.5C2.73,15.89,7,19,12,19s9.27-3.11,11-7.5C21.27,7.11,17,4,12,4z M12,17 c-3.79,0-7.17-2.13-8.82-5.5C4.83,8.13,8.21,6,12,6s7.17,2.13,8.82,5.5C19.17,14.87,15.79,17,12,17z"></path>
                                        </svg>
                                    </span>
                                </div>
                                <button name="register" type="submit" class="submit mx-auto col-6 rsubmit">Qeydiyyat</button>
                              </form>
                          </div>
                      </div>
                  </div>
                  <p class="addAd">
                      <a href="/dashboard/addCar" target="_blank">Elan Yerləşdir</a>
                  </p>
              </div>
          </div>
      </div>
      <div class="success-modal"></div>


      <div class="menu-mobile">
          <div class="container">
              <div class="top d-flex">
                  <div class="logo">
                      <a href="/">
                          <img src="/Images/logo.svg">
                      </a>
                  </div>
                  <div class="user d-flex <?php if(!isset($_SESSION['uid'])){echo'mobile-logreg';} ?>">
                      <a href="<?php if(isset($_SESSION['uid'])){echo '/dashboard';}else{echo'#';} ?>">
                          <img src="<?php if(!empty($_SESSION['foto'])){echo $_SESSION['foto'];} else{echo'/Images/login-user.svg';} ?>" alt="">
                      </a>
                  </div>
              </div>
          </div>

  <?php if(empty($_SESSION['uid'])): ?>
          <div class="register-dropdown">
              <div class="rd-container" id="rd">
              <ul class="nav nav-tabs" id="myTab-mobile" role="tablist">
                  <li class="nav-item">
                      <a class="nav-link active" id="login-mobile-tab" data-toggle="tab" href="#login-mobile" role="tab" aria-controls="login-mobile" aria-selected="true">
                          <b>Giriş</b>
                      </a>
                  </li>
                  <li class="nav-item">
                      <a class="nav-link" id="register-mobile-tab" data-toggle="tab" href="#register-mobile" role="tab" aria-controls="register-mobile" aria-selected="false">
                          <b>Qeydiyyat</b>
                      </a>
                  </li>
              </ul>
              <div class="tab-content" id="myTabContent">
                  <div class="tab-pane fade show active" id="login-mobile" role="tabpanel" aria-labelledby="login-mobile-tab">
                      <div class="fb-google">
                          <div class="col-md-12 google">
                              <?php google_auth(); ?>
                          </div>
                      </div>
                      <form action="" method="post" class="login-form">
                        <input type="hidden" name="<?=$this->security->get_csrf_token_name(); ?>" value="<?=$this->security->get_csrf_hash(); ?>">
                          <div class="name">
                              <label for="name">Telefon və ya E-mail
                                  <span class="asteriks">*</span>
                              </label>
                              <input type="text" required name="email">
                          </div>
                          <div class="password">
                              <label for="password">Şifrəniz
                                  <span class="asteriks">*</span>
                              </label>
                              <input type="password" required name="password">
                              <a href="forgetpassword.php" class="forget">Şifrənizi unutmusunuz?</a>
                          </div>
                          <input type="submit" value="Göndər" class="submit mx-auto col-6">
                      </form>
                  </div>
                  <div class="tab-pane fade" id="register-mobile" role="tabpanel" aria-labelledby="register-mobile-tab">
                      <div class="fb-google">
                          <div class="col-md-12 google">
                              <?php google_auth(); ?>
                          </div>
                      </div>

                      <form name="mform" method="post" action="/auth/registration" class="register-form" id="rform">
                        <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
                        <div class="name">
                            <label for="firstname">Adınız
                                <span class="asteriks">*</span>
                            </label>
                            <input type="text" required name="firstname">
                        </div>
                        <div class="phone-email">
                            <label for="email">E-mail
                                <span class="asteriks">*</span>
                            </label>
                            <input type="text" required name="email">
                        </div>
                        <div class="phone-email">
                            <label for="email">Telefon
                            </label>
                            <input type="text" required name="phone" class="phone_format">
                        </div>
                        <div class="password">
                            <label for="passwd">Şifrəniz
                                <span class="asteriks">*</span>
                            </label>
                            <input type="password" required name="passwd">
                            <span class="eye">
                                <svg aria-hidden="true" class="stUf5b" fill="currentColor" focusable="false" width="24px" height="24px" viewBox="0 0 24 24" xmlns="https://www.w3.org/2000/svg">
                                    <path d="M12,7c-2.48,0-4.5,2.02-4.5,4.5S9.52,16,12,16s4.5-2.02,4.5-4.5S14.48,7,12,7z M12,14.2c-1.49,0-2.7-1.21-2.7-2.7 c0-1.49,1.21-2.7,2.7-2.7s2.7,1.21,2.7,2.7C14.7,12.99,13.49,14.2,12,14.2z"></path>
                                    <path d="M12,4C7,4,2.73,7.11,1,11.5C2.73,15.89,7,19,12,19s9.27-3.11,11-7.5C21.27,7.11,17,4,12,4z M12,17 c-3.79,0-7.17-2.13-8.82-5.5C4.83,8.13,8.21,6,12,6s7.17,2.13,8.82,5.5C19.17,14.87,15.79,17,12,17z"></path>
                                </svg>
                            </span>
                        </div>
                        <div class="re-password">
                            <label for="repasswd">Şifrənizi təsdiq edin
                                <span class="asteriks">*</span>
                            </label>
                            <input type="password" required name="repasswd">
                            <span class="eye">
                                <svg aria-hidden="true" class="stUf5b" fill="currentColor" focusable="false" width="24px" height="24px" viewBox="0 0 24 24" xmlns="https://www.w3.org/2000/svg">
                                    <path d="M12,7c-2.48,0-4.5,2.02-4.5,4.5S9.52,16,12,16s4.5-2.02,4.5-4.5S14.48,7,12,7z M12,14.2c-1.49,0-2.7-1.21-2.7-2.7 c0-1.49,1.21-2.7,2.7-2.7s2.7,1.21,2.7,2.7C14.7,12.99,13.49,14.2,12,14.2z"></path>
                                    <path d="M12,4C7,4,2.73,7.11,1,11.5C2.73,15.89,7,19,12,19s9.27-3.11,11-7.5C21.27,7.11,17,4,12,4z M12,17 c-3.79,0-7.17-2.13-8.82-5.5C4.83,8.13,8.21,6,12,6s7.17,2.13,8.82,5.5C19.17,14.87,15.79,17,12,17z"></path>
                                </svg>
                            </span>
                        </div>
                        <button name="register" type="submit" class="submit mx-auto col-6 msubmit">Qeydiyyat</button>
                      </form>
                  </div>
              </div>
              </div>
          </div>
        <?php endif; ?>
      </div>
  </div>

<script type="text/javascript">

var token = $('#token').val();

/*------ LOGIN ------*/

$(document).on('click', '.ssubmit', function() {
  event.preventDefault();
  $.ajax({
    type:'POST',
    url:'/auth/login',
    data: { otomoto: token,
            email: $('form[name="sform"]').find('input[name="email"]').val(),
            password: $('form[name="sform"]').find('input[name="password"]').val()
          },
    success: function(data){
      var res = $.parseJSON(data);
      if(res['message'] == 'success')
        setTimeout(function(){ location.reload(); }, 1000);
      else
        alert(res['message']);
    }
  });
});

/*----- REGISTRATION -----*/

function registration(form_name)
{
  event.preventDefault();
  $.ajax({
    type:'POST',
    url:'/auth/registration',
    data: { otomoto: token,
            firstname: $('form[name="'+ form_name +'"]').find('input[name="firstname"]').val(),
            email: $('form[name="'+ form_name +'"]').find('input[name="email"]').val(),
            phone: $('form[name="'+ form_name +'"]').find('input[name="phone"]').val(),
            passwd: $('form[name="'+ form_name +'"]').find('input[name="passwd"]').val(),
            repasswd: $('form[name="'+ form_name +'"]').find('input[name="repasswd"]').val()
          },
    success: function(data){
      if(data=='')
        $(".success-modal").append('<div class="row modal"><div class="modalbox success col-sm-6 col-md-5 col-lg-4 center animate"><div class="icon"><img src="/Images/okay.svg"></div><h1>Qeydiyyatınız uğurla baş tutdu! Artıq sistemə giriş edə bilərsiniz.</h1><a href="">Ok</a></div></div>');
      else
        $(".success-modal").append('<div class="row modal"><div class="modalbox error col-sm-6 col-md-5 col-lg-4 center animate"><div class="icon"><img src="/Images/error.svg"></div><h1>'+data+'</h1><button type="button" class="redo btn" onclick="Close()">Ok</button></div></div>');
    }
  });
}

$(document).on('click', '.rsubmit', function() {
  registration('rform');
});

/*------ MOBILE REGISTRATION ------*/

$(document).on('click', '.msubmit', function() {
  registration('mform');
});

/*----- PHONE INPUT -----*/

$('.phone_format')

  .keydown(function (e) {
    var key = e.which || e.charCode || e.keyCode || 0;
    $phone = $(this);

    // Don't let them remove the starting '('
    if ($phone.val().length === 1 && (key === 8 || key === 46)) {
      $phone.val('(');
      return false;
    }
    // Reset if they highlight and type over first char.
    else if ($phone.val().charAt(0) !== '(') {
      $phone.val('('+String.fromCharCode(e.keyCode)+'');
    }

    // Auto-format- do not expose the mask as the user begins to type
    if (key !== 8 && key !== 9) {
      if ($phone.val().length === 4) {
        $phone.val($phone.val() + ')');
      }
      if ($phone.val().length === 5) {
        $phone.val($phone.val() + ' ');
      }
      if ($phone.val().length === 9) {
        $phone.val($phone.val() + '-');
      }
      if ($phone.val().length === 12) {
        $phone.val($phone.val() + '-');
      }
    }

    // Allow numeric (and tab, backspace, delete) keys only
    if ($phone.val().length > 14)
      return (key == 8 ||
          key == 9 ||
          key == 46 ||
          (key >= 96 && key <= 105));
    else
      return (key == 8 ||
          key == 9 ||
          key == 46 ||
          (key >= 48 && key <= 57) ||
          (key >= 96 && key <= 105));
  })

  .bind('focus click', function () {
    $phone = $(this);

    if ($phone.val().length === 0) {
      $phone.val('(');
    }
    else {
      var val = $phone.val();
      $phone.val('').val(val); // Ensure cursor remains at the end
    }
  })

  .blur(function () {
    $phone = $(this);

    if ($phone.val() === '(') {
      $phone.val('');
    }
  });

</script>

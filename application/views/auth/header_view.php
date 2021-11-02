<?php
/*if(isset($_SESSION['uid'])){echo'<script src="Js/autologout.js"></script>';}*/
// include"on.php";
// include "application/views/token.php";
?>
        <div class="fixed">
            <div class="contacts">
                <div class="container">
                    <p class="d-flex">
                        <span class="left">
                            <a href="contact.php" class="ad">Saytda Reklam</a>
                            <a href="contact.php" class="contact">Əlaqə</a>
                            <a href="https://www.facebook.com/bartiazerbaijan/" target="_blank" style="margin:0;"><i class="fab fa-facebook-f"></i></a>
                            <a href="https://www.instagram.com/bartiazerbaijan/" target="_blank" style="margin:0;"><i class="fab fa-instagram-square"></i></a>
                            <!--<a href="" class="android">-->
                            <!--    <img src="Images/android.svg" alt="">-->
                            <!--</a>-->
                            <!--<a href="" class="apple">-->
                            <!--    <img src="Images/apple.svg" alt="">-->
                            <!--</a>-->
                        </span>
                        <span class="ml-auto right">
                            <a class="like <?php if(!isset($_SESSION['uid'])){echo'nr';} ?>" <?php if(isset($_SESSION['uid'])){echo'href="choosenads.php"';} ?> style="cursor:pointer;">
                                <img src="Images/heart.svg">
                                <img src="Images/heart-red.svg" class="hover">
                            </a>
                            <a href="bartychat.php" class="chat <?php if(!isset($_SESSION['uid'])){echo'nr';} ?>" <?php if(isset($_SESSION['uid'])){echo'href="bartychat.php"';} ?>>
                                <img src="Images/chat.svg">
                                <img src="Images/chat-red.svg" class="hover">
                            </a>
                            <a href="compare.php" class="compair <?php if(!isset($_SESSION['uid'])){echo'nr';} ?>">
                                <img src="Images/compair.svg">
                                <img src="Images/compair-red.svg" class="hover">
                            </a>
                            <!--<span class="drop-down">-->
                            <!--    <select class="select lang">-->
                            <!--        <option value="AZ" selected class="AZ"></option>-->
                            <!--        <option value="RU" class="RU"></option>-->
                            <!--    </select>-->
                            <!--</span>-->
                        </span>
                    </p>
                </div>
            </div>
            <div class="menu">
                <div class="container d-flex">
                    <div class="logo">
                        <a href="index.php">
                            <img src="Images/logo.svg">
                        </a>
                    </div>

                    <form action="products.php" method="post" class="mx-auto">
                    <div class="search">
                        <input type="search" name="sorgu" placeholder="Barti'də Axtar" value="<?php if(!empty($_POST['sorgu'])){echo $_POST['sorgu'];} ?>">
                        <select name="scat" class="cities">
                            <?php
                            echo'<option value="">Bütün kateqoriyalar</option>';
                            $scat=mysqli_query($con,"SELECT * FROM elancats WHERE maincat=0 AND altcat=0 AND subinfocat=0 AND id!=97");
                            while($infoscat=mysqli_fetch_array($scat))
                            {
                                echo'<option value="'.$infoscat['id'].'"'; if($infoscat['id']==$_POST['scat']) {echo'selected="true"';} echo'>'.$infoscat['ad'].'</option>';
                            }
                            ?>
                        </select>
                        <p class="text-center ml-auto">
                            <button type="submit"><img src="Images/search.svg"></button>
                        </p>
                    </div>
                    </form>

                    <div class="right text-center">
                        <div class="login">
                            <div class="login-container text-center">
                                <a href="#" <?php if(empty($_SESSION['uid'])) {echo'class="a"';} ?>>
                                    <img src="Images/user-icon.svg" alt="">
                                    <img src="Images/user-red.svg" class="red" alt="">
                            <?php

                            if(!empty($_SESSION['ad']))
                            {echo'<b>'.$_SESSION['ad'].'</b>';}
                            else
                            {echo'<b>Giriş</b>';}

                            ?>
                                </a>

                                    <?php
                                    if(!empty($_SESSION['ad']))
                                    {
                                    echo' <i class="fas fa-angle-down"></i>
                                <div class="login-dropdown">
                                <nav>
                                        <ul>
                                            <li>
                                                <p>
                                                    <a href="/pages/profile?p">Profil Ayarları</a>
                                                </p>
                                            </li>
                                            <li>
                                                <p>
                                                    <a href="myads.php?m">Mənim Elanlarım</a>
                                                </p>
                                            </li>
                                            <li>
                                                <p>
                                                    <a href="bartychat.php?c">BartiChat</a>
                                                </p>
                                            </li>
                                            <li>
                                                <p>
                                                    <a href="choosenads.php?f">Seçilmiş Elanlar</a>
                                                </p>
                                            </li>
                                            <li>
                                            <li>
                                                <p>
                                                    <a href="logout.php">Çıxış</a>
                                                </p>
                                            </li>
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
<?php
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

  echo'<a href="' . $url . '?' . urldecode(http_build_query($params)) . '"><img src="Images/Google-register.svg" alt=""></a>';
  include"google.php";
}
?>
                                        </div>
                                    </div>
                                    <form name="sform" method="post" class="login-form">
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
                                        <input type="hidden" name="signin">
                                        <button class="submit mx-auto col-6 ssubmit">Giriş</button>
                                    </form>


<script>
$(document).on('click', '.ssubmit', function() {
var form = document.sform;
var dataString = $(form).serialize();

$.ajax({
    type:'POST',
    url:'ajax.php',
    data: dataString,
    success: function(data){

        if(data==' ')
        {setTimeout(function(){ location.reload(); }, 1000);}
        else
        {alert(data);}

    }
});

// var token = $('#token').val();
// $.ajax({
//     url: '/index.php/Pages/login',
//     type: 'POST',
//     data: {email: $('form[name="sform"]').find('input[name="email"]').val(),
//            password: $('form[name="sform"]').find('input[name="password"]').val(),
//            otomoto: token
//           },
//     success: function(data){
//       console.log(data);
//     }
// });
return false;
});
</script>





                                </div>
                                <div class="tab-pane fade" id="register" role="tabpanel" aria-labelledby="register-tab">
                                    <div class="fb-google">
                                        <!--<div class="col-md-6 fb">-->
                                        <!--    <img src="Images/Facebook-register.svg" alt="">-->
                                        <!--</div>-->
                                        <div class="col-md-12 google">

<?php
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

echo'<a href="' . $url . '?' . urldecode(http_build_query($params)) . '"><img src="Images/Google-register.svg" alt=""></a>';
include"google.php";
}
?>



                                        </div>
                                    </div>






                                 <form name="rform" method="post" class="register-form" id="rform">
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
                                            <input type="text" required name="phone">
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
                                        <input type="hidden" name="register">
                                        <button name="register" class="submit mx-auto col-6 rsubmit">Qeydiyyat</button>
                                    </form>

<script>
$(document).on('click', '.rsubmit', function() {
var form = document.rform;
var dataString = $(form).serialize();

$.ajax({
    type:'POST',
    url:'ajax.php',
    data: dataString,
    success: function(data){
        if(data==' ')
        {$(".success-modal").append('<div class="row modal"><div class="modalbox success col-sm-6 col-md-5 col-lg-4 center animate"><div class="icon"><img src="Images/okay.svg"></div><h1>Qeydiyyatınız uğurla baş tutdu! Artıq sistemə giriş edə bilərsiniz.</h1><a href="">Ok</a></div></div>');}
        else
        {$(".success-modal").append('<div class="row modal"><div class="modalbox error col-sm-6 col-md-5 col-lg-4 center animate"><div class="icon"><img src="Images/error.svg"></div><h1>'+data+'</h1><button type="button" class="redo btn" onclick="Close()">Ok</button></div></div>');}

        }
});
return false;
});
</script>



                                </div>
                            </div>
                        </div>
                        <p class="addAd">
                            <a href="addad.php?elan">Elan Yerləşdir</a>
                        </p>
                    </div>
                </div>
            </div>
            <div class="success-modal"></div>


            <div class="menu-mobile">
                <div class="container">
                    <div class="top d-flex">
                        <div class="logo">
                            <a href="index.php">
                                <img src="Images/logo.svg">
                            </a>
                        </div>
                        <div class="user d-flex <?php if(!isset($_SESSION['uid'])){echo'mobile-logreg';} ?>">
                            <a href="<?php if(isset($_SESSION['uid'])){echo'myads.php';}else{echo'#';} ?>">
                                <img src="<?php if(!empty($_SESSION['foto'])){echo $_SESSION['foto'];} else{echo'Images/login-user.svg';} ?>" alt="">
                            </a>
                            <?php
                            // if(isset($_SESSION['uid'])){echo
                            // '<div class="logout">
                            //     <a href="logout.php">
                            //         <img src="Images/logout.svg">
                            //     </a>
                            // </div>';
                            // }
                            ?>
                        </div>
                    </div>
                    <div class="search">
                        <form action="products.php" method="post" class="mx-auto">
                        <input type="search" name="sorgu" placeholder="<?php if(empty($_POST['sorgu'])){echo"Barti'də Axtar";} else{echo $_POST['sorgu'];} ?>">
                        <p class="text-center ml-auto">
                            <button type="submit"><img src="Images/search.svg"></button>
                        </p>
                        </form>
                    </div>
                </div>

<?php
if(empty($_SESSION['uid']))
{
?>
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
                                <!--<div class="col-md-6 fb">-->
                                <!--    <img src="Images/Facebook-register.svg" alt="">-->
                                <!--</div>-->
                                <div class="col-md-12 google">

<?php
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

echo'<a href="' . $url . '?' . urldecode(http_build_query($params)) . '"><img src="Images/Google-register.svg" alt=""></a>';
include"google.php";
}
?>

                                </div>
                            </div>
                            <form action="" method="post" class="login-form">
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
                                <!--<div class="col-md-6 fb">-->
                                <!--    <img src="Images/Facebook-register.svg" alt="">-->
                                <!--</div>-->
                                <div class="col-md-12 google">
<?php
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

echo'<a href="' . $url . '?' . urldecode(http_build_query($params)) . '"><img src="Images/Google-register.svg" alt=""></a>';
include"google.php";
}
?>
                                </div>
                            </div>










                             <form name="mform" method="post" class="register-form" id="rform">

<script>
$(document).on('click', '.msubmit', function() {
var form = document.mform;
var dataString = $(form).serialize();

$.ajax({
    type:'POST',
    url:'ajax.php',
    data: dataString,
    success: function(data){
        if(data==' ')
        {$(".success-modal").append('<div class="row modal"><div class="modalbox success col-sm-6 col-md-5 col-lg-4 center animate"><div class="icon"><img src="Images/okay.svg"></div><h1>Qeydiyyatınız uğurla baş tutdu! Artıq sistemə giriş edə bilərsiniz.</h1><a href="">Ok</a></div></div>');}
        else
        {$(".success-modal").append('<div class="row modal"><div class="modalbox error col-sm-6 col-md-5 col-lg-4 center animate"><div class="icon"><img src="Images/error.svg"></div><h1>'+data+'</h1><button type="button" class="redo btn" onclick="Close()">Ok</button></div></div>');}

        }
});
return false;
});
</script>

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
                                            <input type="text" required name="phone">
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
                                        <input type="hidden" name="register">
                                        <button name="register" class="submit mx-auto col-6 msubmit">Qeydiyyat</button>
                                    </form>
                        </div>
                    </div>
                    </div>
                </div>
                <?php } ?>
            </div>
        </div>

<html>
  <head>
    <?php if(@$title == 'product'): ?>
      <title><?=$car->title; ?> - Otomoto.Az</title>
      <meta property="og:type" content="product" />
      <meta
        name="description"
        content="<?=$car->title.", ".$car->year.", ".$car->engine.", ".$car->mileage." km - ";
                  echo trim(strrev(chunk_split(strrev($car->price),3, ' ')));
                  if($car->currency == 0) echo ' ₼'; else if($car->currency == 1) echo ' $'; else if($car->currency == 2) echo ' €';
                  echo " - ".$car->additionalinfo; ?>"
      >
      <meta name="keywords" content="tuŕbo az,turbo az kredit maşinlar,turbo az masinlar,turboş,трбо аз,maşın,avtomobil,masin nomreleri,avtomobil az,masin az,masin sekli,kredit masin,masın al,kreditle masin,masin nömreleri,masin sekiler,avfto,avtomabil,avtomobil satisi,avtomobil satislari,avtomobil satışları,avtomobil satışı,gurcustan masin bazari,gurcustan masin sayti,kredit maşinlar,kredit maşınlar,kreditli masinlar,masin alqi satqi,masin alqi satqi saytlari,masin az,masin bazari,masin elani,masin elanlari,masin qiymeti,masin satislari,masin sayti,masinlar satisi,masın bazarı,masın satısı,maşin alqi satqisi,maşin bazari,maşin elanlari,maşın alqı satqı saytları,maşın satışı,maşınlar az,maşınlar qiymeti,maşınların alqı satqısı,qazel turbo az,tap az kredit maşınlar,tecili satilan masinlar turbo az,trboaz,turba az kia,turbaz,turbo az kredit,turbo az lada,turbo az mersedes dizel,turbo az ucuz masinlar,turboşaz,turda az,ucuz masinlar" />
      <meta property="og:image" content="<?=base_url(); ?>/assets/img/car_photos/800xauto/<?=$images[0]->name?$images[0]->name:''; ?>">
    <?php elseif(@$title == 'rent_product'): ?>
      <title><?=$car->title; ?> - Otomoto.Az</title>
      <meta property="og:type" content="product" />
      <meta
        name="description"
        content="<?=$car->title.", ".$car->year." - ";
                  echo trim(strrev(chunk_split(strrev($car->price),3, ' ')));
                  if($car->currency == 0) echo ' ₼'; else if($car->currency == 1) echo ' $'; else if($car->currency == 2) echo ' €';
                  echo " - ".$car->additionalinfo; ?>"
      >
    <?php else: ?>
      <title>Otomoto</title>
      <meta property="og:image:secure_url" content="<?=base_url(); ?>assets/img/car_photos/icons/otomoto_logo.png"></meta>
      <meta property="og:image:width" content="400" />
      <meta property="og:image:height" content="300" />
      <meta name="description" content="Otomoto.Az - Avtomobil elan saytı">
    <?php endif; ?>

    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-2L9HEXSC95"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());

      gtag('config', 'G-2L9HEXSC95');
    </script>
    <!-- Global site tag (gtag.js) - Google Analytics -->

    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" href="/assets/img/favicon.ico" type="image/ico">
    <link rel="stylesheet" href="/fonts/font-awesome.min.css">
    <link rel="stylesheet" href="/assets/css/header.css">

    <link rel="stylesheet" type="text/css"  href="/Css/bootstrap_4_5_0.min.css">
    <?php if(@$title != 'main-page' && @$title != 'product' && @$title != 'rent_product'): ?>
      <link rel="stylesheet" href="/assets/css/toastr.min.css">
      <script type="text/javascript"  src="/Js/jquery.min.js"></script>
      <script src="/assets/dashboard/toastr/toastr.min.js"></script>
    <?php endif; ?>
    <?php if(@$title == 'main-page' || @$title == 'rent_car'): ?>
      <link rel="stylesheet" type="text/css" href="/Css/style.css">
      <!-- <link rel="stylesheet" type="text/css"  href="/Css/owl.carousel.min.css"> -->
      <link rel="stylesheet" type="text/css" href="/assets/css/mainpage.css">
    <?php elseif(@$title == 'dashboard'): ?>
      <link rel="stylesheet" href="/assets/dashboard/css/main.css">
      <script src="/assets/dashboard/popper.min.js" ></script>
      <script src="/assets/dashboard/js/main.js"></script>
    <?php elseif(@$title == 'product'): ?>
      <?php if ($car->on_auction): ?>
        <link rel="stylesheet" type="text/css" href="/assets/css/flipclock.css">
      <?php endif; ?>
      <link rel="stylesheet" type="text/css" href="/assets/css/product.css">
      <link rel="stylesheet" type="text/css" href="/assets/css/fotorama.css">
    <?php elseif(@$title == 'rent_product'): ?>
      <link rel="stylesheet" type="text/css" href="/assets/css/product.css">
      <link rel="stylesheet" type="text/css" href="/assets/css/fotorama.css">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.0.1/css/tempusdominus-bootstrap-4.min.css" />
    <?php elseif(@$title == 'car_showroom'): ?>
      <link rel="stylesheet" type="text/css" href="/assets/css/car_showroom.css">
    <?php elseif(@$title == 'car_showroom_list'): ?>
      <link rel="stylesheet" type="text/css" href="/assets/css/car_showroom_list.css">
    <?php elseif(@$title == 'detailed_search' || @$title == 'rent_detailed_search'): ?>
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.css" />
      <link rel="stylesheet" type="text/css" href="/assets/css/detailed_search.css">
    <?php elseif(@$title == 'favourite'): ?>
      <link rel="stylesheet" type="text/css" href="/assets/css/favourite.css">
    <?php elseif(@$title == 'top_page' || @$title == 'rent_top_page' || @$title == 'simple'): ?>
      <link rel="stylesheet" type="text/css" href="/assets/css/favourite.css">
    <?php elseif(@$title == 'appraisement'): ?>
      <link rel="stylesheet" type="text/css" href="/assets/css/appraisement.css">
    <?php elseif(@$title == 'contact'): ?>
      <link rel="stylesheet" type="text/css" href="/assets/css/contact.css">
    <?php endif; ?>
  </head>
  <header>
    <div id="header">
      <div class="bar mobile_open2">
        <i class="fa fa-bars" aria-hidden="true"></i>
      </div>
      <a id="logo" href="/" style="display: flex; align-items: center;">
        <img src="/assets/img/car_photos/icons/otomoto_logo.png" class="cont_left" id="logo_part1">
      </a>
      <div id="header_right">
        <a href="/pages/favourite" class="favorit_ico">
          <i class="fa fa-heart-o" aria-hidden="true"></i>
        </a>
        <div id="user_submenu">
          <i class="fa fa-user-o" aria-hidden="true"></i>
          <div id="submenu">
            <?php if(@!$_SESSION['uid']){ ?>
              <span class="submenuSpan">Qeydiyyatdan keçmək:</span>
              <div class="sign" id="registration">Qeydiyyat</div>
              <span class="submenuSpan">Artıq qeydiyyatdan keçmisiz:</span>
              <div class="sign" id="signIn">Daxil ol</div>
            <?php } else { ?>
              <span class="submenuSpan2"><?=$_SESSION['ad']; ?></span>
              <a href="/dashboard/main" target="_blank" style="text-decoration:none;" class="submenuSpan3">
                <i class="fa fa-tachometer" aria-hidden="true"></i>
                İdarə paneli
              </a>
              <a href="/dashboard/profile" target="_blank" style="text-decoration:none;" class="submenuSpan3">
                <i class="fa fa-user-circle-o" aria-hidden="true"></i>
                Profil Ayarları
              </a>
              <a href="/dashboard" target="_blank" style="text-decoration:none;" class="submenuSpan3">
                <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                Mənim elanlarım
              </a>
              <?php if(@$is_salon): ?>
                <a href="/dashboard/rent_car" target="_blank" style="text-decoration:none;" class="submenuSpan3">
                  <i class="fa fa-volume-control-phone" aria-hidden="true"></i>
                  Rent a car
                </a>
              <?php endif; ?>
              <a href="/dashboard/favourite" target="_blank" style="text-decoration:none;" class="submenuSpan3">
                <i class="fa fa-star" aria-hidden="true"></i>
                Seçilmiş Elanlar
              </a>
              <a href="/auth/logout" class="submenuSpan3">
                <i class="fa fa-sign-out" aria-hidden="true"></i>
                Çıxış
              </a>
            <?php } ?>
          </div>
        </div>
        <?php if(@$is_salon): ?>
          <span class="new_ad_button">Elan Yerləşdir</span>
        <?php else: ?>
          <a class="new_ad_button" href="/dashboard/addCar" target="_blank">Elan Yerləşdir</a>
        <?php endif; ?>
      </div>
    </div>

    <div class="open_bar">
      <?php if(@!$_SESSION['uid']){ ?>
        <div class="line_row">
          <span class="submenuSpan">Qeydiyyatdan keçin:</span>
        </div>
        <div class="line_row">
          <div class="sign" id="registration2">Qeydiyyat</div>
        </div>
        <div class="line_row">
          <span class="submenuSpan">Artıq qeydiyyatdan keçmisiz:</span>
        </div>
        <div class="line_row">
          <div class="sign" id="signIn2">Daxil ol</div>
        </div>
      <?php } else { ?>
        <div class="line_row">
          <span class="submenuSpan2"><?=$_SESSION['ad']; ?></span>
        </div>
        <div class="line_row">
          <a href="/dashboard/main" target="_blank" style="text-decoration:none;" class="submenuSpan3">
            <i class="fa fa-tachometer" aria-hidden="true"></i>
            İdarə paneli
          </a>
        </div>
        <div class="line_row">
          <a href="/dashboard/profile" target="_blank" style="text-decoration:none;" class="submenuSpan3">
            <i class="fa fa-user-circle-o" aria-hidden="true"></i>
            Profil Ayarları
          </a>
        </div>
        <div class="line_row">
          <a href="/dashboard" target="_blank" style="text-decoration:none;" class="submenuSpan3">
            <i class="fa fa-shopping-cart" aria-hidden="true"></i>
            Mənim elanlarım
          </a>
        </div>
        <div class="line_row">
          <a href="/dashboard/favourite" target="_blank" style="text-decoration:none;" class="submenuSpan3">
            <i class="fa fa-star" aria-hidden="true"></i>
            Seçilmiş Elanlar
          </a>
        </div>
        <div class="line_row">
          <a href="/auth/logout" class="submenuSpan3">
            <i class="fa fa-sign-out" aria-hidden="true"></i>
            Çıxış
          </a>
        </div>
      <?php } ?>
    </div>

    <div class="zanaveska">
      <div class="flexStyle">
        <div id="login_form">
          <div id="title">
            <span class="login">Giriş</span>
            <span class="registration">Qeydiyyat</span>
          </div>
          <span id="close">x</span>
          <form id="loginForm" role="form" method="POST" action="/auth/login">
            <input type="hidden" name="<?=$this->security->get_csrf_token_name(); ?>" value="<?=$this->security->get_csrf_hash(); ?>">
            <label for="email">E-poçt</label>
            <input type="text" id="email" name="email"/>
            <label for="password">Şifrə</label>
            <div class="prostoy_div">
              <div id="eye" class="eye" onmousedown="view('eye', 'password')" onmouseup="noview('eye', 'password')"></div>
              <input type="password" id="password" name="password" />
            </div>
            <?php if($this->session->userdata('login_attempt') && $this->session->userdata('login_attempt') > 2): ?>
              <div class="forExcept">
                <div class="g-recaptcha" data-size="normal"	data-sitekey="6LePL1kaAAAAAFKoYi-R8aSqvexenrCIVxkIinIB"></div>
              </div>
            <?php endif; ?>
            <button type="submit">Daxil ol</button>
            <a href="/pages/recovery_pass" style="text-decoration: none;">
              <span>Şifrəni unutmuşam</span>
            </a>
          </form>

          <div id="forRegistrationScroll">
            <form id="registrationForm" role="form" method="POST" action="/auth/registration">
              <input type="hidden" name="<?=$this->security->get_csrf_token_name(); ?>" value="<?=$this->security->get_csrf_hash(); ?>">
              <input type="text" id="full_name" name="full_name" placeholder="Adınız...">
              <input type="text" id="mail" name="mail" placeholder="E-poçt..." >
              <input type="text" id="phone" name="phone" class="phone_format only_numeric" placeholder="Telefon..." />
              <div class="prostoy_div">
                <div id="eye2" class="eye eye2" onmousedown="view('eye2', 'password2')" onmouseup="noview('eye2', 'password2')"></div>
                <input type="password" id="password2" name="password2" placeholder="Şifrə..." />
              </div>
              <div class="prostoy_div">
                <div id="eye3" class="eye eye2" onmousedown="view('eye3', 'repeatPassword')" onmouseup="noview('eye3', 'repeatPassword')"></div>
                <input type="password" id="repeatPassword" name="repeatPassword" placeholder="Şifrəni təkrarla..." />
              </div>
              <!-- <div class="forExcept">
                <div class="g-recaptcha" data-sitekey="6LePL1kaAAAAAFKoYi-R8aSqvexenrCIVxkIinIB"></div>
              </div> -->
              <button type="submit">Qeydiyyat</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </header>
  <body>

    <?php if(isset($_SESSION['error'])) {?>
      <div class="alert alert-danger"><?=$_SESSION['error']; ?></div>
    <?php }?>
    <?php if(isset($_SESSION['success'])) {?>
      <div class="alert alert-success"><?php echo $_SESSION['success']; ?></div>
    <?php }?>

    <div class="buttons_shadow">
      <div class="buttons_form">
        <i class="fa fa-close buttons_close" aria-hidden="true"></i>
        <a href="/dashboard/addCar" target="_blank" class="btn btn-primary">Sadə elan</a>
        <a href="/rent/add_rent_car" target="_blank" class="btn btn-danger">Rent a car</a>
      </div>
    </div>


    <div class="fm">
      <div class="fmc mobile_home">
        <a href="/">
          <div class="fmci">
            <i class="fa fa-home" aria-hidden="true"></i>
          </div>
          <span class="fmct mobile_text">Əsas</span>
        </a>
      </div>

      <div class="fmc mobile_category">
        <div class="fmci">
          <img src="/assets/img/header_icon.png" style="width: 20px; height: 20px; margin-bottom: 5px;">
        </div>
        <span class="fmct">Kateqoriyalar</span>
      </div>

      <div class="fmc" style="top: -25px;">
        <a href="<?=@$is_salon?'#':'/dashboard/addCar'; ?>" class="<?=@$is_salon?'open_buttons':''; ?>">
          <div class="fmci">
            <div class="fmcmi">
              <i class="fa fa-plus" aria-hidden="true"></i>
            </div>
          </div>
          <span class="fmct">Yeni elan</span>
        </a>
      </div>

      <div class="fmc">
        <a href="tel:055 266 77 30">
          <div class="fmci">
            <i class="fa fa-phone" aria-hidden="true"></i>
          </div>
          <span class="fmct">Dəstək</span>
        </a>
      </div>

      <div class="fmc">
        <a href="/dashboard/main" class="<?=$this->session->userdata('uid')?'':'open_login'; ?>">
          <div class="fmci">
            <i class="fa fa-user-circle" aria-hidden="true"></i>
          </div>
          <span class="fmct">İdarə paneli</span>
        </a>
      </div>
    </div>


    <div class="cat_mob_win">
      <div class="cat_min_head">
        <button type="button" class="cat_mob_back btn btn-default">
          <i class="fa fa-chevron-left" aria-hidden="true"></i>
          Geri
        </button>
        <span class="cat_head_title">Kateqoriyalar</span>
      </div>
      <div class="cat_mob_row">

        <a href="/pages/index?search=1">
          <div class="cat_mob_block">
            <div class="mobile_circle_div mobile_all_ads_div"></div>
            <div class="cat_mob_block_content">
              <span>Bütün elanlar</span>
            </div>
          </div>
        </a>

        <a href="/pages/rent_car">
          <div class="cat_mob_block">
            <div class="mobile_circle_div mobile_rent_div"></div>
            <div class="cat_mob_block_content">
              <span>Rent a car</span>
            </div>
          </div>
        </a>

        <a href="/car_showroom">
          <div class="cat_mob_block">
              <div class="mobile_circle_div mobile_showroom_div"></div>
              <div class="cat_mob_block_content">
                <span>Avtosalonlar</span>
              </div>
          </div>
        </a>

        <a href="/pages/auction">
          <div class="cat_mob_block">
            <div class="mobile_circle_div mobile_auction_div"></div>
            <div class="cat_mob_block_content">
              <span>Hərrac</span>
            </div>
          </div>
        </a>

        <a href="/pages/appraisement">
          <div class="cat_mob_block">
            <div class="mobile_circle_div mobile_calculate_div"></div>
            <div class="cat_mob_block_content">
              <span>Qiymətləndirmə</span>
            </div>
          </div>
        </a>

      </div>
    </div>

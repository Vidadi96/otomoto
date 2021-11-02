<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="/assets/dashboard/css/main.css">
    <link rel="stylesheet" href="/assets/dashboard/bootstrap.min.css">
    <script src="/assets/dashboard/jquery.min.js"></script>
    <script src="/assets/dashboard/bootstrap.min.js"></script>
    <script src="/assets/dashboard/popper.min.js" ></script>
    <script src="/assets/dashboard/js/main.js"></script>

    <link rel="stylesheet" href="/assets/dashboard/toastr/toastr.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- <script src="https://kit.fontawesome.com/a076d05399.js"></script> -->
    <!-- <script src='https://kit.fontawesome.com/a076d05399.js'></script> -->
    <title>Şəxsi kabinet</title>
  </head>
  <body>
    <div class="container-fluid">
      <div class="row">
        <?php
          $adscount = $this->session->userdata('adsCount');
          $adsfavcount = $this->session->userdata('adsFavCount');
        ?>
        <!-- <div class="col-md-10 offset-md-1">
          <nav class="navbar navbar-expand-lg navbar-dark bg-dark lang-social">
            <ul class="navbar-nav mr-auto">
              <li class="nav-item active">
                <a class="nav-link"> <img src="/assets/dashboard/lang/az.png" alt=""></a>
              </li>
            </ul>
            <ul class="navbar-nav ml-auto">
              <li class="nav-item">
                <a class="nav-link"><i class="fa fa-facebook" ></i></a>
              </li>
              <li class="nav-item dropdown">
                  <a class="nav-link"><i class="fa fa-instagram" ></i></a>
              </li>
              <li>
                  <a class="nav-link"><i class="fa fa-whatsapp" ></i></a>
              </li>
            </ul>
          </nav>
        </div> -->
        <div class="col-md-10 offset-md-1">
          <nav class="navbar navbar-expand-lg navbar-dark bg-dark lang-social">
            <ul class="navbar-nav mr-auto">
              <li class="nav-item active">
                <a href="/" class="nav-link"> <img class="otomoto-logo" src="/assets/img/car_photos/logo/logo.svg" alt=""></a>
              </li>
            </ul>
            <ul class="navbar-nav ml-auto">
              <li class="nav-item user-info">
                <?php if($this->session->userdata('uid')){ ?>
              <a class="nav-link"> <button type="button" class="btn btn-default btn-lg" name="button"> <img src="/assets/img/car_photos/logo/user-icon.svg" alt="">&nbsp;&nbsp;&nbsp;&nbsp;<?=(!$this->session->userdata('uid'))?'Giriş':$this->session->userdata('ad')?>&nbsp;&nbsp;&nbsp;&nbsp;</button></a>
                <?php } ?>
                <ul class="navbar-dropdown-list user-menu" >
                  <li></li>
                  <li> <a href="/dashboard">"<?=$this->session->userdata('ad');?>"</a> &ensp; <a href="/dashboard/profile"> <span class="user-config" > <i class="fa fa-cog" ></i> </span> </a> </li>
                  <li> <a href="/dashboard">Mənim elanlarım (<?=$adscount;?>)</a> </li>
                  <li> <a href="/dashboard/favourite">Seçilmişlər (<?=$adsfavcount;?>)</a> </li>
                  <li> <hr> </li>
                  <li> <a href="/auth/logout"> <i class="fa fa-power-off" ></i> Çıxış </a></li>
                </ul>
              </li>
              <li class="nav-item dropdown">
                  <a href="/dashboard/addCar" class="nav-link"> <button class="btn btn-danger btn-lg" type="button" name="button">Elan Yerləşdir</button> </a>
              </li>
            </ul>
          </nav>
        </div>

      </div>

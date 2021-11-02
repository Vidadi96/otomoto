    <footer>
        <div class="row" style="margin: 0px;">
          <div class="col-md-3 my_pad_10_15">
            <div class="footer_line">
              <a href="tel:+994 55 266 77 30">
                <i class="fa fa-phone"></i> (+994) 55 266 77 30
              </a>
            </div>
            <div class="footer_line">
              <a href="mailto:info@new.otomoto.az">
                <i class="fa fa-envelope-o"></i> info@otomoto.az
              </a>
            </div>
            <div class="footer_line">
              <span><i class="fa fa-map-marker"></i> Yasamal, Hasan Məcidov 7</span>
            </div>
          </div>
          <div class="col-md-3 my_pad_10_15">
            <div class="footer_line">
              <a href="/dashboard/addCar">Elan Yerləşdir</a>
            </div>
          </div>
          <div class="col-md-3 my_pad_10_15">
            <div class="footer_line">
              <a href="/pages/contact">Saytda Reklam</a>
            </div>
            <div class="footer_line">
              <a href="/pages/agreement" target="_blank">İstifadəçi razılaşması</a>
            </div>
          </div>
          <div class="col-md-3 my_pad_10_15">
            <div class="footer_line">
              <span>Avtomobil elan saytı</span>
            </div>
            <div class="footer_line">
              <a href="#"><i class="fa fa-instagram"></i></a>
              <a href="#"><i class="fa fa-facebook-square"></i></a>
            </div>
          </div>
        </div>
        <div class="row" style="margin: 0px;">
          <div class="col-md-12 text-center">
            <div class="footer_line">
              <span> © Bütün hüquqlar qorunur 2021</span>
            </div>
          </div>
        </div>
        <div class="live_internet">

        </div>
        <!-- <div class="vi_counter">
          <div class="vi_counter_line">
            <span class="vi_counter_title">Son ay</span>
            <div class="vi_counter_data_block">
              <span><?//=($last_31_day && @$last_31_day->views)?number_format($last_31_day->views, 0, ".", " "):0; ?></span>
              <span><?//=($last_31_day && @$last_31_day->count)?number_format($last_31_day->count, 0, ".", " "):0; ?></span>
            </div>
          </div>
          <div class="vi_counter_line">
            <span class="vi_counter_title">Son 7 gün</span>
            <div class="vi_counter_data_block">
              <span><?//=($last_7_day && @$last_7_day->views)?number_format($last_7_day->views, 0, ".", " "):0; ?></span>
              <span><?//=($last_7_day && @$last_7_day->count)?number_format($last_7_day->count, 0, ".", " "):0; ?></span>
            </div>
          </div>
          <div class="vi_counter_line">
            <span class="vi_counter_title">Son 24 saat</span>
            <div class="vi_counter_data_block">
              <span><?//=($last_24_hours && @$last_24_hours->views)?number_format($last_24_hours->views, 0, ".", " "):0; ?></span>
              <span><?//=($last_24_hours && @$last_24_hours->count)?number_format($last_24_hours->count, 0, ".", " "):0; ?></span>
            </div>
          </div>
          <div class="vi_counter_line">
            <span class="vi_counter_title">Bugün</span>
            <div class="vi_counter_data_block">
              <span><?//=($today && @$today->views)?number_format($today->views, 0, ".", " "):0; ?></span>
              <span><?//=($today && @$today->count)?number_format($today->count, 0, ".", " "):0; ?></span>
            </div>
          </div>
          <div class="vi_counter_line">
            <span class="vi_counter_title">Onlayn</span>
            <div class="vi_counter_data_block">
              <span><?//=($online && @$online->views)?number_format($online->views, 0, ".", " "):0; ?></span>
              <span><?//=($online && @$online->count)?number_format($online->count, 0, ".", " "):0; ?></span>
            </div>
          </div>
        </div> -->
    </footer>


    <?php if(!$this->session->userdata('uid')): ?>
      <?php if($this->session->userdata('login_attempt') && $this->session->userdata('login_attempt') > 2): ?>
        <script src="https://www.google.com/recaptcha/api.js" async defer></script>
      <?php endif; ?>
    <?php endif;?>

    <?php if(@$title == 'main-page' || @$title == 'product' || @$title == 'rent_car' || @$title == 'rent_product'): ?>
      <link rel="stylesheet" href="/assets/css/toastr.min.css">
      <script type="text/javascript"  src="/Js/jquery.min.js"></script>
      <script src="/assets/dashboard/toastr/toastr.min.js"></script>
    <?php endif; ?>

    <?php if(@$title == 'main-page'): ?>
      <!-- <script type="text/javascript"  src="/Js/owl.carousel.min.js"></script> -->
      <script type="text/javascript" src="/assets/js/mainpage.js"></script>
    <?php endif; ?>

    <?php if(@$title == 'rent_car'): ?>
      <script type="text/javascript" src="/assets/js/rent_car.js"></script>
    <?php endif; ?>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.bundle.min.js"></script>
    <script type="text/javascript" src="/assets/js/jquery.validate.min.js"></script>
    <script src="/assets/js/tez_header.js"></script>

    <?php if(@$title == 'product'): ?>
      <?php if($car->autosalon): ?>

      <?php endif; ?>
      <script src="/assets/js/fotorama.js"></script>
      <?php if ($car->on_auction): ?>
        <script src="/assets/js/flipclock.js"></script>
        <script src="/assets/js/my_flipclock.js"></script>
      <?php endif; ?>
      <script src="/assets/js/product.js" ></script>
    <?php elseif(@$title == 'rent_product'): ?>

      <script src="/assets/js/fotorama.js"></script>
      <script type="text/javascript" src="/assets/js/moment.min.js"></script>
      <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.0.1/js/tempusdominus-bootstrap-4.min.js"></script>
      <script src="/assets/js/rent_product.js"></script>
    <?php elseif(@$title == 'car_showroom'): ?>

      <script src="/assets/js/car_showroom.js"></script>
    <?php elseif(@$title == 'detailed_search'): ?>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>
      <script src="/assets/js/detailed_search.js"></script>
    <?php elseif(@$title == 'rent_detailed_search'): ?>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>
      <script src="/assets/js/rent_detailed_search.js"></script>
    <?php elseif(@$title == 'favourite'): ?>
      <script src="/assets/js/favourite.js"></script>
    <?php elseif(@$title == 'top_page'): ?>
      <script src="/assets/js/favourite.js"></script>
      <script src="/assets/js/top_page.js"></script>
    <?php elseif(@$title == 'simple'): ?>
      <script src="/assets/js/favourite.js"></script>
      <script src="/assets/js/simple.js"></script>
    <?php elseif(@$title == 'rent_top_page'): ?>
      <script src="/assets/js/favourite.js"></script>
      <script src="/assets/js/rent_top_page.js"></script>
    <?php elseif(@$title == 'appraisement'): ?>
      <script src="/assets/js/appraisement.js"></script>
    <?php elseif(@$title == 'contact'): ?>
      <script src="/assets/js/contact.js"></script>
    <?php endif; ?>
  </body>
</html>

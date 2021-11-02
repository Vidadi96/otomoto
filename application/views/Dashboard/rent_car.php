<div class="right_content">
  <div class="wrapper">
    <br>
    <div class="row">
      <div class="index_head_left">
        <label for="">&nbsp;</label><br>
        <h3>Elanlarım (Rent a car)</h3>
        <sub style="bottom: 0px; font-size: 13px; line-height: 12px;" ><i class="fa fa-info-circle" style="color:#5b93a2" ></i>&nbsp;Silmək üçün deaktiv edin</sub>
      </div>
      <div class="index_head_right">
        <form class="sort-form" style="margin: 0px" action="/dashboard/rent_car" method="get">
          <label>Sırala</label>
          <select class="form-control" name="sort">
            <option <?=($this->input->get('sort') == 1)?'selected':''; ?> value="1">Hamısı</option>
            <option <?=($this->input->get('sort') == 2)?'selected':''; ?> value="2">Gözləyən</option>
            <option <?=($this->input->get('sort') == 3)?'selected':''; ?> value="3">Deaktiv</option>
          </select>
        </form>
      </div>
    </div>

    <hr>
    <div class="row car-info">
      <?php foreach($rent_cars as $row){ ?>
        <div class="col-md-4 <?=($row->car_status == 1 || $row->status == 2 || $row->status == 0)?'sold-car':''; ?>">
          <div class="img" style="background-image: url('/assets/img/rent_car_photos/800xauto/<?=$row->image; ?>'); background-color: #ccc;">
            <?php if ($row->status != 0) { ?>
            <div class="floated photo-count"> <i class="fa fa-camera" ></i> <span class="photo-count-span" ><?=@$row->photo_count; ?></span> </div>
            <div class="floated watch-count"><i class="fa fa-eye" ></i> <span class="watch-count-span" ><?=@$row->counter; ?></span></div>
            <div style="top: 95px" class="floated2 onhover edit"> <a href="/rent/edit_rent_car/<?=$row->id; ?>"> <span>Redaktə et&nbsp;</span><i class="fa fa-edit"></i></a></div>
            <div class="floated2 onhover <?=($row->status==2)?'disable':'notdisable'; ?> deactive-pending">
              <a href="/dashboard/change_rent_status/<?=$row->id?>?status=<?=($row->status==2)?'1':'2'; ?> ">
                <span><?=($row->status==2)?'Aktiv et':'Deaktiv et'; ?>&nbsp;</span>
                <i class="fa <?=($row->status==2)?'fa-eye':'fa-eye-slash'; ?>"></i>
              </a>
            </div>
            <?php if ($row->status==2): ?>
              <div class="floated onhover remove remove-pending">
                <a href="/dashboard/remove_rent_car/<?=$row->id; ?>">
                  <i class="fa fa-trash"></i>
                </a>
              </div>
            <?php endif; ?>
            <div class="floated onhover <?=($row->favourite==1)?'myfavourite':'nofavourite'?> star" data-fav=<?=$row->favourite;?> data-id=<?=$row->id?>> <a href="#"> <i class="fa fa-star"></i></a></div>

            <div class="floated2 onhover fire p_do_top_plus" data="<?=$row->id; ?>"><span>Top +&nbsp;</span><img src="/assets/img/car_photos/icons/new_fire2.ico" title="Vip" alt="Top +"></div>
            <div class="floated2 onhover kubok p_do_top" data="<?=$row->id; ?>"><span>Top&nbsp;</span><img src="/assets/img/car_photos/icons/new_kubok2.ico" title="Top" alt="Top"></div>

          <?php } else { ?>

            <div class="pending-wrapper">
              <div class="pending">
                <p>Təsdiqləmədədi...</p>
                <div class="link-btn">
                  <a href="/rent/edit_rent_car/<?=$row->id; ?>">
                    <button type="button" class="btn btn-warning" name="button">
                      Redaktə et
                      <i class="fa fa-edit"></i>
                    </button>
                  </a>
                  <a class="remove-pending" href="/dashboard/remove_rent_car/<?=$row->id; ?>">
                    <button type="button" class="btn btn-danger" name="button">
                      Sil
                      <i class="fa fa-trash"></i>
                    </button>
                  </a>
                </div>
              </div>
            </div>
          <?php } ?>
          </div>
          <hr class="mobile_none_hr">
        </div>
        <div class="col-md-8 <?=($row->status == 2 || $row->status == 0 )?'sold-car':''; ?>">
          <div class="row">
            <div class="col-md-7">
              <div class="car-name">
                <h4>
                  <span class="car-mark" ><?=$row->mark_name; ?></span>
                  &nbsp;
                  <span class="car-model" ><?=$row->model_name; ?></span>
                  &nbsp;
                  <span class="car-year" ><?=$row->year; ?></span>
                </h4>
              </div>
            </div>
            <div class="col-md-5">
              <div class="car-price">
                <p><?=$row->price; if($row->currency==0) echo "AZN"; elseif ($row->currency == 1) echo "USD"; else echo "EUR"; ?></p>
              </div>
            </div>
          </div>
          <div class="row bottom_line">
            <div class="col-md-2 info-wrapper">
              <div class="mileage">
                <span>
                  <i class="fa fa-road"></i>
                  <label for="">YÜRÜŞ</label>
                  <p><?=$row->mileage; ?></p>
                </span>
              </div>
            </div>
            <div class="col-md-3 info-wrapper">
              <div class="mileage">
                <span>
                  <i class="fa fa-cog" ></i>
                  <label for="">YANACAQ</label>
                  <p><?=$row->fuel; ?></p>
                </span>
              </div>
            </div>
            <div class="col-md-3 info-wrapper">
              <div class="mileage">
                <span>
                  <i class="fa fa-cogs"></i>
                  <label for="">MÜHƏRRİK</label>
                  <p><?=$row->engine; ?></p>
                </span>
              </div>
            </div>
            <div class="col-md-4">
              <div class="mileage">
                <span>
                  <i class="fa fa-cogs" ></i>
                  <label for="">SÜRƏTLƏR QUTUSU</label>
                  <p><?=$row->transmission; ?></p>
                </span>
              </div>
            </div>
          </div>
        </div>
      <?php } ?>
    </div>
  </div>
  <div id="demo" class="carousel slide" data-ride="carousel">
    <!-- Indicators -->
    <ul class="carousel-indicators">
      <li data-target="#demo" data-slide-to="0" class="active"></li>
      <li data-target="#demo" data-slide-to="1"></li>
      <li data-target="#demo" data-slide-to="2"></li>
    </ul>
    <!-- The slideshow -->
    <div class="carousel-inner">
      <div class="carousel-item active">
        <img
          src="/assets/img/car_photos/800xauto/e-learning.jpg"
          alt="Los Angeles"
          width="1100"
          height="500"
        >
      </div>
      <div class="carousel-item">
        <img
          src="/assets/img/car_photos/800xauto/e-learning.jpg"
          alt="Chicago"
          width="1100"
          height="500"
        >
      </div>
      <div class="carousel-item">
        <img
          src="/assets/img/car_photos/800xauto/e-learning.jpg"
          alt="New York"
          width="1100"
          height="500"
        >
      </div>
    </div>
    <!-- Left and right controls -->
    <a class="carousel-control-prev" href="#demo" data-slide="prev">
      <span class="carousel-control-prev-icon"></span>
    </a>
    <a class="carousel-control-next" href="#demo" data-slide="next">
      <span class="carousel-control-next-icon"></span>
    </a>
  </div>
</div>

<div class="p_pin_curtain4">
  <div class="p_pin_block_edit4">
    <form class="" action="/payment/rent_do_top" method="post">
      <input id="token" type="hidden" name="<?=$this->security->get_csrf_token_name(); ?>" value="<?=$this->security->get_csrf_hash(); ?>">
      <input type="hidden" name="carad_id" value="">
      <span class="p_top_title">Elanınız TOP bölməsinə keçiriləcək</span>
      <span class="p_top_descrition">
        <span>Sizin elan saytın ana səhifəsində <b>TOP</b> bölməsində görünəcək.</span>
        <span><b>İRƏLİ ÇƏK:</b> qiymətə daxildi</span>
        <span>Elanınız son elanlar bölməsində və axtarış nəticələrində birinci yerə qalxacaq.</span>
      </span>
      <span class="p_top_content">Xidmətin müddətini seçin:</span>
      <div class="p_top_radio">
        <input checked type="radio" id="top_one_day" name="action_id" value="1">
        <label for="top_one_day">1 gün / 1 ₼ / İrəli çək 1 dəfə</label>
      </div>
      <div class="p_top_radio">
        <input type="radio" id="top_five_days" name="action_id" value="6">
        <label for="top_five_days">5 gün / 5 ₼ / İrəli çək 5 dəfə</label>
      </div>
      <div class="p_top_radio">
        <input type="radio" id="top_fifteen_days" name="action_id" value="8">
        <label for="top_fifteen_days">15 gün / 9 ₼ / İrəli çək 15 dəfə</label>
      </div>
      <div class="p_top_radio">
        <input type="radio" id="top_thirty_days" name="action_id" value="10">
        <label for="top_thirty_days">30 gün / 15 ₼ / İrəli çək 30 dəfə</label>
      </div>
      <br>
      <span class="p_top_content">Ödəniş növünü seçin:</span>
      <div class="p_top_radio">
        <input type="radio" checked id="top_cart" name="payment_type" value="1" class="top_payment_type">
        <label for="top_cart">Bank kartı ilə</label>
      </div>
      <?php if($this->session->userdata('uid')): ?>
        <div class="p_top_radio">
          <input type="radio" id="top_balance" name="payment_type" value="0" class="top_payment_type">
          <label for="top_balance">Balansdan ödə</label>
        </div>
      <?php endif; ?>
      <div style="position: relative; float: left; width: 100%; margin-top: 10px;"></div>
      <!-- <div class="p_top_card_types">
        <span class="p_top_content">Kartın növünü seçin:</span>
        <div class="p_top_radio">
          <input checked type="radio" id="top_visa" name="cardType" value="v">
          <label for="top_visa">Visa</label>
        </div>
        <div class="p_top_radio">
          <input type="radio" id="top_master" name="cardType" value="m">
          <label for="top_master">Mastercard</label>
        </div>
      </div> -->
      <button type="button" class="p_edit_cancel4">İmtina</button>
      <button type="submit" class="p_edit3">Ödə</button>
    </form>
  </div>
</div>

<div class="p_pin_curtain5">
  <div class="p_pin_block_edit5">
    <form class="" action="/payment/rent_do_top" method="post">
      <input type="hidden" name="<?=$this->security->get_csrf_token_name(); ?>" value="<?=$this->security->get_csrf_hash(); ?>">
      <input type="hidden" name="carad_id" value="">
      <span class="p_top_title">Elanınız VIP bölməsinə keçiriləcək</span>
      <span class="p_top_descrition">
        <span>Sizin elan saytın ana səhifəsində <b>VIP</b> bölməsində görünəcək.</span>
        <span><b>İRƏLİ ÇƏK:</b> qiymətə daxildi</span>
        <span>Elanınız son elanlar bölməsində və axtarış nəticələrində birinci yerə qalxacaq.</span>
      </span>
      <span class="p_top_content">Xidmətin müddətini seçin:</span>
      <div class="p_top_radio">
        <input checked type="radio" id="top_plus_one_day" name="action_id" value="2">
        <label for="top_plus_one_day">1 gün / 2 ₼ / İrəli çək 1 dəfə</label>
      </div>
      <div class="p_top_radio">
        <input type="radio" id="top_plus_five_days" name="action_id" value="7">
        <label for="top_plus_five_days">5 gün / 10 ₼ / İrəli çək 5 dəfə</label>
      </div>
      <div class="p_top_radio">
        <input type="radio" id="top_plus_fifteen_days" name="action_id" value="9">
        <label for="top_plus_fifteen_days">15 gün / 18 ₼ / İrəli çək 15 dəfə</label>
      </div>
      <div class="p_top_radio">
        <input type="radio" id="top_plus_thirty_days" name="action_id" value="11">
        <label for="top_plus_thirty_days">30 gün / 30 ₼ / İrəli çək 30 dəfə</label>
      </div>
      <br>
      <span class="p_top_content">Ödəniş növünü seçin:</span>
      <div class="p_top_radio">
        <input type="radio" checked id="top_plus_cart" name="payment_type" value="1" class="top_plus_payment_type">
        <label for="top_plus_cart">Bank kartı ilə</label>
      </div>
      <?php if($this->session->userdata('uid')): ?>
        <div class="p_top_radio">
          <input type="radio" id="top_plus_balance" name="payment_type" value="0" class="top_plus_payment_type">
          <label for="top_plus_balance">Balansdan ödə</label>
        </div>
      <?php endif; ?>
      <div style="position: relative; float: left; width: 100%; margin-top: 10px;"></div>
      <!-- <div class="p_top_plus_card_types">
        <span class="p_top_content">Kartın növünü seçin:</span>
        <div class="p_top_radio">
          <input checked type="radio" id="top_plus_visa" name="cardType" value="v">
          <label for="top_plus_visa">Visa</label>
        </div>
        <div class="p_top_radio">
          <input type="radio" id="top_plus_master" name="cardType" value="m">
          <label for="top_plus_master">Mastercard</label>
        </div>
      </div> -->
      <button type="button" class="p_edit_cancel5">İmtina</button>
      <button type="submit" class="p_edit3">Ödə</button>
    </form>
  </div>
</div>

<script type="text/javascript">

  var token = $('#token').val();

  $('.p_do_top').click(function(){
    $('.p_pin_curtain4 input[name="carad_id"]').val($(this).attr('data'));
    $('.p_pin_curtain4').css('display', 'flex');
  });

  $('.p_edit_cancel4').click(function(){
    $('.p_pin_curtain4 input[name="carad_id"]').val(0);
    $('.p_pin_curtain4').hide();
  });

  $('.top_payment_type').click(function(){
    if ($('#top_balance').is(':checked')) {
      $('.p_top_card_types').slideUp(100);
    } else {
      $('.p_top_card_types').slideDown(100);
    }
  });

  $('.p_do_top_plus').click(function(){
    $('.p_pin_curtain5 input[name="carad_id"]').val($(this).attr('data'));
    $('.p_pin_curtain5').css('display', 'flex');
  });

  $('.p_edit_cancel5').click(function(){
    $('.p_pin_curtain5 input[name="carad_id"]').val(0);
    $('.p_pin_curtain5').hide();
  });

  $('.top_plus_payment_type').click(function(){
    if ($('#top_plus_balance').is(':checked')) {
      $('.p_top_plus_card_types').slideUp(100);
    } else {
      $('.p_top_plus_card_types').slideDown(100);
    }
  });

  $(".star").click(function(e){
    e.preventDefault();
    var id = $(this).data('id');
    var fav = $(this).data('fav');
    $.ajax({
        url: '/dashboard/rent_make_favourite',
        type: 'post',
        data: {id: id, fav: fav, otomoto: token},
        success: function (response) {
           if (response == 0) {
             $(".star").removeClass('myfavourite');
             $(".star").addClass('nofavourite');
             $('.star').data('fav', 0);
             toastr.success("Çıxarıldı", "Uğurlu");
           } else {
             $(".star").removeClass('nofavourite');
             $(".star").addClass('myfavourite');
             $('.star').data('fav', 1);
             toastr.success("Əlavə edildi", "Uğurlu");
           }
        }
    });
  });

  $(".remove-pending").click(function(e){
    var yes = confirm("Elanı silmək?");
    if(!yes){
      e.preventDefault();
    }
  });

  $(".deactive-pending").click(function(e){
    var yes = "";
    if ($(this).hasClass('notdisable')) {
      yes = confirm("Elanı deaktiv etməyə əminsiniz?");
    } else {
      yes = confirm("Elanı aktive etməyə əminsiniz?");
    }

    if (!yes)
      e.preventDefault();
  });

  $("select[name=sort]").change(function(){
    $(".sort-form").submit();
  });

  $(document).ready(function(){
    <?php if($this->session->userdata('success')){ ?>
    Command: toastr.success("Elan silinib.", "Uğurlu əməliyyat!")
    <?php } $this->session->unset_userdata('success');?>
    <?php if($this->session->userdata('addsuccess')){ ?>
    Command: toastr.success("Elan qəbul olundu və gözləmədədi.", "Uğurlu əməliyyat!")
    <?php } $this->session->unset_userdata('addsuccess');?>
  });

</script>


<style>
.carousel-inner img {
    width: 100%;
    height: 100%;
  }
  #demo{
    width: 100%;
  	height: auto;
    display: none;
  	background-color: white;
  	position: absolute;
  	top:0;
  	bottom: 0;
  	left: 0;
  	right: 0;
  	margin: auto;
  }
</style>

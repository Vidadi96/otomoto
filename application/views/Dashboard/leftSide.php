<div class="row" style="margin: 0px !important">
<div class="for_left_margin"></div>
<div class="left-side">
  <div class="wrapper">
    <div class="Author">
      <p><?=rtrim(@$this->session->userdata('ad').' '.@$this->session->userdata('soyad')); ?></p>
      <?php if($this->session->userdata('autosalon')==1){ ?>
       <a href="/dashboard/profile">
          <button
            style="background-image: url(/assets/img/car_photos/logo/<?=$logo?>);
                   background-position: center;
                   background-repeat: no-repeat;
                   background-size: cover;
                   height: 100px;"
            class="btn btn-default logo-btn"
            type="button"
            name="button">
            <?=$logo?'':'no logo'?>
          </button>
       </a>
     <?php } ?>
    </div>
    <hr style="border-top: 1px solid rgb(255 255 255);" >
    <div class="panel">
      <ul class="list-group" >
        <li><a class="<?=(@$ac==4)?'active':''?>" href="/dashboard/main"><i class="fa fa-tachometer" ></i>&emsp;İDARƏ PANELİ</a></li>
        <li><a class="<?=(@$ac == 2)?'active':''?>" href="/dashboard"><i class="fa fa-shopping-cart" ></i>&emsp;MƏNİM ELANLARIM</a></li>
        <?php if(@$is_salon): ?>
          <li><a class="<?=(@$ac == 5)?'active':''?>" href="/dashboard/rent_car"><i class="fa fa-volume-control-phone" ></i>&emsp;Rent a car</a></li>
        <?php endif; ?>
        <li><a class="<?=(@$ac == 1)?'active':''?>" href="/dashboard/favourite"><i class="fa fa-star" ></i>&emsp;SEÇİLMİŞLƏR</a></li>
        <li><a class="<?=(@$ac == 3)?'active':''?>" href="/dashboard/profile"><i class="fa fa-cog" ></i>&emsp;PROFİL AYARLARI</a></li>
      </ul>
    </div>
    <hr style="border-top: 1px solid rgb(255 255 255);" >
    <?php if(@$this->session->userdata('mobile') || @$this->session->userdata('email')): ?>
      <div class="contacts">
        <?php if (@$this->session->userdata('mobile')): ?>
          <span class="relative_100">
            <i class="fa fa-phone"></i> <?=@$this->session->userdata('mobile');?>
          </span>
        <?php endif;
        if (@$this->session->userdata('email')): ?>
          <span class="relative_100">
            <i class="fa fa-envelope"></i> <?=@$this->session->userdata('email');?>
          </span>
        <?php endif; ?>
      </div>
    <?php endif; ?>
    <div class="myProfile">
      <p> <a href="/dashboard/profile"> <i class="fa fa-external-link" ></i> Profile baxmaq</a></p>
    </div>
  </div>
</div>

<span class="open_left_side">
  <i class="fa fa-bars" aria-hidden="true"></i>
  İdarə paneli
</span>

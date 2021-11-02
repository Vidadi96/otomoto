<div class="right_content">
  <div class="profile-wrapper">
    <form method="POST" enctype="multipart/form-data" action="/dashboard/addAuthorInfo">
    <br>
    <h3>Ayarlar</h3>
    <hr>
    <br class="mobile_none">
    <?php if($this->input->get('Password')=='wrong'){ ?>
      <p style="background-color: red; color: white; padding: 3px;">Cari şifrə səhvdi!</p>
    <?php } ?>

      <div class="row profile-info">
        <div class="col-md-4 col-sm-4">
          <div class="logo-wrapper" style="background-image:url('/assets/img/car_photos/logo/<?=$authorInfo[0]['logo']?>'); background-position: center;background-repeat: no-repeat;background-size: cover; height:auto;" >
              <div class="logo-div text-center"> <p class="no-logo" ><?=($authorInfo[0]['logo'])?'':'no logo'?></p> </div>
          </div>
        </div>
        <div class="col-md-8 col-sm-8">
          <label class="custom-label logo_label" for="">Yeni loqotip yükləyin</label><br>
          <div class="logo-wrapper">
              <div class="custom-file">
                <input type="file" name="logo" id="logo" class="logo_input">
              </div>
          </div>
          <span class="jpeg-info mobile_none" >JPEG və ya PNG minimum 160x160px</span>
        </div>
      </div>

    <br>
    <br class="mobile_none">
      <?php if($this->session->userdata('autosalon')==1){ ?>
    <div class="row avatar-wrapper">
      <div class="col-md-4 col-sm-4">
        <div class="avatar" style="background-image:url('/assets/img/car_photos/avatar/<?=$authorInfo[0]['avatar']?>'); background-position: center;background-repeat: no-repeat;background-size: cover;" >
          <?=($authorInfo[0]['avatar'])?'':'<i class="fa fa-user" ></i>'?>
        </div>
      </div>
      <div class="col-md-8 col-sm-8">
        <label class="custom-label logo_label" for="">Yeni avatar yükləyin</label>
        <div class="custom-file">
          <input type="file" name="avatar" id="avatar" class="logo_input">
        </div>
        <span class="jpeg-info mobile_none" >JPEG və ya PNG minimum 550x150px</span>
      </div>
    </div>
    <?php } ?>
    <br>
    <div class="row main-information">
      <div class="col-md-12">
        <h5>Əsas Məlumat</h5>
        <hr>
      </div>
      <input type="hidden" name="vebsayt" class="form-control" placeholder="http:\\example.com" name="" value="<?=$authorInfo[0]['vebsayt'];?>">
      <div class="col-md-4">
        <div class="form-group">
          <label class="my_label_style">Ad</label>
          <input type="text" name="ad" class="form-control mobile_font" value="<?=$authorInfo[0]['first_name'];?>">
        </div>
      </div>
      <div class="col-md-4">
        <div class="form-group">
          <label class="my_label_style" for="">Soyad</label>
          <input type="text" name="soyad" class="form-control mobile_font" value="<?=$authorInfo[0]['last_name'];?>">
        </div>
      </div>
      <div class="col-md-4">
        <div class="form-group">
          <label class="my_label_style" for="">Email</label>
          <input type="text" name="email" class="form-control mobile_font" value="<?=$authorInfo[0]['email'];?>">
        </div>
      </div>
      <div class="col-md-4">
        <div class="form-group">
          <label class="my_label_style" for="">Telefon 1 *</label>
          <input type="text" name="telefon" class="form-control mobile_font phone_format only_numeric" value="<?=$authorInfo[0]['mobile'];?>" required>
        </div>
      </div>
      <div class="col-md-4">
        <div class="form-group">
          <label class="my_label_style" for="">Telefon 2</label>
          <input type="text" name="telefon2" class="form-control mobile_font phone_format only_numeric" value="<?=$authorInfo[0]['mobile2'];?>">
        </div>
      </div>
      <div class="col-md-4">
        <div class="form-group">
          <label class="my_label_style" for="">Telefon 3</label>
          <input type="text" name="telefon3" class="form-control mobile_font phone_format only_numeric" value="<?=$authorInfo[0]['mobile3'];?>">
        </div>
      </div>

    </div>

    <?php if($this->session->userdata('autosalon')==1){ ?>
    <br>
    <div class="row business-information">
      <div class="col-md-12">
        <h5>Avtosalon</h5>
        <hr>
      </div>
      <div class="col-md-4">
        <div class="form-group">
          <label class="my_label_style" for="">Avtosalonun adı*</label>
          <input class="form-control mobile_font" name="shirketad" type="text" name="" value="<?=$authorInfo[0]['shirketad'];?>">
        </div>
      </div>
      <div class="col-md-4">
        <div class="form-group">
          <label class="my_label_style" for="">İş günləri</label>
          <input class="form-control mobile_font" placeholder="1-5" type="text" name="ishgunleri" value="<?=$authorInfo[0]['ishgunleri'];?>">
        </div>
      </div>
      <div class="col-md-4">
        <div class="form-group">
          <label class="my_label_style" for="">Avtosalon növü</label>
          <div class="m-radio-inline">
            <div class="m-radio-inline">
							<label class="m-radio m-radio--solid">
								<input type="radio" name="autosalon_type" value="1" <?=$authorInfo[0]['is_salon']?'checked':''; ?> >
								Avtosalon
								<span></span>
							</label>
							<label class="m-radio m-radio--solid">
								<input type="radio" name="autosalon_type" value="2" <?=$authorInfo[0]['is_rent']?'checked':''; ?>>
								Rent a car
								<span></span>
							</label>
						</div>
					</div>
        </div>
      </div>
      <div class="col-md-12">
        <div class="form-group">
          <label class="my_label_style" for="">Ətraflı məlumat</label>
          <textarea class="form-control mobile_font" name="etraflimelumat" rows="5"><?=$authorInfo[0]['etraflimelumat'];?></textarea>
        </div>
      </div>
    </div>
    <?php } ?>
    <br>
    <input type="hidden" id="token" name="<?=$this->security->get_csrf_token_name(); ?>" value="<?=$this->security->get_csrf_hash(); ?>">
      <?php if($this->session->userdata('autosalon')==1){ ?>
    <div class="row">
			<div class="col-xl-12" style="position: relative;">
        <input id="google_search_input" class="form-control map_search_style" value="" placeholder="Axtar" autocomplete="off" type="text">
        <div id="map" class="map map_div_style"></div>
        <input type="hidden" name="map_data" value='<?=json_encode($map_data, JSON_FORCE_OBJECT); ?>'>
        <input type="hidden" name="lat" value="" />
        <input type="hidden" name="lng" value="" />
      </div>
    </div>
    <!-- <form> -->
      <div class="row map_edit_container"></div>
      <br>
    <!-- </form> -->
  <?php } ?>
    <div class="row business-information">
      <div class="col-md-12">
        <h5>Parolu dəyişdirin</h5>
        <hr>
      </div>
      <div class="col-md-5">
        <div class="form-group mobile_font">
          <label class="my_label_style" for="">Yeni parol</label>
          <input class="form-control" type="password" name="newpass" value="">
        </div>
      </div>
      <div class="col-md-2"></div>
      <div class="col-md-5">
        <div class="form-group mobile_font">
          <label class="my_label_style" for="">Yeni parolu təkrarlayın</label>
          <input class="form-control" type="password" name="newpass2" value="">
        </div>
      </div>
    </div>

    <div class="row ">
      <div class="col-md-6">
      </div>
      <div class="col-md-6">
        <label for="">&nbsp;</label>
        <button class="btn btn-danger pull-right" type="submit" name="submit">
          <i class="fa fa-save" aria-hidden="true"></i>
          Yadda saxla
        </button>
      </div>
    </div>
    <br>
    <br>
    <br>
    <br>
    <br>
  </form>
  </div>
</div>

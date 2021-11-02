<link rel="stylesheet" href="/assets/dashboard/uploader/fancy-file-uploader/fancy_fileupload.css">

<div class="row">
  <div class="col-md-10 offset-md-1 new-car-wrapper-col">
    <div class="new-car-wrapper">
      <div class="breadcrump">
        <p><a href="/">OTOMOTO.AZ</a> > AVTO ƏLAVƏ ET</p>
        <hr>
      </div>
      <br>
      <div class="row">
        <div class="col-md-6">
          <h3><b>Elanınızı yaradın</b></h3>
          <sup>Hal-hazırda pulsuz elan yaradırsız.</sup>
          <p><b>* ilə qeyd elementlərin doldurulması tələb olunur.</b></p>
        </div>
        <div class="col-md-6">
          <div class="youtube-video">
            <iframe width="360" height="315"
              src="https://otomoto.az/wp-content/uploads/2020/11/otomoto.mp4?_=1">
            </iframe>
          </div>
        </div>
      </div>
        <div class="row">

        <form class="addNewCar" action="/dashboard/addNewCar" method="post" enctype="multipart/form-data">
<input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">
        <!-- <div class="col-md-12"> -->
          <hr>
          <h4><b>Avtomobilin məlumatları</b></h4>
          <div class="row search-information">
            <div class="col-md-4">
              <div class="form-group">
                <label for="">&nbsp;</label><br>
                <select class="form-control" name="mark">
                    <option value="">Marka</option>
                  <?php foreach($carmark as $val){ ?>
                    <option value="<?=$val['id']?>"><?=$val['mark']?></option>
                  <?php } ?>
                </select>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label for="">&nbsp;</label><br>
                <select class="form-control" required name="model">
                  <option value="">Model</option>
                  <option value="">Marka seçin</option>
                </select>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label for="">&nbsp;</label><br>
                <select class="form-control" required name="year" id="year">
                  <option value="">İl</option>
                  <?php for ($i= ((int) date('Y') - 61); $i <= (int) date('Y'); $i++) {
                      echo '<option value="'.$i.'">'.$i.'</option>';
                  } ?>
                </select>
              </div>
            </div>
          </div>

        <!-- </div> -->

      </div>
      <br>
      <div class="row">
        <div class="add-new-car-param">
        <div class="col-md-3">
          <i class="fa fa-map-marker" ></i> &nbsp;&nbsp;
          <div class="form-group">
            <select class="form-control" required name="city">
              <option value="">Şəhər</option>
              <?php foreach($carcities as $val){ ?>
                <option value="<?=$val['id']?>"><?=$val['ad']?></option>
              <?php } ?>
            </select>
          </div>
        </div>

        <div class="col-md-3">
          <i class="fa fa-car" ></i> &nbsp;
          <div class="form-group">
            <select class="form-control" required name="body">
              <option value="">Ban növü</option>
              <?php foreach($carbody as $val){ ?>
                <option value="<?=$val['id']?>"><?=$val['body']?></option>
              <?php } ?>
            </select>
          </div>
        </div>

        <div class="col-md-3">
          <i class="fa fa-road" ></i> &nbsp;
          <div class="form-group">
            <input type="number" class="form-control" required placeholder="Yürüş" min="0" step="1" max="9999999" name="mileage" value="mileage">
          </div>
        </div>

        <div class="col-md-3">
          <i class="fa fa-superpowers" ></i> &nbsp;
          <div class="form-group">
            <input type="number" class="form-control" required min="0" max="9999999" step="1" placeholder="At gücü (a.g.)" name="horsePower" value="">
          </div>
        </div>

        <div class="col-md-3">
          <i class="fa fa-cog" ></i> &nbsp;
          <div class="form-group">
            <select class="form-control" required name="engine">
              <option value="">Mühərrik</option>
              <?php foreach($carengine as $val){ ?>
                <option value="<?=$val['id']?>"><?=$val['engine']?></option>
              <?php } ?>
            </select>
          </div>
        </div>

        <div class="col-md-3">
          <i class="fa fa-unsorted" ></i> &nbsp;&nbsp;&nbsp;
          <div class="form-group">
            <select class="form-control" required name="fuel">
              <option value="">Yanacaq növü</option>
              <option value="Benzin">Benzin</option>
              <option value="Dizel">Dizel</option>
              <option value="Qaz">Qaz</option>
              <option value="Elektro">Elektro</option>
              <option value="Hibrid">Hibrid</option>
            </select>
          </div>
        </div>

        <div class="col-md-3">
          <i class="fa fa-cogs" ></i> &nbsp;
          <div class="form-group">
            <select class="form-control" required name="transmission">
              <option value="">Sürətlər qutusu</option>
              <option value="Mexaniki">Mexaniki</option>
              <option value="Avtomat">Avtomat</option>
              <option value="Robotlaşdırılmış">Robotlaşdırılmış</option>
              <option value="Variator">Variator</option>
            </select>
          </div>
        </div>

        <div class="col-md-3">
          <i class="fa fa-gear" ></i> &nbsp;&nbsp;
          <div class="form-group">
            <select class="form-control" required name="drive">
              <option value="">Ötürücü</option>
              <option value="Arxa">Arxa</option>
              <option value="Ön">Ön</option>
              <option value="Tam">Tam</option>
            </select>
          </div>
        </div>

        <div class="col-md-3">
          <i class="fa fa-adjust" ></i> &nbsp;
          <div class="form-group">
            <select class="form-control" required name="interiorColor">
              <option value="">Salon rəngi</option>
              <?php foreach($carinteriorcolor as $val){ ?>
                <option value="<?=$val['id']?>"><?=$val['interiorcolor']?></option>
              <?php } ?>
            </select>
          </div>
        </div>

        <div class="col-md-3">
          <i class="fa fa-adjust" ></i> &nbsp;&nbsp;
          <div class="form-group">
            <select class="form-control" required name="color">
              <option value="">Rəng</option>
              <?php foreach($carcolor as $val){ ?>
                <option value="<?=$val['id']?>"><?=$val['color']?></option>
              <?php } ?>
            </select>
          </div>
        </div>
        <div class="col-md-12">

        </div>

        <div class="col-sm-2 checkbox-inline">
          <div class="form-group">
            <label for="kredit">
              <input type="hidden"  value="0" name="credit">
              <input type="checkbox" id="kredit" value="1" name="credit">
              Kredit
            </label>
          </div>
          <div class="form-group">
            <label for="barter">
              <input type="hidden" value="0" name="barter">
              <input type="checkbox" id="barter" value="1" name="barter">
              Barter
          </label>
          </div>
        </div>

        </div>

      </div>

      <hr>
      <div class="row additional-param" >
        <div class="col-sm-2 checkbox-inline">
          <div class="form-group">
            <label for="disk">
              <input type="hidden"  value="0" name="wheels" >
              <input type="checkbox" id="disk" value="1" name="wheels" >
              Yüngül lehimli disklər
            </label>
          </div>
          <div class="form-group">
            <label for="salon">
              <input type="hidden"  value="0" name="leatherSalon" >
              <input type="checkbox" id="salon" value="1" name="leatherSalon" >
              Dəri salon
            </label>
          </div>
        </div>
        <div class="col-sm-2 checkbox-inline">
          <div class="form-group">
            <label for="radar">
              <input type="hidden"  value="0" name="parkingSensor" >
              <input type="checkbox" id="radar" value="1" name="parkingSensor" >
              Park radarı
            </label>
          </div>
          <div class="form-group">
            <label for="lyuk">
              <input type="hidden"  value="0" name="sunproof" >
              <input type="checkbox" id="lyuk" value="1" name="sunproof" >
              Lyuk
            </label>
          </div>
        </div>

        <div class="col-sm-2 checkbox-inline">
          <div class="form-group">
            <label for="kamera">
              <input type="hidden" value="0" name="camera" >
              <input type="checkbox" id="kamera" value="1" name="camera" >
              Arxa görüntü kamerası
            </label>
          </div>
          <div class="form-group">
            <label for="oturacaq">
              <input type="hidden"  value="0" name="heatedseats" >
              <input type="checkbox" id="oturacaq" value="1" name="heatedseats" >
              Oturacaqların isidilməsi
            </label>
          </div>
        </div>

        <div class="col-sm-2 checkbox-inline">
          <div class="form-group">
            <label for="qapanma">
              <input type="hidden"  value="0" name="centrallocking" >
              <input type="checkbox" id="qapanma" value="1" name="centrallocking" >
              Mərkəzi qapanma
            </label>
          </div>
          <div class="form-group">
            <label for="abs">
              <input type="hidden" value="0" name="abs" >
              <input type="checkbox" id="abs" value="1" name="abs" >
              ABS
            </label>
          </div>
        </div>

        <div class="col-sm-2 checkbox-inline">
          <div class="form-group">
            <label for="ksenon">
              <input type="hidden"  value="0" name="xenon" >
              <input type="checkbox" id="ksenon" value="1" name="xenon" >
              Ksenon lampalar
            </label>
          </div>
          <div class="form-group">
            <label for="kondisioner">
              <input type="hidden"  value="0" name="aircondition" >
              <input type="checkbox" id="kondisioner" value="1" name="aircondition" >
              Kondisioner
            </label>
          </div>
        </div>

        <div class="col-sm-2 checkbox-inline">
          <div class="form-group">
            <label for="sensor">
              <input type="hidden" value="0" name="sensor" >
              <input type="checkbox" id="sensor" value="1" name="sensor" >
              Yağış sensoru
            </label>
          </div>
          <div class="form-group">
            <label for="perde">
              <input type="hidden" value="0" name="sidecurtains" >
              <input type="checkbox" id="perde" value="1" name="sidecurtains" >
              Yan pərdələr
            </label>
          </div>
        </div>

        <div class="col-sm-2 checkbox-inline">
          <div class="form-group">
            <label for="havalandirma">
              <input type="hidden"  value="0" name="seatventilation" >
              <input type="checkbox" id="havalandirma" value="1" name="seatventilation" >
              Oturacaqların havalandırması
            </label>
          </div>
          <div class="form-group">
            <label for="esp">
              <input type="hidden" value="0" name="esp"  >
              <input type="checkbox" id="esp" value="1" name="esp"  >
              ESP
            </label>
          </div>
        </div>

      </div>

      <hr>
      <div class="row photo" >
        <div class="col-md-12">
          <h4><b>Şəkil yüklə</b></h4>
        </div>
        <div class="col-md-8">
        <input id="demo" type="file" name="files"  multiple>
        <!-- accept=".jpg, .png, image/jpeg, image/png"  -->
        </div>
        <div class="col-md-4">
          <h3>TÖVSİYƏ VƏ RƏHBƏRLİK</h3>
          <p>Tövsiyə olunan şəkil ölçüsü: 800 x 470 piksel və ya daha yüksək.</p>
          <p>İstifadəçi 20-yə qədər şəkil yükləyə bilər.</p>
          <p>Diler olmaq istəyirsinizsə, bizə müraciət edin – (050) …</p>
        </div>
      </div>

      <hr>
      <div class="row video" >
        <div class="video-wrapper">

          <div class="col-md-8">
            <div class="form-group">
              <h5><b>YouTube link</b></h5>
              <input class="form-control" type="text" name="youtubeLink" value="">
            </div>
          </div>

          <div class="col-md-4">
            <label for="">&nbsp;</label><br>
            <p>
              <i class="fa fa-info-circle" ></i>
              Videonunuz yoxdursa, narahat olmayın. "Elanları idarə et" səhifəsini istifadə edərək elan başa çatdıqdan sonra onları əlavə edə və ya düzəldə bilərsiniz.
            </p>
          </div>

        </div>
      </div>

      <hr>
      <div class="row additional-info" >
        <div class="col-md-12">
          <h3>Əlavə məlumat</h3>
        </div>
        <div class="col-md-8">
          <textarea class="form-control" name="additionalInfo" rows="8"></textarea>
        </div>
      </div>
      <hr>
      <div class="row price" >
        <div class="col-md-12">
          <p>Nəqliyyat vasitəniz haqqında məlumatı və yürüşü ərazinizdəki satıcılar və fərdi satıcılar tərəfindən satılan oxşar nəqliyyat vasitələri ilə müqayisə edərək rəqabətli bir qiymət təyin edin. Sonra nəqliyyat vasitənizin qiymətini nəzərdən keçirin. Avtomobilinizin ən yaxşı xüsusiyyətlərini vurğulamaq üçün satıcının şərhlərini və fotoşəkillərini daxil etməyinizə əmin olun, xüsusən sorğulanan qiyməti orta qiymətdən yüksəkdirsə.</p>
        </div>
        <div class="price-inputs">
          <label for="">&nbsp;</label><br>
          <div class="black-div">
            <div class="form-group">
              <label for="">Qiymət* ( )</label>
              <input class="form-control" type="number" step="1" min="0" max="9999999" required name="price" value="">
              <label class="agreeLabel" for="agree">
              <input type="checkbox" id="agree" value="1" name="agreement" >
              Razılaşma yolu ilə*</label>
            </div>
          </div>
          <div class="black-div">
            <div class="form-group">

            </div>
          </div>
          <div class="black-div">
            <div class="form-group">
              <label for="">Valyuta</label><br>
              <label class="">
                <input type="radio" value="0"  checked name="currency">&nbsp;AZN
              </label>
              <label class="">
                <input type="radio" value="1" name="currency">&nbsp;USD
              </label>
              <label class="">
                <input type="radio" value="2" name="currency">&nbsp;EUR
              </label>
            </div>
          </div>
        </div>

      </div>
      <hr>
      <div class="row pin-code" >
        <div class="col-md-12">
          <h5>PİN Kod</h5>
          <p>Qeyd*: Bu PİN Kod vasitəsilə siz şəxsi kabinetə daxil olmadan, elan üzərində istədiyiniz əməliyyatı (silmək, redaktə etmək və sair) yerinə yetirə bilərsiniz. Bu PİN kodu etibarlı bir yerdə saxlamağınız tövsiyyə olunur.</p>
          <br>
          <label for="">Sizin PİN Kod:</label>
          <p class="your-pin-code" ><?=$pincode?></p>
          <input type="hidden" name="pincode" value="<?=$pincode?>">
        </div>
        <?php if($this->session->userdata('uid')==''){ ?>
        <div class="col-md-12 unregistredUser">
          <input type="hidden" name="unregistred" value="1">
          <hr>
          <h4>Qeydiyyatdan keçin</h4>
        </div>
        <div class="col-md-12 unregistredUser">
          <div class="form-group autosalon-wrapper">
            <label class="autosalon-label" for="autosalon"> <span> Avtosalon kimi qeydiyyatdan keçirsiz?</span>
            <input type="hidden" value="0" name="autosalon">
            <input id="autosalon" type="checkbox" value="1" name="autosalon">
            </label>
          </div>
        </div>
        <div class="col-md-3 unregistredUser">
          <div class="form-group">
            <label for="firstname">Adınız</label>
            <input class="form-control" required type="text" name="firstname">
          </div>
        </div>
        <div class="col-md-3 unregistredUser">
          <div class="form-group">
            <label for="email">E-mail</label>
            <input class="form-control" required type="text" name="email">
          </div>
        </div>
        <div class="col-md-3 unregistredUser">
          <div class="form-group">
            <label for="phone">Telefon</label>
            <input class="form-control" required type="text" name="phone" class="phone_format">
          </div>
        </div>
        <div class="col-md-3 unregistredUser">
          <div class="form-group">
            <label for="phone">Şifrəniz</label>
            <input class="form-control" required type="password" name="passwd"  required>
          </div>
        </div>
        <?php } ?>
      </div>

      <?php if($this->session->userdata('uid')){ ?>
      <hr>
      <div class="row author-info" >
        <div class="col-md-4">
          <br>
          <div class="image-logo" style="background-image:url('/assets/img/car_photos/logo/<?=@$authorInfo[0]['logo'];?>'); background-position: center;background-repeat: no-repeat;background-size: cover; height:100px;">
            <p><?=(!@$authorInfo[0]['logo'])?'no logo':''?></p>
          </div>
          <br>
          <h3>"<?=rtrim($this->session->userdata('ad').' '.$this->session->userdata('soyad'));?>"</h3>
        </div>
        <div class="col-md-4 offset-md-4">
          <br>
          <p>
            <a href="/dashboard/profile"> <i class="fa fa-external-link" ></i> Profilimə baxmaq</a>
          </p>
          <p>
            <a href="/dashboard/exit"><i class="fa fa-sign-out" ></i> Çıxış </a>fərqli bir hesab seçmək
          </p>
        </div>
      </div>
      <?php } ?>
      <br>
      <div class="row send-ad">
          <button class="btn btn-success" type="submit" name="button"> <i class="fa fa-car" ></i> ELANI GÖNDƏR
          </button>
          <!-- <span class="tooltiptext">Pulsuz və ya pullu plan limitlərindən istifadə edərək bir elan əlavə edin</span> -->
      </div>
    </form>
      <br>
      <div class="row footer">
        <br>
        <div class="col-md-12">
          <br>
          <div class="footer-wrap">
            <p>© 2020 <span> <a href="OtoMoto.az"> OtoMoto.Az  </a></span> &nbsp;&nbsp;|&nbsp;&nbsp; Avtomobillərin satışı və auksionu.</p>
          </div>
        </div>
      </div>



    </div>
  </div>
</div>
<script src="/assets/dashboard/uploader/fancy-file-uploader/jquery.ui.widget.js"></script>
<script src="/assets/dashboard/uploader/fancy-file-uploader/jquery.iframe-transport.js"></script>
<script src="/assets/dashboard/uploader/fancy-file-uploader/jquery.fileupload.js"></script>
<script src="/assets/dashboard/uploader/fancy-file-uploader/jquery.fancy-fileupload.js"></script>
<script type="text/javascript">

  $('#demo').FancyFileUpload({
  params : {
    action : 'fileuploader'
  },
  url: '/dashboard/img_upload_main?pincode='+'<?php echo $pincode?>',
  // $.ajax({
  //     url: '/dashboard/img_upload_main',
  //     type: 'get',
  //     data: {[otomoto]: '70319e7dcf10cf5495f9d2713119cbc2', pincode: <?php //echo $pincode?>},
  //     dataType: 'json',
  //     success: function (response) {
  //
  //     }
  // }),
  maxfilesize : 100000000
  });

  $(".agreeLabel").click( function(){
     if( $('input[name="agreement"]').is(':checked') ){
       $("input[name='price']").attr('readonly',true);
       $("input[name='price']").val(null);
       $('input[name="agreement"]').val(1);
     }
     else{
       $("input[name='price']").attr('readonly',false);
       $('input[name="agreement"]').val(0);
     }
  });

  var csrfName = '';
  var csrfHash = '';

  $(document).ready(function(){
    csrfName = '<?php echo $this->security->get_csrf_token_name(); ?>';
    csrfHash = '<?php echo $this->security->get_csrf_hash(); ?>';
  });
  $(function(){
      $("select[name=mark]").change(function(){
         var mark = $(this).val();
         $("select[name=model] option").remove();
         $.ajax({
             url: '/dashboard/getMarkModels',
             type: 'post',
             data: {[csrfName]: csrfHash, mark: mark},
             dataType: 'json',
             success: function (res) {

                $("select[name=model]").append('<option>Model</option>')
                for(var i = 0; i < res['models'].length; i++) {
                   $('select[name=model]').append('<option value='+res['models'][i]['id']+'>'+res['models'][i]['model']+'</option>');
                }
                csrfName = res['csrf_name'];
                csrfHash = res['csrf_hash'];
             }
         });
      });
  });
</script>

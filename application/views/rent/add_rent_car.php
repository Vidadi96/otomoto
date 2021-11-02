<link rel="stylesheet" href="/assets/dashboard/uploader/fancy-file-uploader/fancy_fileupload.css">

<div class="row">
    <div class="new-car-wrapper">
      <div class="row">
        <div class="col-md-12">
          <span class="add_car_main_title">Rent a car elanınızı yaradın</span>
        </div>
      </div>
      <div class="row">
        <form class="addNewCar" action="/rent/add_new_rent_car" method="post" enctype="multipart/form-data">
          <input type="hidden" id="token" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">
          <hr>
          <h5>Avtomobilin məlumatları</h5>
          <hr>

      <div class="row">

        <div class="col-md-2">
          <label class="my_add_car_label_style" for="class">Sinif <span class="requiredSpan" >&nbsp;*&nbsp;</span></label>
        </div>
        <div class="col-md-4">
          <div class="my-form-group form-inline">
            <select class="form-control custom-width my_add_car_style" required id="class" name="class">
              <option value="">Seçin</option>
              <?php foreach($classes as $row): ?>
                <option value="<?=$row->id; ?>"><?=$row->class; ?></option>
              <?php endforeach; ?>
            </select>
          </div>
        </div>
        <div class="col-md-2">
          <label class="my_add_car_label_style" for="mark">Marka <span class="requiredSpan" >&nbsp;*&nbsp;</span></label>
        </div>
        <div class="col-md-4 mobile_none">
          <div class="my-form-group form-inline">
            <select class="form-control custom-width my_add_car_style add_mobile_disable" required id="mark" name="mark">
              <option value="">Seçin</option>
              <?php foreach($mark as $val){ ?>
                <option value="<?=$val->id; ?>"><?=$val->mark; ?></option>
              <?php } ?>
            </select>
          </div>
        </div>
        <div class="for_filter_button col-md-4 mobile_open">
          <button type="button" style="text-align: left; border: 1px solid #dadfe3; color: #6f7d8d;" class="btn btn-default filter_button">Seçin</button>
          <div class="null_button" style="<?=(isset($filter_mark_name) && $filter_mark_name)?'display: flex':''; ?>">
            <i class="fa fa-times" aria-hidden="true"></i>
          </div>
          <input type="hidden" name="mark" class="mobile_mark remove_mobile_disable" value="">
          <input type="hidden" name="model" class="mobile_model remove_mobile_disable" value="">
        </div>


        <div class="col-md-2">
          <label class="my_add_car_label_style" for="fuel">Yanacaq növü<span class="requiredSpan" >&nbsp;*&nbsp;</span></label>
        </div>
        <div class="col-md-4">
          <div class="my-form-group form-inline">
            <select class="form-control custom-width my_add_car_style" required id="fuel" name="fuel">
              <option value="">Seçin</option>
              <option value="Benzin">Benzin</option>
              <option value="Dizel">Dizel</option>
              <option value="Qaz">Qaz</option>
              <option value="Elektro">Elektro</option>
              <option value="Hibrid">Hibrid</option>
            </select>
          </div>
        </div>

        <div class="col-md-2 mobile_none">
          <label class="my_add_car_label_style" for="model">Model <span class="requiredSpan" >&nbsp;*&nbsp;&nbsp;</span></label>
        </div>
        <div class="col-md-4 mobile_none">
          <div class="my-form-group form-inline">
            <select class="form-control custom-width my_add_car_style add_mobile_disable" id="model" required name="model">
              <option value="">Seçin</option>
              <option value="">Marka seçin</option>
            </select>
          </div>
        </div>

        <div class="col-md-2">
          <label class="my_add_car_label_style" for="city">Şəhər <span class="requiredSpan" >&nbsp;*&nbsp;&nbsp;</span></label>
        </div>
        <div class="col-md-4">
          <div class="my-form-group form-inline">
            <select class="form-control custom-width my_add_car_style" id="city" required name="city">
              <option value="">Seçin</option>
              <?php foreach($carcities as $val){ ?>
                <option value="<?=$val['id']?>"><?=$val['ad']?></option>
              <?php } ?>
            </select>
          </div>
        </div>


        <div class="col-md-2">
          <label class="my_add_car_label_style" for="body">Ban növü <span class="requiredSpan" >&nbsp;*&nbsp;&nbsp;</span></label>
        </div>
        <div class="col-md-4">
          <div class="my-form-group form-inline">
            <select class="form-control custom-width my_add_car_style" id="body" required name="body">
              <option value="">Seçin</option>
              <?php foreach($carbody as $val){ ?>
                <option value="<?=$val['id']?>"><?=$val['body']?></option>
              <?php } ?>
            </select>
          </div>
        </div>


        <div class="col-md-2">
          <label class="my_add_car_label_style" for="transmission">Sürətlər qutusu <span class="requiredSpan" >&nbsp;*&nbsp;&nbsp;</span></label>
        </div>
        <div class="col-md-4">
          <div class="my-form-group form-inline">
            <select class="form-control custom-width my_add_car_style" id="transmission" required name="transmission">
              <option value="">Seçin</option>
              <option value="Mexaniki">Mexaniki</option>
              <option value="Avtomat">Avtomat</option>
              <option value="Robotlaşdırılmış">Robotlaşdırılmış</option>
              <option value="Variator">Variator</option>
            </select>
          </div>
        </div>

        <div class="col-md-2">
          <label class="my_add_car_label_style" for="year">Buraxılış ili <span class="requiredSpan" >&nbsp;*&nbsp;&nbsp;</span></label>
        </div>
        <div class="col-md-4">
          <div class="my-form-group form-inline">
            <select class="form-control custom-width my_add_car_style" required name="year" id="year">
              <option value="">Seçin</option>
              <?php for ($i= ((int) date('Y') - 61); $i <= (int) date('Y'); $i++) {
                  echo '<option value="'.$i.'">'.$i.'</option>';
              } ?>
            </select>
          </div>
        </div>

        <div class="col-md-2">
          <label class="my_add_car_label_style" for="interiorColor">Rəng <span class="requiredSpan" >&nbsp;*&nbsp;&nbsp;</span></label>
        </div>
        <div class="col-md-4">
          <div class="my-form-group form-inline">
            <select class="form-control custom-width my_add_car_style" required id="interiorColor" name="color">
              <option value="">Seçin</option>
              <?php foreach($carcolor as $val){ ?>
                <option value="<?=$val['id']; ?>"><?=$val['color']; ?></option>
              <?php } ?>
            </select>
          </div>
        </div>

        <div class="col-md-2">
          <label class="my_add_car_label_style" for="included_km">Daxil edilmiş km <span class="requiredSpan" >&nbsp;*&nbsp;&nbsp;</span></label>
        </div>
        <div class="col-md-4">
          <div class="my-form-group form-inline">
              <input type="number" class="form-control custom-width my_add_car_style" id="included_km" required min="0" step="1" name="included_km">
          </div>
        </div>

        <div class="col-md-2">
          <label class="my_add_car_label_style" for="surcharge">İcarə dövrünü keçdikdə <span class="requiredSpan" >&nbsp;*&nbsp;&nbsp;</span></label>
        </div>
        <div class="col-md-4">
          <div class="my-form-group form-inline">
              <input type="number" class="form-control custom-width my_add_car_style" id="surcharge" required min="0" step="1" name="surcharge">
          </div>
        </div>

        <div class="col-md-2">
          <label class="my_add_car_label_style" for="deposit">Depozit <span class="requiredSpan" >&nbsp;*&nbsp;&nbsp;</span></label>
        </div>
        <div class="col-md-4">
          <div class="my-form-group form-inline">
              <input type="number" class="form-control custom-width my_add_car_style" id="deposit" required min="0" step="1" name="deposit">
          </div>
        </div>

        <div class="col-md-2">
          <label class="my_add_car_label_style" for="limitation">Yürüşün məhdudlaşdırılması <span class="requiredSpan" >&nbsp;*&nbsp;&nbsp;</span></label>
        </div>
        <div class="col-md-4">
          <div class="my-form-group form-inline">
              <input type="number" class="form-control custom-width my_add_car_style" id="limitation" required min="0" step="1" name="limitation">
          </div>
        </div>

        <div class="col-md-2">
          <label class="my_add_car_label_style" for="price">Qiymət <span class="requiredSpan" >&nbsp;*&nbsp;&nbsp;</span></label>
        </div>
        <div class="col-md-4">
          <div class="my-form-group form-inline">
            <input class="form-control my_add_car_style" type="number" step="1" min="0" max="9999999" id="price" required name="price" value="">
            <label class="">
              &nbsp;<input type="radio" value="0"  checked name="currency">&nbsp;AZN
            </label>
            <label class="">
              &nbsp;<input type="radio" value="1" name="currency">&nbsp;USD
            </label>
            <label class="">
              &nbsp;<input type="radio" value="2" name="currency">&nbsp;EUR
            </label>
          </div>
        </div>

      </div>
      <div class="row">
        <div class="col-md-2"></div>
        <div class="col-sm-2 checkbox-inline">
          <label for="delivery" style="width: 100%">
            <input type="hidden"  value="0" name="delivery">
            <input type="checkbox" id="delivery" value="1" name="delivery">
            Çatdırılma
          </label>
          <label for="returning">
            <input type="hidden" value="0" name="returning">
            <input type="checkbox" id="returning" value="1" name="returning">
            Geri götürmə
          </label>
        </div>
        <div class="col-md-12"></div>
        <div class="col-md-2">
          <label for="">Əlavə <span class="requiredSpan" >&nbsp;*&nbsp;&nbsp;</span></label>
        </div>
        <div class="col-md-12">
          <div class="form-group form-inline">
            <textarea style="width: 100%; height: 80px" class="form-control" placeholder="Əlavə məlumatlar" name="additionalInfo" rows="6"></textarea>
            <span class="mini_description" title="Qeyd">
              <i class="fa fa-info-circle" style="color:#5b93a2" aria-hidden="true"></i>
              Telefon nömrələri qeyd etmək qadağandır!
            </span>
          </div>
        </div>
      </div>
      <hr><h5>Avtomobilin təchizatı</h5><hr>
      <div class="row">
        <div class="col-md-12">
          <div class="row additional-param" >

            <div class="col-sm-3 col-md-3 col-lg-3 checkbox-inline">
              <label for="disk">
                <input type="hidden"  value="0" name="wheels" >
                <input type="checkbox" class="my_checkbox_style" id="disk" value="1" name="wheels" >
                <span>Yüngül lehimli disklər</span>
              </label>
            </div>

            <div class="col-sm-3 col-md-3 col-lg-3 checkbox-inline">
              <label for="salon">
                <input type="hidden"  value="0" name="leatherSalon" >
                <input type="checkbox" class="my_checkbox_style" id="salon" value="1" name="leatherSalon" >
                Dəri salon
              </label>
            </div>

            <div class="col-sm-3 col-md-3 col-lg-3 checkbox-inline">
              <label for="radar">
                <input type="hidden"  value="0" name="parkingSensor" >
                <input type="checkbox" class="my_checkbox_style" id="radar" value="1" name="parkingSensor" >
                Park radarı
              </label>
            </div>

            <div class="col-sm-3 col-md-3 col-lg-3 checkbox-inline">
              <label for="lyuk">
                <input type="hidden"  value="0" name="sunproof" >
                <input type="checkbox" class="my_checkbox_style" id="lyuk" value="1" name="sunproof" >
                Lyuk
              </label>
            </div>

            <div class="col-sm-3 col-md-3 col-lg-3 checkbox-inline">
              <label for="kamera">
                <input type="hidden" value="0" name="camera" >
                <input type="checkbox" class="my_checkbox_style" id="kamera" value="1" name="camera" >
                Arxa görüntü kamerası
              </label>
            </div>

            <div class="col-sm-3 col-md-3 col-lg-3 checkbox-inline">
              <label for="oturacaq">
                <input type="hidden"  value="0" name="heatedseats" >
                <input type="checkbox" class="my_checkbox_style" id="oturacaq" value="1" name="heatedseats" >
                Oturacaqların isidilməsi
              </label>
            </div>

            <div class="col-sm-3 col-md-3 col-lg-3 checkbox-inline">
              <label for="qapanma">
                <input type="hidden"  value="0" name="centrallocking" >
                <input type="checkbox" class="my_checkbox_style" id="qapanma" value="1" name="centrallocking" >
                Mərkəzi qapanma
              </label>
            </div>

            <div class="col-sm-3 col-md-3 col-lg-3 checkbox-inline">
              <label for="abs">
                <input type="hidden" value="0" name="abs" >
                <input type="checkbox" class="my_checkbox_style" id="abs" value="1" name="abs" >
                ABS
              </label>
            </div>

            <div class="col-sm-3 col-md-3 col-lg-3 checkbox-inline">
              <label for="ksenon">
                <input type="hidden"  value="0" name="xenon" >
                <input type="checkbox" class="my_checkbox_style" id="ksenon" value="1" name="xenon" >
                Ksenon lampalar
              </label>
            </div>

            <div class="col-sm-3 col-md-3 col-lg-3 checkbox-inline">
              <label for="kondisioner">
                <input type="hidden"  value="0" name="aircondition" >
                <input type="checkbox" class="my_checkbox_style" id="kondisioner" value="1" name="aircondition" >
                Kondisioner
              </label>
            </div>

            <div class="col-sm-3 col-md-3 col-lg-3 checkbox-inline">
              <label for="sensor">
                <input type="hidden" value="0" name="sensor" >
                <input type="checkbox" class="my_checkbox_style" id="sensor" value="1" name="sensor" >
                Yağış sensoru
              </label>
            </div>

            <div class="col-sm-3 col-md-3 col-lg-3 checkbox-inline">
                <label for="perde">
                  <input type="hidden" value="0" name="sidecurtains" >
                  <input type="checkbox" class="my_checkbox_style" id="perde" value="1" name="sidecurtains" >
                  Yan pərdələr
                </label>
            </div>

            <div class="col-sm-3 col-md-3 col-lg-3 checkbox-inline">
                <label for="havalandirma">
                  <input type="hidden"  value="0" name="seatventilation" >
                  <input type="checkbox" class="my_checkbox_style" id="havalandirma" value="1" name="seatventilation" >
                  Oturacaqların havalandırması
                </label>
            </div>

            <div class="col-sm-3 col-md-3 col-lg-3 checkbox-inline">
              <label for="esp">
                <input type="hidden" value="0" name="esp"  >
                <input type="checkbox" class="my_checkbox_style" id="esp" value="1" name="esp"  >
                ESP
              </label>
            </div>

            <div class="col-sm-3 col-md-3 col-lg-3 checkbox-inline">
              <label for="baby_chair">
                <input type="hidden" value="0" name="baby_chair"  >
                <input type="checkbox" class="my_checkbox_style" id="baby_chair" value="1" name="baby_chair"  >
                Uşaq oturacağı
              </label>
            </div>

            <div class="col-sm-3 col-md-3 col-lg-3 checkbox-inline">
              <label for="roof_rack">
                <input type="hidden" value="0" name="roof_rack"  >
                <input type="checkbox" class="my_checkbox_style" id="roof_rack" value="1" name="roof_rack"  >
                Dam üstü baqaj
              </label>
            </div>

            <div class="col-sm-3 col-md-3 col-lg-3 checkbox-inline">
              <label for="insurance">
                <input type="hidden" value="0" name="insurance"  >
                <input type="checkbox" class="my_checkbox_style" id="insurance" value="1" name="insurance"  >
                Sığorta
              </label>
            </div>

            <input type="hidden" name="casco" value="0">
            <input type="hidden" name="osago" value="0">

          </div>
        </div>
      </div>
      <hr><h5>Şəkillər</h5><hr>
      <div class="row photo" >
        <div class="col-md-12">
          <span class="photo_description">
            <i class="fa fa-info-circle" style="color:#5b93a2"></i>
            &nbsp;Maksimum 20 şəkil yükləyə bilərsiniz
          </span>
          <span class="relative_100 photo_description">Digər saytların loqosu ilə əlavə edilən şəkillər silinəcək</span>
        </div>
        <div class="col-md-12">
          <input id="demo" type="file" name="files"  multiple>
        </div>
      </div>
      <br>

      <div class="row pin-code" >
        <div class="col-md-12">
          <h5>PİN Kod</h5>
          <p>
            <span style="font-size: 14px">Qeyd:</span>
            <span style="font-size: 14px; color: #bbb">Bu PİN Kod vasitəsilə siz şəxsi kabinetə daxil olmadan, elan üzərində istədiyiniz əməliyyatı (silmək, redaktə etmək və sair) yerinə yetirə bilərsiniz. Bu PİN kodu etibarlı bir yerdə saxlamağınız tövsiyyə olunur.</span>
          </p>
          <label for="">Sizin PİN Kod:</label>
          <p class="your-pin-code" ><?=$pincode?></p>
          <input type="hidden" name="pincode" value="<?=$pincode?>">
        </div>
        <?php if($this->session->userdata('uid')==''){ ?>
        <input type="hidden" name="unregistred" value="1">
        <input type="hidden" value="0" name="autosalon">
        <div class="col-md-3 unregistredUser">
          <div class="form-group">
            <input class="form-control" required type="text" name="firstname" placeholder="Adınız...">
          </div>
        </div>
        <div class="col-md-3 unregistredUser">
          <div class="form-group">
            <input class="form-control" required type="text" name="email" placeholder="E-mail...">
          </div>
        </div>
        <div class="col-md-3 unregistredUser">
          <div class="form-group">
            <input class="form-control" required type="text" name="phone" class="phone_format" placeholder="Telefon...">
          </div>
        </div>
        <div class="col-md-3 unregistredUser">
          <div class="form-group">
            <input class="form-control" required type="password" name="passwd" required placeholder="İstədiyin şifrəni yarat...">
          </div>
        </div>
        <?php } ?>
      </div>

      <br>
      <div class="row send-ad">
        <div class="col-md-12">
          <button class="btn btn-danger" type="submit" name="button">
            <i class="fa fa-save" aria-hidden="true"></i>
            Yerləşdir
          </button>
        </div>
      </div>

      </form>
      </div>

    </div>
</div>

<div class="all_marks_window">
  <div class="marks_mini_head">
    <button type="button" class="mark_back btn btn-default">
      <i class="fa fa-chevron-left" aria-hidden="true"></i>
      Geri
    </button>
    <span class="mark_head_title">Bütün markalar</span>
  </div>
  <div class="mark_search_div">
    <i class="fa fa-search" aria-hidden="true"></i>
    <input type="text" class="mark_search form-control" placeholder="Axtar...">
  </div>
  <span class="mark_big_title">Populyar markalar</span>
  <div class="mark_row">
    <?php foreach ($popular_mark as $row): ?>
      <div class="popular_mark_block popular_mark" data="<?=$row->id; ?>" data_name="<?=$row->mark; ?>">
        <img src="/assets/img/car_marks/small/<?=$row->img; ?>">
        <div class="popular_mark_block_content">
          <span><?=$row->mark; ?></span>
          <div class="for_loader"></div>
          <span><?=$row->count?$row->count:0; ?> elan</span>
        </div>
      </div>
    <?php endforeach; ?>
  </div>
  <span class="mark_big_title">Bütün markalar</span>
  <div class="mark_row">
    <?php foreach ($mark as $row): ?>
      <div class="popular_mark_block" data="<?=$row->id; ?>" data_name="<?=$row->mark; ?>">
        <img src="/assets/img/car_marks/small/<?=$row->img; ?>">
        <div class="popular_mark_block_content">
          <span><?=$row->mark; ?></span>
          <div class="for_loader"></div>
          <span><?=$row->count?$row->count:0; ?> elan</span>
        </div>
      </div>
    <?php endforeach; ?>
  </div>
</div>

<div class="all_models_window">
  <div class="marks_mini_head">
    <button type="button" class="model_back btn btn-default">
      <i class="fa fa-chevron-left" aria-hidden="true"></i>
      Geri
    </button>
    <span class="mark_head_title">Modellər</span>
  </div>
  <div class="mark_search_div">
    <i class="fa fa-search" aria-hidden="true"></i>
    <input type="text" class="model_search form-control" placeholder="Axtar...">
  </div>
  <div class="model_row">
  </div>
</div>


<script src="/assets/dashboard/uploader/fancy-file-uploader/jquery.ui.widget.js"></script>
<script src="/assets/dashboard/uploader/fancy-file-uploader/jquery.iframe-transport.js"></script>
<script src="/assets/dashboard/uploader/fancy-file-uploader/jquery.fileupload.js"></script>
<script src="/assets/dashboard/uploader/fancy-file-uploader/jquery.fancy-fileupload.js"></script>
<script type="text/javascript">

$(document).ready(function(){
  csrfName = '<?php echo $this->security->get_csrf_token_name(); ?>';
  csrfHash = '<?php echo $this->security->get_csrf_hash(); ?>';
});

  var token = $('#token').val();
  $('#demo').FancyFileUpload({
    params : {
      action : 'fileuploader',
      otomoto: token
    },
    url: '/rent/img_upload_main?pincode=<?=$pincode?>',
    maxfilesize: 100000000,
    added: function(e, data) {
      this.find('.ff_fileupload_actions button.ff_fileupload_start_upload').click();
    },
    uploadcompleted: function(e,data){
        var size90 = data.result['imagePath90'];
        var size800 = data.result['imagePath800'];
        this.find('.ff_fileupload_actions button.ff_fileupload_remove_file').attr('data-size90',size90);
        this.find('.ff_fileupload_actions button.ff_fileupload_remove_file').attr('data-size800',size800);
    }
  });

  $(document).on('click','.ff_fileupload_remove_file',function(){
    var size90 = $(this).attr("data-size90");
    var size800 = $(this).attr("data-size800");
    $.ajax({
          url: '/rent/unlinkimage',
          type: 'post',
          data: {[csrfName]: csrfHash, size90: size90, size800:size800},
          dataType: 'json',
          success: function (res) {
             csrfName = res['csrf_name'];
             csrfHash = res['csrf_hash'];
          }
      });
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


  $(document).on('click', '.ff_fileupload_remove_file', function(){
    var filename = $(this).parents('tr').find('.ff_fileupload_filename').text();
  });

  var csrfName = '';
  var csrfHash = '';


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

  /*----- OPEN MOBILE MARKS -----*/

  $('.filter_button').click(function(){
    $(".all_marks_window").animate({width: '100%'}, 200);
    window.scrollTo(0,0);
  });

  $('.mark_back').click(function(){
    $(".all_marks_window").animate({width: '0px'}, 100);
  });


  $(document).on('input', '.mark_search', function(){
    var value = $(this).val();

    $('.popular_mark_block').each(function() {
      if (value) {
        if (~$(this).find('.popular_mark_block_content span:first-child').text().toLowerCase().indexOf(value.toLowerCase()))
          $(this).show()
        else
          $(this).hide();
      } else {
        $(this).show();
      }
    });
  });

  $(document).on('click', '.popular_mark_block', function(){
    var mark = $(this).attr('data');
    var mark_name = $(this).attr('data_name');

    if ($(this).hasClass('popular_mark')) {
      $(this).find('.for_loader').html('<div class="lds-spinner lds-spinner-white"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div>');
    } else {
      $(this).find('.for_loader').html('<div class="lds-spinner"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div>');
    }

    $.ajax ({
        type: "POST",
        url: "/pages/get_model_list3",
        data: {otomoto: token, mark: mark},
        success: function(data)
        {
          var res = $.parseJSON(data);
          token = res['otomoto'];
          $('#token').val(res['otomoto']);

          var count = 0;
          for (var i=0; i < res['model'].length; i++) {
            var countt1 = res['model'][i].count?res['model'][i].count:0;
            count = count + parseInt(countt1);
          }

          var html =  '<div class="popular_model_block" style="background: #dc3545; width: calc(100% - 10px);" model="" model_name="" mark="'+ mark +'" mark_name="'+ mark_name +'">'
                      + '<div class="popular_model_block_content">'
                        + '<span style="color: #fff">Bütün modellər</span>'
                        + '<span style="color: #fff">'+ count +' elan</span>'
                      + '</div>'
                    + '</div>';

          for (var i=0; i < res['model'].length; i++) {
            var countt = res['model'][i].count?res['model'][i].count:0;
            html = html + '<div class="popular_model_block" model="'+ res['model'][i].id +'" model_name="'+ res['model'][i].model +'" mark="'+ mark +'" mark_name="'+ mark_name +'">'
                          + '<div class="popular_model_block_content">'
                            + '<span>'+ res['model'][i].model +'</span>'
                            + '<span>'+ countt +' elan</span>'
                          + '</div>'
                        + '</div>';
          }

          $('.model_row').html(html);
          $('.for_loader').html('');

          $('.all_models_window').animate({width: '100%'}, 200);
          window.scrollTo(0,0);
        }
    });
  });

  $('.model_back').click(function(){
    $(".all_models_window").animate({width: '0px'}, 100);
  });

  $(document).on('input', '.model_search', function(){
    var value2 = $(this).val();

    $('.popular_model_block').each(function() {
      if (value2) {
        if (~$(this).find('.popular_model_block_content span:first-child').text().toLowerCase().indexOf(value2.toLowerCase()))
          $(this).show()
        else
          $(this).hide();
      } else {
        $(this).show();
      }
    });
  });

  $(document).on('click', '.popular_model_block', function(){
    var mark2 = $(this).attr('mark');
    var mark_name2 = $(this).attr('mark_name');
    var model2 = $(this).attr('model');
    var model_name2 = $(this).attr('model_name');

    $('.mobile_mark').val(mark2);
    $('.mobile_model').val(model2);

    $('.filter_button').text(mark_name2 + ' ' + model_name2);
    $('.null_button').css('display', 'flex');
    $('.all_marks_window').animate({width: 0}, 200);
    $('.all_models_window').animate({width: 0}, 200);
  });

  $(document).on('click', '.null_button', function(){
    $('.mobile_mark').val('');
    $('.mobile_model').val('');

    $('.filter_button').text('Seçin');
    $(this).hide();
  });

  $(document).on('click', '.open_subs', function(){
    if ($(this).hasClass('opened')) {
      $(this).removeClass('fa-minus').addClass('fa-plus').removeClass('opened');
      $('.subs').slideUp(300);
    } else {
      $(this).removeClass('fa-plus').addClass('fa-minus').addClass('opened');
      $('.subs').slideDown(300);
    }
  });

  $(window).load(function() {
    $('.all_models_window').height($('.all_marks_window').outerHeight(true));
  });

</script>

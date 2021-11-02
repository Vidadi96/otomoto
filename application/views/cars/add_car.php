<link href="/dist/font/font-fileuploader.css" rel="stylesheet">
<link href="/dist/jquery.fileuploader.min.css" media="all" rel="stylesheet">
<link href="/Css/jquery.fileuploader-theme-gallery.css" media="all" rel="stylesheet">
<script src="/dist/jquery.fileuploader.js?v=1" type="text/javascript"></script>
<!-- BEGIN: Subheader -->
<div class="m-subheader ">
    <div class="d-flex align-items-center">
        <div class="mr-auto">
            <ul class="m-subheader__breadcrumbs m-nav m-nav--inline">
                <li class="m-nav__item m-nav__item--home">
                    <a href="/adm/index/" class="m-nav__link m-nav__link--icon">
                        <i class="m-nav__link-icon la la-home"></i>
                    </a>
                </li>
            </ul>
            <h3 class="m-subheader__title m-subheader__title--separator">
                <?=$page_title; ?>
            </h3>
        </div>
    </div>
</div>
<!-- END: Subheader -->
<div class="m-content">
    <!--begin::Form-->
    <form action="/cars/add_car_func" method="POST" class="m-form m-form--fit m-form--label-align-right m-form--group-seperator-dashed">
        <input type="hidden" id="token" name="<?=$this->security->get_csrf_token_name(); ?>" value="<?=$this->security->get_csrf_hash(); ?>">

        <div class="row">
            <div class="col-lg-9">
                <!--begin::Portlet-->
                <?php if(isset($status)): ?>
                    <div class="m-alert m-alert--icon m-alert--outline alert alert-<?=$status['status'];?> alert-dismissible fade show" role="alert">
                        <div class="m-alert__icon">
                            <i class="fa fa-<?=$status['icon'];?>"></i>
                        </div>
                        <div class="m-alert__text">
                            <strong><?=$status['title'];?> </strong> <?=$status['msg'];?>
                        </div>
                        <div class="m-alert__close">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"></button>
                        </div>
                    </div>
                <?php endif;?>
                <div class="m-portlet m-portlet--accent m-portlet--head-solid-bg m-portlet--head-sm" m-portlet="true" id="m_portlet_tools_2">
                    <div class="m-portlet__body">
                        <div class="form-group m-form__group row" style="">
                            <div class="col-md-12">
                                <h3 class="m-section__title">Avtomobilin məlumatları</h3>
                            </div>
                            <br>
                            <br>
                            <div class="col-md-4">
                              <label for="marka">Marka</label>
                              <select class="form-control" name="marka" id="marka" required>
                                <option value=""></option>
                                <?php foreach ($mark as $row): ?>
                                  <option value="<?=$row->id; ?>"><?=$row->mark; ?></option>
                                <?php endforeach; ?>
                              </select>
                            </div>
                            <div class="col-md-4">
                              <label for="model">Model</label>
                              <select class="form-control" name="model" id="model" required>
                                <option value=""></option>
                              </select>
                            </div>
                            <div class="col-md-4">
                              <label for="year">İl</label>
                              <select class="form-control" name="year" id="year" required>
                                <option value=""></option>
                                <?php for ($i= ((int) date('Y') - 60); $i < ((int) date('Y') + 1); $i++) {
                                  echo '<option value="'.$i.'">'.$i.'</option>';
                                } ?>
                              </select>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <div class="form-group m-form__group row" style="">
                            <div class="col-md-4">
                              <label for="city">Şəhər</label>
                              <select class="form-control" name="city" id="city" required>
                                <option value=""></option>
                                <?php foreach ($city as $row): ?>
                                  <option value="<?=$row->id; ?>"><?=$row->ad; ?></option>
                                <?php endforeach; ?>
                              </select>
                            </div>
                            <div class="col-md-4">
                              <label for="car_body">Ban növü</label>
                              <select class="form-control" name="car_body" id="car_body" required>
                                <option value=""></option>
                                <?php foreach ($body as $row): ?>
                                  <option value="<?=$row->id; ?>"><?=$row->body; ?></option>
                                <?php endforeach; ?>
                              </select>
                            </div>
                            <div class="col-md-4">
                              <label for="mileage">Yürüş</label>
                              <input class="form-control" type="number" name="mileage" id="mileage" value="" required>
                            </div>
                            <div class="col-md-4">
                              <label for="engine">Mühərrik</label>
                              <select class="form-control" name="engine" id="engine" required>
                                <option value=""></option>
                                <?php foreach ($engine as $row): ?>
                                  <option value="<?=$row->id; ?>"><?=$row->engine; ?></option>
                                <?php endforeach; ?>
                              </select>
                            </div>
                            <div class="col-md-4">
                              <label for="fuel">Yanacaq növü</label>
                              <select class="form-control" name="fuel" id="fuel" required>
                                <option value=""></option>
                                <?php foreach($fuel as $row): ?>
                                  <option value="<?=$row; ?>"><?=$row; ?></option>
                                <?php endforeach; ?>
                              </select>
                            </div>
                            <div class="col-md-4">
                              <label for="horse_power">At gücü</label>
                              <input class="form-control" type="number" name="horse_power" id="horse_power" value="" required>
                            </div>
                            <div class="col-md-4">
                              <label for="transmission">Sürətlər qutusu</label>
                              <select class="form-control" name="transmission" id="transmission" required>
                                <option value=""></option>
                                <?php foreach($transmission as $row): ?>
                                  <option value="<?=$row; ?>"><?=$row; ?></option>
                                <?php endforeach; ?>
                              </select>
                            </div>
                            <div class="col-md-4">
                              <label for="drive">Ötürücü</label>
                              <select class="form-control" name="drive" id="drive" required>
                                <option value=""></option>
                                <?php foreach($drive as $row): ?>
                                  <option value="<?=$row; ?>"><?=$row; ?></option>
                                <?php endforeach; ?>
                              </select>
                            </div>
                            <div class="col-md-4">
                              <label for="interior_color">Salon rəngi</label>
                              <select class="form-control" name="interior_color" id="interior_color" required>
                                <option value=""></option>
                                <?php foreach ($interiorcolor as $row): ?>
                                  <option value="<?=$row->id; ?>"><?=$row->interiorcolor; ?></option>
                                <?php endforeach; ?>
                              </select>
                            </div>
                            <div class="col-md-4">
                              <label for="color">Rəngi</label>
                              <select class="form-control" name="color" id="color" required>
                                <option value=""></option>
                                <?php foreach ($color as $row): ?>
                                  <option value="<?=$row->id; ?>"><?=$row->color; ?></option>
                                <?php endforeach; ?>
                              </select>
                            </div>
                            <div class="col-md-12">
                              <br>
                            </div>
                            <div class="col-md-12">
                                <div class="form-check">
                                    <input class="form-check-input" name="credit" type="checkbox" id="credit">
                                    <label class="form-check-label" for="credit">Kredit</label>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-check">
                                    <input class="form-check-input" name="barter" type="checkbox" id="barter">
                                    <label class="form-check-label" for="barter">Barter</label>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <div class="form-group m-form__group row">
                          <div class="col-md-3">
                              <div class="form-check">
                                  <input class="form-check-input" name="disk" type="checkbox" id="disk">
                                  <label class="form-check-label" for="disk">Yüngül lehimli disklər</label>
                              </div>
                          </div>
                          <div class="col-md-3">
                              <div class="form-check">
                                  <input class="form-check-input" name="radar" type="checkbox" id="radar">
                                  <label class="form-check-label" for="radar">Park radarı</label>
                              </div>
                          </div>
                          <div class="col-md-3">
                              <div class="form-check">
                                  <input class="form-check-input" name="camera" type="checkbox" id="camera">
                                  <label class="form-check-label" for="camera">Arxa görüntü kamerası</label>
                              </div>
                          </div>
                          <div class="col-md-3">
                              <div class="form-check">
                                  <input class="form-check-input" name="qapanma" type="checkbox" id="qapanma">
                                  <label class="form-check-label" for="qapanma">Mərkəzi qapanma</label>
                              </div>
                          </div>
                          <div class="col-md-3">
                              <div class="form-check">
                                  <input class="form-check-input" name="lampa" type="checkbox" id="lampa">
                                  <label class="form-check-label" for="lampa">Ksenon lampalar</label>
                              </div>
                          </div>
                          <div class="col-md-3">
                              <div class="form-check">
                                  <input class="form-check-input" name="leather" type="checkbox" id="leather">
                                  <label class="form-check-label" for="leather">Dəri salon</label>
                              </div>
                          </div>
                          <div class="col-md-3">
                              <div class="form-check">
                                  <input class="form-check-input" name="lyuk" type="checkbox" id="lyuk">
                                  <label class="form-check-label" for="lyuk">Lyuk</label>
                              </div>
                          </div>
                          <div class="col-md-3">
                              <div class="form-check">
                                  <input class="form-check-input" name="isidilme" type="checkbox" id="isidilme">
                                  <label class="form-check-label" for="isidilme">Oturacaqların isidilməsi</label>
                              </div>
                          </div>
                          <div class="col-md-3">
                              <div class="form-check">
                                  <input class="form-check-input" name="abs" type="checkbox" id="abs">
                                  <label class="form-check-label" for="abs">ABS</label>
                              </div>
                          </div>
                          <div class="col-md-3">
                              <div class="form-check">
                                  <input class="form-check-input" name="kondisioner" type="checkbox" id="kondisioner">
                                  <label class="form-check-label" for="kondisioner">Kondisioner</label>
                              </div>
                          </div>
                          <div class="col-md-3">
                              <div class="form-check">
                                  <input class="form-check-input" name="sensor" type="checkbox" id="sensor">
                                  <label class="form-check-label" for="sensor">Yağış sensoru</label>
                              </div>
                          </div>
                          <div class="col-md-3">
                              <div class="form-check">
                                  <input class="form-check-input" name="havalandirilma" type="checkbox" id="havalandırılma">
                                  <label class="form-check-label" for="havalandırılma">Oturacaqların havalandırılması</label>
                              </div>
                          </div>
                          <div class="col-md-3">
                              <div class="form-check">
                                  <input class="form-check-input" name="perde" type="checkbox" id="perde">
                                  <label class="form-check-label" for="perde">Yan pərdələr</label>
                              </div>
                          </div>
                          <div class="col-md-3">
                              <div class="form-check">
                                  <input class="form-check-input" name="esp" type="checkbox" id="esp">
                                  <label class="form-check-label" for="esp">ESP</label>
                              </div>
                          </div>
                        </div>
                        <div class="form-group m-form__group row">
                            <div class="col-md-12">
                                <h3 class="m-section__title">Əlavə məlumat</h3>
                                <div class="clearfix"></div>
                                <textarea name="additional_information" class="form-control"></textarea>
                            </div>
                        </div>
                        <div class="form-group m-form__group row">
                            <div class="col-md-12">
                                <h3 class="m-section__title">Şəkillər</h3>
                                <div class="clearfix"></div>
                                <div class="form">
                                    <!-- file input -->
                                    <input type="file" name="files" class="gallery_media">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--end::Portlet-->
            </div>
            <!--Sidebar Start-->
            <div class="col-lg-3">
                <!--begin::Portlet-->
                <div class="m-portlet m-portlet--accent m-portlet--head-solid-bg m-portlet--head-sm" m-portlet="true" id="m_portlet_tools_2">
                    <div class="m-portlet__head">
                        <div class="m-portlet__head-caption">
                            <div class="m-portlet__head-title">
                                <span class="m-portlet__head-icon m--hide">
                                    <i class="la la-gear"></i>
                                </span>
                                <h3 class="m-portlet__head-text">
                                    Seçimlər
                                </h3>
                            </div>
                        </div>
                    </div>
                    <div class="m-portlet__body">
                        <br />
                        <div class="form-group row">
                            <div class="col-lg-12">
                                <label>Youtube link</label>
                                <input name="youtube_link" class="form-control" value="">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-lg-12">
                                <label>Qiymət</label>
                                <input type="number" name="price" class="form-control m-input"  value="" required>
                                <!-- <div class="form-check">
                                    <input class="form-check-input" name="agreement" type="checkbox" id="agreement">
                                    <label class="form-check-label" for="agreement">Razılaşma yolu ilə</label>
                                </div> -->
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-lg-12">
                                <label>Valyuta</label>
                                <div class="m-radio-inline">
                                    <label class="m-radio m-radio--solid">
                                      <input checked type="radio" name="valyuta" value="0">
                                      AZN
                                      <span></span>
                                    </label>
                                    <label class="m-radio m-radio--solid">
                                      <input type="radio" name="valyuta" value="1">
                                      USD
                                      <span></span>
                                    </label>
                                    <label class="m-radio m-radio--solid">
                                      <input type="radio" name="valyuta" value="2">
                                      EUR
                                      <span></span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-lg-12">
                                <label>Elanı verən</label>
                                <input list="author_search" class="form-control">
          											<datalist id="author_search">
                                  <?php foreach($users as $row): ?>
          													<option data-value="<?=$row->id; ?>" value="<?=$row->first_name.' - '.$row->mobile; ?>">
                                  <?php endforeach; ?>
          											</datalist>
          											<input type="hidden" name="author_id" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-lg-12">
                                <label>Elanın pin kodu</label>
          											<input type="text" disabled class="form-control" value="<?=$pincode; ?>">
                                <input type="hidden" name="pincode" value="<?=$pincode; ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-lg-12">
                                <label>Elanın statusu</label>
                                <select class="form-control" name="status" required>
                                    <option value="0">Gözləmədə</option>
                                    <option value="1">Aktiv</option>
                                </select>
                            </div>
                        </div>
                        <div style="display: none" class="form-group row reject_reason_div">
                            <div class="col-lg-12">
                                <label>İmtina səbəbi</label>
                                <textarea class="form-control" name="reject_reason"></textarea>
                            </div>
                        </div>
                        <br>
                        <div class="form-group m-form__group row">
                            <div class="col-lg-12">
                                <button type="submit" class="btn btn-primary btn-block"><i class="fa fa-save"></i> Yadda saxla</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!--end::Portlet-->
            </div>
            <!--Sidebar End-->
        </div>
    </form>
    <!--end::Form-->
    <input type="hidden" name="product_id" value="999999999">
</div>
</div>
<script src="/assets/demo/default/custom/components/portlets/tools.js" type="text/javascript"></script>
<script src="/assets/demo/default/custom/crud/forms/widgets/select2.js" type="text/javascript"></script>
<script src="/assets/demo/default/custom/crud/forms/widgets/bootstrap-datetimepicker.js" type="text/javascript"></script>
<link rel="stylesheet" type="text/css" href="/Css/icon.css">

<script type="text/javascript">

  var token = $('#token').val();

  $(document).on('change', 'input[name="agreement"]', function(){
    if (this.checked)
      $('input[name="price"]').attr('disabled', true);
    else
        $('input[name="price"]').attr('disabled', false);
  });

  /*----- DATA LIST -----*/

  $(document).on('input', 'input[list="author_search"]', function(){
    $('input[name="author_id"]').val('');

    var input = $(this).val();
    $('datalist option').each(function(i) {
      if($(this).val() == input) {
        var author_id = $(this).attr('data-value');
        $('input[name="author_id"]').val(author_id);
      }
    });
  });

  $(document).on('change', 'select[name="marka"]', function(){
    $('select[name="model"]').html('');
    $('select[name="model"]').attr('disabled', true);
    var thiss = $(this);

    $.ajax({
      url: '/cars/get_model_list',
      type: 'POST',
      data: { otomoto: token, mark: thiss.val() },
      success: function(data){
        var res = $.parseJSON(data);
        token = res['otomoto'];
        $('#token').val(res['otomoto']);

        var html = '';
        for(var i=0; i < res['model'].length; i++)
          html = html + '<option value="'+ res['model'][i].id +'">'+ res['model'][i].model +'</option>';
        $('select[name="model"]').html(html);
        $('select[name="model"]').attr('disabled', false);
      }
    });
  });

/*----- REJECT REASON -----*/

$(document).on('change', 'select[name="status"]', function(){
  if ($(this).val() == 3)
    $('.reject_reason_div').slideDown(200);
  else
    $('.reject_reason_div').slideUp(100);
});

/*------ NEW FILE UPLOADER ------*/

$(document).ready(function() {

  var product_id = $('input[name="product_id"]').val();

  $.get('/cars/add_img/?type=preload&product_id='+product_id, function(result) {
      var preloaded = [];

      try {
          preloaded = JSON.parse(result);
      } catch(e) {}

      $(document).on('click', '.fileuploader-action-asmain', function (evt) {
          $('.fileuploader-action-asmain').removeClass("selected_img");
          $(this).addClass("selected_img");
          var li = $(this).closest("li");
          $(this).closest("li").fadeOut(300, function(){

              $("ul.fileuploader-items-list li:eq(0)").after(li);
              li.fadeIn(300);
              var i=0;
              var list = [];
              $("ul.fileuploader-items-list li").each(function(){
                  if(i!=0)
                  {
                      var img_id = $(this).find("img").attr("id");
                      list.push({
                          name: "",
                          id: img_id,
                          index: i
                      });
                  }
                  i++;
              });
              $.post('/cars/add_img/?type=sort&product_id=' + product_id, {
                  list: JSON.stringify(list),
                  otomoto: token
              });
          });
      })
      $('input.gallery_media').fileuploader({
          limit: 25,
          fileMaxSize: 20,
          extensions: ['image/*'],
          changeInput: ' ',
          theme: 'gallery',
          enableApi: true,
          files: preloaded,
          thumbnails: {
              box: '<div class="fileuploader-items">' +
                  '<ul class="fileuploader-items-list">' +
                  '<li class="fileuploader-input"><div class="fileuploader-input-inner"><div class="fa fa-cloud-upload-alt"></div> <span>${captions.feedback}</span></div></li>' +
                  '</ul>' +
                  '</div>',
              item: '<li class="fileuploader-item file-has-popup">' +
                  '<div class="fileuploader-item-inner">' +
                  '<div class="actions-holder">' +
                  '<a class="fileuploader-action fileuploader-action-sort is-hidden" title="${captions.sort}"><i class="fa fa-arrows"></i></a>' +

                  '<a class="fileuploader-action fileuploader-action-popup fileuploader-action-settings is-hidden" title="${captions.edit}"><i class="fa fa-pencil"></i></a>' +
                  '<a class="fileuploader-action fileuploader-action-remove" title="${captions.remove}"><i class="fa fa-trash"></i></a>' +

                  '</div>' +
                  '<div class="thumbnail-holder" style="">' +
                  '${image}' +
                  '<span class="fileuploader-action-popup"></span>' +
                  '<div class="progress-holder"><span></span>${progressBar}</div>' +
                  '</div>' +
                  '</div>' +
                  '<a class="fileuploader-action-asmain" title="">${captions.setting_asMain}</a>' +
                  '</li>',
              item2: '<li class="fileuploader-item file-has-popup file-main-${data.isMain}">' +
                  '<div class="fileuploader-item-inner">' +
                  '<div class="actions-holder">' +
                  '<a class="fileuploader-action fileuploader-action-sort" title="${captions.sort}"><i class="fa fa-arrows-alt"></i></a>' +
                  '<a class="fileuploader-action fileuploader-action-remove" title="${captions.remove}"><i class="fa fa-trash"></i></a>' +

                  '</div>' +
                  '<div class="thumbnail-holder" style="">' +
                  '${image}' +
                  '<span class="fileuploader-action-popup"></span>' +
                  '</div>' +
                  '</div>' +
                  '<a class="fileuploader-action-asmain" title="">${captions.setting_asMain}</a>' +
                  '</li>',
              itemPrepend: false,
              startImageRenderer: true,
              canvasImage: false,
              onItemShow: function(item, listEl, parentEl, newInputEl, inputEl) {
                  var api = $.fileuploader.getInstance(inputEl),
                      color = api.assets.textToColor(item.format),
                      $plusInput = listEl.find('.fileuploader-input'),
                      $progressBar = item.html.find('.progress-holder');

                  // put input first in the list
                  $plusInput.prependTo(listEl);

                  // color the icon and the progressbar with the format color
                  item.html.find('.type-holder .fileuploader-item-icon')[api.assets.isBrightColor(color) ? 'addClass' : 'removeClass']('is-bright-color').css('backgroundColor', color);
                  $progressBar.css('backgroundColor', color);
              },
              onImageLoaded: function(item, listEl, parentEl, newInputEl, inputEl) {
                  var api = $.fileuploader.getInstance(inputEl);

                  // check the image size
                  if (item.format == 'image' && item.upload && !item.imU) {
                      if (item.reader.node && (item.reader.width < 100 || item.reader.height < 100)) {
                          alert(api.assets.textParse(api.getOptions().captions.imageSizeError, item));
                          return item.remove();
                      }

                      item.image.hide();
                      item.reader.done = true;
                      item.upload.send();
                  }

              },
              onItemRemove: function(html) {
                  html.fadeOut(250);
              }
          },
          dragDrop: {
              container: '.fileuploader-theme-gallery .fileuploader-input'
          },
          upload: {
              url: '/cars/add_img/?type=upload&product_id='+product_id,
              data: null,
              type: 'POST',
              enctype: 'multipart/form-data',
              start: true,
              synchron: true,
              beforeSend: function(item) {
                  item.upload.data.otomoto = token;
                  // check the image size first (onImageLoaded)
                  if (item.format == 'image' && !item.reader.done)
                      return false;

                  // add editor to upload data after editing
                  if (item.editor && (typeof item.editor.rotation != "undefined" || item.editor.crop)) {
                      item.imU = true;
                      item.upload.data.file = item.name;
                      item.upload.data.id = item.data.listProps.id;
                      item.upload.data._editorr = JSON.stringify(item.editor);
                  }

                  item.html.find('.fileuploader-action-success').removeClass('fileuploader-action-success');
              },
              onSuccess: function(result, item) {
                  var data = {};

                  try {
                      data = JSON.parse(result);
                  } catch (e) {
                      data.hasWarnings = true;
                  }

                  // if success update the information
                  if (data.isSuccess && data.files.length) {
                      if (!item.data.listProps)
                          item.data.listProps = {};
                      //item.title = data.files[0].title;
                      item.name = data.files[0].name;
                      item.size = data.files[0].size;
                      item.size2 = data.files[0].size2;
                      item.data.url = data.files[0].url;
                      item.data.listProps.id = data.files[0].id;

                      item.html.find('.gallery-item-dropdown [download]').attr('href', item.data.url);
                  }

                  // if warnings
                  if (data.hasWarnings) {
                      for (var warning in data.warnings) {
                          alert(data.warnings[warning]);
                      }

                      item.html.removeClass('upload-successful').addClass('upload-failed');
                      return this.onError?this.onError(item):null;
                  }

                  delete item.imU;
                  item.html.find('.fileuploader-action-remove').addClass('fileuploader-action-success');

                  setTimeout(function() {
                      item.html.find('.progress-holder').hide();

                      item.html.find('.fileuploader-action-popup, .fileuploader-item-image').show();
                      item.html.find('.fileuploader-action-sort').removeClass('is-hidden');
                      item.html.find('.fileuploader-action-settings').removeClass('is-hidden');
                  }, 400);
              },
              onError: function(item) {
                  item.html.find('.progress-holder, .fileuploader-action-popup, .fileuploader-item-image').hide();

                  // add retry button
                  item.upload.status != 'cancelled' && !item.imU && !item.html.find('.fileuploader-action-retry').length ? item.html.find('.actions-holder').prepend(
                      '<a class="fileuploader-action fileuploader-action-retry" title="Retry"><i></i></a>'
                  ) : null;
              },
              onProgress: function(data, item) {
                  var $progressBar = item.html.find('.progress-holder');

                  if ($progressBar.length) {
                      $progressBar.show();
                      $progressBar.find('span').text(data.percentage + '%');
                      $progressBar.find('.fileuploader-progressbar .bar').height(data.percentage + '%');
                  }

                  item.html.find('.fileuploader-action-popup, .fileuploader-item-image').hide();
              }
          },
          sorter: {
              onSort: function(list, listEl, parentEl, newInputEl, inputEl) {
                  var i = 0;
                  var list = [];
                  $("ul.fileuploader-items-list li").each(function(){
                      if(i!=0)
                      {
                          var img_id = $(this).find("img").attr("id");
                          list.push({
                              name: "",
                              id: img_id,
                              index: i
                          });
                      }
                      i++;
                  });
                  $.post('/cars/add_img/?type=sort&product_id='+product_id, {
                      list: JSON.stringify(list),
                      otomoto: token
                  });

              }
          },
          afterRender: function(listEl, parentEl, newInputEl, inputEl) {
              var api = $.fileuploader.getInstance(inputEl),
                  $plusInput = listEl.find('.fileuploader-input');

              // bind input click
              $plusInput.on('click', function() {
                  api.open();
              });

              // bind dropdown buttons
              $('body').on('click', function(e) {
                  var $target = $(e.target),
                      $item = $target.closest('.fileuploader-item'),
                      item = api.findFile($item);
                  $('.gallery-item-dropdown').hide();
                  if ($target.is('.fileuploader-action-settings') || $target.parent().is('.fileuploader-action-settings')) {
                      $item.find('.gallery-item-dropdown').show(150);
                  }
              });
          },
          onRemove: function(item) {
              // send request
              if (item.data.listProps)
                  $.post('/cars/add_img/?type=remove&product_id='+product_id, {
                      name: item.name,
                      id: item.data.listProps.id,
                      otomoto: token
                  });
          },
          captions: {
              feedback: 'Şəkil yükləyin',
              setting_asMain: 'Əsas şəkil et',
              setting_download: 'Yüklə',
              setting_edit: 'Redaktə',
              setting_rename: 'Ad dəyişdir',
              rename: 'Faylın yeni adını daxil edin:',
              renameError: 'Zəhmət olmasa başqa ad yazın.',
              imageSizeError: 'Şəklin ${name} həcmi çox kiçikdir.',
              errors: {
                  filesLimit: 'Yalnız ${limit} şəkil yükləməyə icazə verilir.',
                  filesType: 'Yalnız Şəkil formatlarına icazə verilir.',
                  fileSize: '${name} is too large! Please choose a file up to ${fileMaxSize}MB.',
                  filesSizeAll: 'Files that you chose are too large! Please upload files up to ${maxSize} MB.',
                  fileName: 'File with the name ${name} is already selected.',
                  folderUpload: 'You are not allowed to upload folders.'
              }
          }
      });
  });
});
</script>
<style type="text/css">
    .param_group_container
    {
      margin-top: 20px;
    }
    .m-form.m-form--fit .m-form__content, .m-form.m-form--fit .m-form__group, .m-form.m-form--fit .m-form__heading {
      padding-left: 0px;
      padding-right: 0px;
    }
    .m-option h4
    {
      margin-top: 0;
      border-bottom: 2px solid #91dd71;
      display: inline-block;
      padding-bottom: 5px;
    }
    .m-option
    {
      border: 1px solid #91dd71;
      margin-top: 10px;
    }

    .m-option .col-md-4
    {
      padding-top: 20px;
    }
</style>

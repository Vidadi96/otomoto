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
    <form action="/cars/edit_car/<?=$this->uri->segment(3); ?>" method="POST" class="m-form m-form--fit m-form--label-align-right m-form--group-seperator-dashed">
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
                                <h3 class="m-section__title">Avtomobilin m??lumatlar??</h3>
                            </div>
                            <br>
                            <br>
                            <div class="col-md-4">
                              <label for="marka">Marka</label>
                              <select class="form-control" name="marka" id="marka">
                                <?php foreach ($mark as $row): ?>
                                  <option <?=($car_data->mark == $row->id)?'selected':''; ?> value="<?=$row->id; ?>"><?=$row->mark; ?></option>
                                <?php endforeach; ?>
                              </select>
                            </div>
                            <div class="col-md-4">
                              <label for="model">Model</label>
                              <select class="form-control" name="model" id="model">
                                <?php foreach ($model as $row): ?>
                                  <option <?=($car_data->model == $row->id)?'selected':''; ?> value="<?=$row->id; ?>"><?=$row->model; ?></option>
                                <?php endforeach; ?>
                              </select>
                            </div>
                            <div class="col-md-4">
                              <label for="year">??l</label>
                              <select class="form-control" name="year" id="year">
                                <?php for ($i= ((int) date('Y') - 60); $i < ((int) date('Y') + 1); $i++) {
                                  echo '<option '.(($car_data->year == $i)?'selected ':'').'value="'.$i.'">'.$i.'</option>';
                                } ?>
                              </select>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <div class="form-group m-form__group row" style="">
                            <div class="col-md-4">
                              <label for="city">????h??r</label>
                              <select class="form-control" name="city" id="city">
                                <?php foreach ($city as $row): ?>
                                  <option <?=($car_data->city == $row->id)?'selected':''; ?> value="<?=$row->id; ?>"><?=$row->ad; ?></option>
                                <?php endforeach; ?>
                              </select>
                            </div>
                            <div class="col-md-4">
                              <label for="car_body">Ban n??v??</label>
                              <select class="form-control" name="car_body" id="car_body">
                                <?php foreach ($body as $row): ?>
                                  <option <?=($car_data->body == $row->id)?'selected':''; ?> value="<?=$row->id; ?>"><?=$row->body; ?></option>
                                <?php endforeach; ?>
                              </select>
                            </div>
                            <div class="col-md-4">
                              <label for="mileage">Y??r????</label>
                              <input class="form-control" type="number" name="mileage" id="mileage" value="<?=$car_data->mileage; ?>">
                            </div>
                            <div class="col-md-4">
                              <label for="engine">M??h??rrik</label>
                              <select class="form-control" name="engine" id="engine">
                                <?php foreach ($engine as $row): ?>
                                  <option <?=($car_data->engine == $row->id)?'selected':''; ?> value="<?=$row->id; ?>"><?=$row->engine; ?></option>
                                <?php endforeach; ?>
                              </select>
                            </div>
                            <div class="col-md-4">
                              <label for="fuel">Yanacaq n??v??</label>
                              <select class="form-control" name="fuel" id="fuel">
                                <?php foreach($fuel as $row): ?>
                                  <option <?=($car_data->fuel == $row)?'selected':''; ?> value="<?=$row; ?>"><?=$row; ?></option>
                                <?php endforeach; ?>
                              </select>
                            </div>
                            <div class="col-md-4">
                              <label for="horse_power">At g??c??</label>
                              <input class="form-control" type="number" name="horse_power" id="horse_power" value="<?=$car_data->horsepower; ?>">
                            </div>
                            <div class="col-md-4">
                              <label for="transmission">S??r??tl??r qutusu</label>
                              <select class="form-control" name="transmission" id="transmission">
                                <?php foreach($transmission as $row): ?>
                                  <option <?=($car_data->transmission == $row)?'selected':''; ?> value="<?=$row; ?>"><?=$row; ?></option>
                                <?php endforeach; ?>
                              </select>
                            </div>
                            <div class="col-md-4">
                              <label for="drive">??t??r??c??</label>
                              <select class="form-control" name="drive" id="drive">
                                <?php foreach($drive as $row): ?>
                                  <option <?=($car_data->drive == $row)?'selected':''; ?> value="<?=$row; ?>"><?=$row; ?></option>
                                <?php endforeach; ?>
                              </select>
                            </div>
                            <div class="col-md-4">
                              <label for="interior_color">Salon r??ngi</label>
                              <select class="form-control" name="interior_color" id="interior_color">
                                <?php foreach ($interiorcolor as $row): ?>
                                  <option <?=($car_data->interiorcolor == $row->id)?'selected':''; ?> value="<?=$row->id; ?>"><?=$row->interiorcolor; ?></option>
                                <?php endforeach; ?>
                              </select>
                            </div>
                            <div class="col-md-4">
                              <label for="color">R??ngi</label>
                              <select class="form-control" name="color" id="color">
                                <?php foreach ($color as $row): ?>
                                  <option <?=($car_data->color == $row->id)?'selected':''; ?> value="<?=$row->id; ?>"><?=$row->color; ?></option>
                                <?php endforeach; ?>
                              </select>
                            </div>
                            <div class="col-md-12">
                              <br>
                            </div>
                            <div class="col-md-12">
                                <div class="form-check">
                                    <input <?=$car_data->credit?'checked':''; ?> class="form-check-input" name="credit" type="checkbox" id="credit">
                                    <label class="form-check-label" for="credit">Kredit</label>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-check">
                                    <input <?=$car_data->barter?'checked':''; ?> class="form-check-input" name="barter" type="checkbox" id="barter">
                                    <label class="form-check-label" for="barter">Barter</label>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <div class="form-group m-form__group row">
                          <div class="col-md-3">
                              <div class="form-check">
                                  <input <?=$car_data->wheels?'checked':''; ?> class="form-check-input" name="disk" type="checkbox" id="disk">
                                  <label class="form-check-label" for="disk">Y??ng??l lehimli diskl??r</label>
                              </div>
                          </div>
                          <div class="col-md-3">
                              <div class="form-check">
                                  <input <?=$car_data->parkingsensor?'checked':''; ?> class="form-check-input" name="radar" type="checkbox" id="radar">
                                  <label class="form-check-label" for="radar">Park radar??</label>
                              </div>
                          </div>
                          <div class="col-md-3">
                              <div class="form-check">
                                  <input <?=$car_data->camera?'checked':''; ?> class="form-check-input" name="camera" type="checkbox" id="camera">
                                  <label class="form-check-label" for="camera">Arxa g??r??nt?? kameras??</label>
                              </div>
                          </div>
                          <div class="col-md-3">
                              <div class="form-check">
                                  <input <?=$car_data->centrallocking?'checked':''; ?> class="form-check-input" name="qapanma" type="checkbox" id="qapanma">
                                  <label class="form-check-label" for="qapanma">M??rk??zi qapanma</label>
                              </div>
                          </div>
                          <div class="col-md-3">
                              <div class="form-check">
                                  <input <?=$car_data->xenon?'checked':''; ?> class="form-check-input" name="lampa" type="checkbox" id="lampa">
                                  <label class="form-check-label" for="lampa">Ksenon lampalar</label>
                              </div>
                          </div>
                          <div class="col-md-3">
                              <div class="form-check">
                                  <input <?=$car_data->leather?'checked':''; ?> class="form-check-input" name="leather" type="checkbox" id="leather">
                                  <label class="form-check-label" for="leather">D??ri salon</label>
                              </div>
                          </div>
                          <div class="col-md-3">
                              <div class="form-check">
                                  <input <?=$car_data->sunproof?'checked':''; ?> class="form-check-input" name="lyuk" type="checkbox" id="lyuk">
                                  <label class="form-check-label" for="lyuk">Lyuk</label>
                              </div>
                          </div>
                          <div class="col-md-3">
                              <div class="form-check">
                                  <input <?=$car_data->heatedseats?'checked':''; ?> class="form-check-input" name="isidilme" type="checkbox" id="isidilme">
                                  <label class="form-check-label" for="isidilme">Oturacaqlar??n isidilm??si</label>
                              </div>
                          </div>
                          <div class="col-md-3">
                              <div class="form-check">
                                  <input <?=$car_data->abs?'checked':''; ?> class="form-check-input" name="abs" type="checkbox" id="abs">
                                  <label class="form-check-label" for="abs">ABS</label>
                              </div>
                          </div>
                          <div class="col-md-3">
                              <div class="form-check">
                                  <input <?=$car_data->aircondition?'checked':''; ?> class="form-check-input" name="kondisioner" type="checkbox" id="kondisioner">
                                  <label class="form-check-label" for="kondisioner">Kondisioner</label>
                              </div>
                          </div>
                          <div class="col-md-3">
                              <div class="form-check">
                                  <input <?=$car_data->rainsensor?'checked':''; ?> class="form-check-input" name="sensor" type="checkbox" id="sensor">
                                  <label class="form-check-label" for="sensor">Ya?????? sensoru</label>
                              </div>
                          </div>
                          <div class="col-md-3">
                              <div class="form-check">
                                  <input <?=$car_data->seatventilation?'checked':''; ?> class="form-check-input" name="havalandirilma" type="checkbox" id="havaland??r??lma">
                                  <label class="form-check-label" for="havaland??r??lma">Oturacaqlar??n havaland??r??lmas??</label>
                              </div>
                          </div>
                          <div class="col-md-3">
                              <div class="form-check">
                                  <input  <?=$car_data->sidecurtains?'checked':''; ?> class="form-check-input" name="perde" type="checkbox" id="perde">
                                  <label class="form-check-label" for="perde">Yan p??rd??l??r</label>
                              </div>
                          </div>
                          <div class="col-md-3">
                              <div class="form-check">
                                  <input <?=$car_data->esp?'checked':''; ?> class="form-check-input" name="esp" type="checkbox" id="esp">
                                  <label class="form-check-label" for="esp">ESP</label>
                              </div>
                          </div>
                        </div>
                        <div class="form-group m-form__group row">
                            <div class="col-md-12">
                                <h3 class="m-section__title">??lav?? m??lumat</h3>
                                <div class="clearfix"></div>
                                <textarea name="additional_information" class="form-control"><?=$car_data->additionalinfo; ?></textarea>
                            </div>
                        </div>
                        <div class="form-group m-form__group row">
                            <div class="col-md-12">
                                <h3 class="m-section__title">????kill??r</h3>
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
                                    Se??iml??r
                                </h3>
                            </div>
                        </div>
                    </div>
                    <div class="m-portlet__body">
                        <br />
                        <div class="form-group row">
                            <div class="col-lg-12">
                                <label>Youtube link</label>
                                <input name="youtube_link" class="form-control" value="<?=$car_data->youtubelink; ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-lg-12">
                                <label>Qiym??t</label>
                                <input <?=$car_data->agreement?'disabled':''; ?> type="number" name="price" class="form-control m-input"  value="<?=$car_data->price; ?>">
                                <!-- <div class="form-check">
                                    <input <?=$car_data->agreement?'checked':''; ?> class="form-check-input" name="agreement" type="checkbox" id="agreement">
                                    <label class="form-check-label" for="agreement">Raz??la??ma yolu il??</label>
                                </div> -->
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-lg-12">
                                <label>Valyuta</label>
                                <div class="m-radio-inline">
                                    <label class="m-radio m-radio--solid">
                                      <input type="radio" name="valyuta" <?=$car_data->currency==0?'checked':''; ?> value="0">
                                      AZN
                                      <span></span>
                                    </label>
                                    <label class="m-radio m-radio--solid">
                                      <input type="radio" name="valyuta" <?=$car_data->currency==1?'checked':''; ?> value="1">
                                      USD
                                      <span></span>
                                    </label>
                                    <label class="m-radio m-radio--solid">
                                      <input type="radio" name="valyuta" <?=$car_data->currency==2?'checked':''; ?> value="2">
                                      EUR
                                      <span></span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-lg-12">
                                <label>Elan?? ver??n</label>
                                <input list="author_search" class="form-control" value="<?=$car_data->first_name." - ".$car_data->mobile; ?>">
          											<datalist id="author_search">
                                  <?php foreach($users as $row): ?>
          													<option data-value="<?=$row->id; ?>" value="<?=$row->first_name.' - '.$row->mobile; ?>">
                                  <?php endforeach; ?>
          											</datalist>
          											<input type="hidden" name="author_id" required value="<?=$car_data->authorid; ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-lg-12">
                                <label>Elan??n pin kodu</label>
                                <input value="<?=$car_data->pincode; ?>" type="text" class="form-control" disabled>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-lg-12">
                                <label>Elan??n statusu</label>
                                <select class="form-control" name="status">
                                    <option <?=($car_data->status == 0)?'selected':''; ?> value="0">G??zl??m??d??</option>
                                    <option <?=($car_data->status == 1)?'selected':''; ?> value="1">Aktiv</option>
                                    <option <?=($car_data->status == 2)?'selected':''; ?> value="2">Deaktiv</option>
                                    <option <?=($car_data->status == 3)?'selected':''; ?> value="3">??mtina edilmi??</option>
                                    <option <?=($car_data->status == 4)?'selected':''; ?> value="4">Silinmi??</option>
                                </select>
                            </div>
                        </div>
                        <div style="display:<?=$car_data->status==3?'block':'none'; ?>" class="form-group row reject_reason_div">
                            <div class="col-lg-12">
                                <label>??mtina s??b??bi</label>
                                <textarea class="form-control" name="reject_reason"><?=$car_data->reject_reason; ?></textarea>
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
    <input type="hidden" name="product_id" value="<?=$car_data->id; ?>">
    <input type="hidden" name="added" value="<?=$added; ?>">
</div>
</div>
<script src="/assets/demo/default/custom/components/portlets/tools.js" type="text/javascript"></script>
<script src="/assets/demo/default/custom/crud/forms/widgets/select2.js" type="text/javascript"></script>
<script src="/assets/demo/default/custom/crud/forms/widgets/bootstrap-datetimepicker.js" type="text/javascript"></script>
<link rel="stylesheet" type="text/css" href="/Css/icon.css">

<script type="text/javascript">

  var token = $('#token').val();

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

  $(document).on('change', 'input[name="agreement"]', function(){
    if (this.checked)
      $('input[name="price"]').attr('disabled', true);
    else
        $('input[name="price"]').attr('disabled', false);
  });

  $(document).ready(function() {
    if ($('input[name="added"]').val() == 1)
      toastr["success"]('U??urla ??lav?? edildi', "U??ur");
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
              feedback: '????kil y??kl??yin',
              setting_asMain: '??sas ????kil et',
              setting_download: 'Y??kl??',
              setting_edit: 'Redakt??',
              setting_rename: 'Ad d??yi??dir',
              rename: 'Fayl??n yeni ad??n?? daxil edin:',
              renameError: 'Z??hm??t olmasa ba??qa ad yaz??n.',
              imageSizeError: '????klin ${name} h??cmi ??ox ki??ikdir.',
              errors: {
                  filesLimit: 'Yaln??z ${limit} ????kil y??kl??m??y?? icaz?? verilir.',
                  filesType: 'Yaln??z ????kil formatlar??na icaz?? verilir.',
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

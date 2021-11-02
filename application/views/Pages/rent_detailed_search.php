<input type="hidden" id="token" name="<?=$this->security->get_csrf_token_name(); ?>" value="<?=$this->security->get_csrf_hash(); ?>">
<div class="my_container">
  <span class="page_title">Ətraflı axtarış</span>
  <form action="/pages/rent_car" method="get" class="firefox_row">
  <div class="row">
      <div class="col-md-6">

          <div class="filter_line mobile_none">
            <div class="col-md-4 col-4">
              <span class="filter_title">Sinif</span>
            </div>
            <div class="col-md-8 mobile_none">
              <select name="class" title="Sinif seç" class="form-control class_select">
                  <option value="">Bütün siniflər</option>
                  <?php foreach ($classes as $row): ?>
                      <option <?=$row->id == $class?'selected':''; ?> value="<?=$row->id; ?>"><?=$row->class; ?></option>
                  <?php endforeach; ?>
              </select>
            </div>
          </div>
          <div class="filter_line">
            <div class="col-md-4 col-4">
              <span class="filter_title">Marka</span>
            </div>
            <div class="col-md-8 mobile_none">
              <select name="mark_array[]" title="Bütün markalar" style="font-size: 20px" id="mark_picker" class="form-control" multiple data-live-search="false">
                  <?php foreach ($mark as $row):
                          $val = false;
                          foreach($mark_array as $raw) {
                            if ($raw == $row->id) {
                              $val = true;
                              break;
                            }
                          }
                  ?>
                      <option <?=$val?'selected':''; ?> value="<?=$row->id; ?>"><?=$row->mark; ?></option>
                  <?php endforeach; ?>
              </select>
            </div>
            <div class="for_filter_button col-md-8 mobile_open col-8">
              <button type="button" style="text-align: left; border: 1px solid #dadfe3; color: #6f7d8d;" class="btn btn-default filter_button"><?=(isset($filter_mark_name) && $filter_mark_name)?($filter_model_name?$filter_mark_name->mark.' '.$filter_model_name->model:$filter_mark_name->mark):'Hamısı'; ?></button>
              <div class="null_button" style="<?=(isset($filter_mark_name) && $filter_mark_name)?'display: flex':''; ?>">
                <i class="fa fa-times" aria-hidden="true"></i>
              </div>
              <input type="hidden" name="mark" class="mobile_mark" value="<?=(isset($filter_mark2))?$filter_mark2:''; ?>">
              <input type="hidden" name="model" class="mobile_model" value="<?=(isset($filter_mark2))?$filter_model2:''; ?>">
            </div>
          </div>
          <div class="filter_line mobile_none">
            <div class="col-md-4 col-4">
              <span class="filter_title">Model</span>
            </div>
            <div class="col-md-8 col-8">
              <select name="model_array[]" title="Bütün modellər" style="font-size: 20px" id="model_picker" class="form-control" multiple data-live-search="false">
                  <?php foreach ($model as $row):
                          $val = false;
                          foreach($model_array as $raw) {
                            if ($raw == $row->id) {
                              $val = true;
                              break;
                            }
                          }
                  ?>
                      <option <?=$val?'selected':''; ?> value="<?=$row->id; ?>"><?=$row->model; ?></option>
                  <?php endforeach; ?>
              </select>
            </div>
          </div>
          <div class="filter_line">
            <div class="col-md-4 col-4">
              <span class="filter_title">Ban növü</span>
            </div>
            <div class="col-md-8 col-8">
              <select name="body[]" title="Bütün tiplər" style="font-size: 20px" id="body_picker" class="form-control mobile_none" multiple data-live-search="false">
                  <?php foreach ($body as $row):
                    $val = false;
                    foreach($body_array as $raw) {
                      if ($raw == $row->id) {
                        $val = true;
                        break;
                      }
                    }
                  ?>
                      <option <?=$val?'selected':''; ?> value="<?=$row->id; ?>"><?=$row->body; ?></option>
                  <?php endforeach; ?>
              </select>
              <select name="body[]" class="form-control mobile_open select_style">
                  <option value="">Bütün tiplər</option>
                  <?php foreach ($body as $row):
                    $val = false;
                    foreach($body_array as $raw) {
                      if ($raw == $row->id) {
                        $val = true;
                        break;
                      }
                    }
                  ?>
                      <option <?=$val?'selected':''; ?> value="<?=$row->id; ?>"><?=$row->body; ?></option>
                  <?php endforeach; ?>
              </select>
            </div>
          </div>
          <div class="filter_line">
            <div class="col-md-4 col-4">
              <span class="filter_title">Rəng</span>
            </div>
            <div class="col-md-8 col-8">
              <select name="color[]" title="Bütün rənglər" style="font-size: 20px" id="color_picker" class="form-control mobile_none" multiple data-live-search="false">
                  <?php foreach ($color as $row):
                    $val = false;
                    foreach($color_array as $raw) {
                      if ($raw == $row->id) {
                        $val = true;
                        break;
                      }
                    }
                  ?>
                      <option <?=$val?'selected':''; ?> value="<?=$row->id; ?>"><?=$row->color; ?></option>
                  <?php endforeach; ?>
              </select>
              <select name="color[]" id="color_picker" class="form-control mobile_open select_style">
                  <option value="">Bütün rənglər</option>
                  <?php foreach ($color as $row):
                    $val = false;
                    foreach($color_array as $raw) {
                      if ($raw == $row->id) {
                        $val = true;
                        break;
                      }
                    }
                  ?>
                      <option <?=$val?'selected':''; ?> value="<?=$row->id; ?>"><?=$row->color; ?></option>
                  <?php endforeach; ?>
              </select>
            </div>
          </div>
          <div class="filter_line">
            <div class="col-md-4 col-4">
              <span class="filter_title">Daxil edilmiş km</span>
            </div>
            <div class="col-md-8 col-8">
              <div class="row">
                <table>
                  <tr>
                    <td width="20%" class="mobile_none">
                      <span class="filter_title">min.</span>
                    </td>
                    <td width="30%">
                      <input type="number" value="<?=$min_included_km?$min_included_km:''; ?>" class="form-control filter_mini_input" name="min_included_km" placeholder="min.">
                    </td>
                    <td width="20%" class="span_td mobile_none">
                      <span class="filter_title">maks.</span>
                    </td>
                    <td width="30%">
                      <input type="number" value="<?=$max_included_km?$max_included_km:''; ?>" class="form-control filter_mini_input" name="max_included_km"  placeholder="maks.">
                    </td>
                  </tr>
                </table>
              </div>
            </div>
          </div>
          <div class="filter_line">
            <div class="col-md-4 col-4">
              <span class="filter_title">Qiymət</span>
              <select class="form-control filter_mini_select" name="currency">
                <option <?=$currency==0?'selected':''; ?> value="0">AZN</option>
                <option <?=$currency==1?'selected':''; ?> value="1">USD</option>
                <option <?=$currency==2?'selected':''; ?> value="2">EUR</option>
              </select>
            </div>
            <div class="col-md-8 col-8">
              <div class="row">
                <table>
                  <tr>
                    <td width="20%" class="mobile_none">
                      <span class="filter_title">min.</span>
                    </td>
                    <td width="30%">
                      <input type="number" value="<?=$min_price?$min_price:''; ?>" class="form-control filter_mini_input" name="min_price" value="" placeholder="min.">
                    </td>
                    <td width="20%" class="span_td mobile_none">
                      <span class="filter_title">maks.</span>
                    </td>
                    <td width="30%">
                      <input type="number" value="<?=$max_price?$max_price:''; ?>" class="form-control filter_mini_input" name="max_price" value="" placeholder="maks.">
                    </td>
                  </tr>
                </table>
              </div>
            </div>
          </div>
      </div>
      <div class="col-md-6">
          <div class="filter_line">
            <div class="col-md-4 col-4">
              <span class="filter_title">Şəhər</span>
            </div>
            <div class="col-md-8 col-8">
              <select name="city_array[]" title="Bütün şəhərlər" style="font-size: 20px" id="city_picker" class="form-control mobile_none" multiple data-live-search="false">
                  <?php foreach ($city as $row):
                    $val = false;
                    foreach($city_array as $raw) {
                      if ($raw == $row->id) {
                        $val = true;
                        break;
                      }
                    }
                  ?>
                      <option <?=$val?'selected':''; ?> value="<?=$row->id; ?>"><?=$row->ad; ?></option>
                  <?php endforeach; ?>
              </select>
              <select name="city_array[]" class="form-control mobile_open select_style">
                  <option value="">Bütün şəhərlər</option>
                  <?php foreach ($city as $row):
                    $val = false;
                    foreach($city_array as $raw) {
                      if ($raw == $row->id) {
                        $val = true;
                        break;
                      }
                    }
                  ?>
                      <option <?=$val?'selected':''; ?> value="<?=$row->id; ?>"><?=$row->ad; ?></option>
                  <?php endforeach; ?>
              </select>
            </div>
          </div>
          <div class="filter_line">
            <div class="col-md-4 col-4">
              <span class="filter_title">Yanacaq növü</span>
            </div>
            <div class="col-md-8 col-8">
              <select name="fuel[]" title="Bütün növlər" style="font-size: 20px" id="fuel_picker" class="form-control mobile_none" multiple data-live-search="false">
                  <?php foreach ($fuel as $row):
                    $val = false;
                    foreach($fuel_array as $raw) {
                      if ($raw == $row) {
                        $val = true;
                        break;
                      }
                    }
                  ?>
                      <option <?=$val?'selected':''; ?> value="<?=$row; ?>"><?=$row; ?></option>
                  <?php endforeach; ?>
              </select>
              <select name="fuel[]" class="form-control mobile_open select_style">
                  <option value="">Bütün növlər</option>
                  <?php foreach ($fuel as $row):
                    $val = false;
                    foreach($fuel_array as $raw) {
                      if ($raw == $row) {
                        $val = true;
                        break;
                      }
                    }
                  ?>
                      <option <?=$val?'selected':''; ?> value="<?=$row; ?>"><?=$row; ?></option>
                  <?php endforeach; ?>
              </select>
            </div>
          </div>
          <div class="filter_line">
            <div class="col-md-4 col-4">
              <span class="filter_title">Sürətlər qutusu</span>
            </div>
            <div class="col-md-8 col-8">
              <select name="transmission[]" title="Bütün növlər" style="font-size: 20px" id="transmission_picker" class="form-control mobile_none" multiple data-live-search="false">
                  <?php foreach ($transmission as $row):
                    $val = false;
                    foreach($transmission_array as $raw) {
                      if ($raw == $row) {
                        $val = true;
                        break;
                      }
                    }
                  ?>
                      <option <?=$val?'selected':''; ?> value="<?=$row; ?>"><?=$row; ?></option>
                  <?php endforeach; ?>
              </select>
              <select name="transmission[]" class="form-control mobile_open select_style">
                  <option value="">Bütün növlər</option>
                  <?php foreach ($transmission as $row):
                    $val = false;
                    foreach($transmission_array as $raw) {
                      if ($raw == $row) {
                        $val = true;
                        break;
                      }
                    }
                  ?>
                      <option <?=$val?'selected':''; ?> value="<?=$row; ?>"><?=$row; ?></option>
                  <?php endforeach; ?>
              </select>
            </div>
          </div>
          <div class="filter_line">
            <div class="col-md-4 col-4">
              <span class="filter_title">Depozit</span>
            </div>
            <div class="col-md-8 col-8">
              <div class="row">
                <table>
                  <tr>
                    <td width="20%" class="mobile_none">
                      <span class="filter_title">min.</span>
                    </td>
                    <td width="30%">
                      <input type="number" value="<?=$min_deposit?$min_deposit:''; ?>" class="form-control filter_mini_input" name="min_deposit" placeholder="min.">
                    </td>
                    <td width="20%" class="span_td mobile_none">
                      <span class="filter_title">maks.</span>
                    </td>
                    <td width="30%">
                      <input type="number" value="<?=$max_deposit?$max_deposit:''; ?>" class="form-control filter_mini_input" name="max_deposit"  placeholder="maks.">
                    </td>
                  </tr>
                </table>
              </div>
            </div>
          </div>
          <div class="filter_line">
            <div class="col-md-4 col-4">
              <span class="filter_title">Yürüşün məhdudlaşdırılması</span>
            </div>
            <div class="col-md-8 col-8">
              <div class="row">
                <table>
                  <tr>
                    <td width="20%" class="mobile_none">
                      <span class="filter_title">min.</span>
                    </td>
                    <td width="30%">
                      <input type="number" value="<?=$min_limitation?$min_limitation:''; ?>" class="form-control filter_mini_input" name="min_limitation" placeholder="min.">
                    </td>
                    <td width="20%" class="span_td mobile_none">
                      <span class="filter_title">maks.</span>
                    </td>
                    <td width="30%">
                      <input type="number" value="<?=$max_limitation?$max_limitation:''; ?>" class="form-control filter_mini_input" name="max_limitation"  placeholder="maks.">
                    </td>
                  </tr>
                </table>
              </div>
            </div>
          </div>
          <div class="filter_line">
            <div class="col-md-4 col-4">
              <span class="filter_title">Buraxılış ili</span>
            </div>
            <div class="col-md-8 col-8">
              <div class="row">
                <table>
                  <tr>
                    <td width="20%" class="mobile_none">
                      <span class="filter_title">min.</span>
                    </td>
                    <td width="30%">
                      <input type="number" value="<?=$min_year?$min_year:''; ?>" class="form-control filter_mini_input" name="min_year" value="" placeholder="min.">
                    </td>
                    <td width="20%" class="span_td mobile_none">
                      <span class="filter_title">maks.</span>
                    </td>
                    <td width="30%">
                      <input type="number" value="<?=$max_year?$max_year:''; ?>" class="form-control filter_mini_input" name="max_year" value="" placeholder="maks.">
                    </td>
                  </tr>
                </table>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-6">
          <div class="filter_line">
            <div class="col-md-4 col-4">
            </div>
            <div class="col-md-8 col-8">
              <div class="form-check">
                  <input class="form-check-input" <?=$returning?'checked':''; ?> name="returning" type="checkbox" id="returning">
                  <label class="form-check-label" for="returning">Götürülmə</label>
              </div>
            </div>
          </div>
          <div class="filter_line">
            <div class="col-md-4 col-4">
            </div>
            <div class="col-md-8 col-8">
              <div class="form-check">
                  <input class="form-check-input"<?=$delivery?'checked':''; ?> name="delivery" type="checkbox" id="delivery">
                  <label class="form-check-label" for="delivery">Çatdırılma</label>
              </div>
            </div>
          </div>
        </div>
  </div>
  <span class="not_main_title">
    <span>Avtomobilin təchizatı</span>
    <i class="fa fa-plus mobile_open open_subs" aria-hidden="true"></i>
  </span>
  <div class="form-group m-form__group row firefox_row mobile_none subs">
    <div class="col-md-3">
        <div class="form-check">
            <input class="form-check-input" <?=$disk?'checked':''; ?> name="disk" type="checkbox" id="disk">
            <label class="form-check-label" for="disk">Yüngül lehimli disklər</label>
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-check">
            <input class="form-check-input" <?=$radar?'checked':''; ?> name="radar" type="checkbox" id="radar">
            <label class="form-check-label" for="radar">Park radarı</label>
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-check">
            <input class="form-check-input" <?=$camera?'checked':''; ?> name="camera" type="checkbox" id="camera">
            <label class="form-check-label" for="camera">Arxa görüntü kamerası</label>
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-check">
            <input class="form-check-input" <?=$qapanma?'checked':''; ?> name="qapanma" type="checkbox" id="qapanma">
            <label class="form-check-label" for="qapanma">Mərkəzi qapanma</label>
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-check">
            <input class="form-check-input" <?=$lampa?'checked':''; ?> name="lampa" type="checkbox" id="lampa">
            <label class="form-check-label" for="lampa">Ksenon lampalar</label>
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-check">
            <input class="form-check-input" <?=$leather?'checked':''; ?> name="leather" type="checkbox" id="leather">
            <label class="form-check-label" for="leather">Dəri salon</label>
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-check">
            <input class="form-check-input" <?=$lyuk?'checked':''; ?> name="lyuk" type="checkbox" id="lyuk">
            <label class="form-check-label" for="lyuk">Lyuk</label>
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-check">
            <input class="form-check-input" <?=$isidilme?'checked':''; ?> name="isidilme" type="checkbox" id="isidilme">
            <label class="form-check-label" for="isidilme">Oturacaqların isidilməsi</label>
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-check">
            <input class="form-check-input" <?=$abs?'checked':''; ?> name="abs" type="checkbox" id="abs">
            <label class="form-check-label" for="abs">ABS</label>
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-check">
            <input class="form-check-input" <?=$kondisioner?'checked':''; ?> name="kondisioner" type="checkbox" id="kondisioner">
            <label class="form-check-label" for="kondisioner">Kondisioner</label>
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-check">
            <input class="form-check-input" <?=$sensor?'checked':''; ?> name="sensor" type="checkbox" id="sensor">
            <label class="form-check-label" for="sensor">Yağış sensoru</label>
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-check">
            <input class="form-check-input" <?=$havalandirma?'checked':''; ?> name="havalandirilma" type="checkbox" id="havalandırılma">
            <label class="form-check-label" for="havalandırılma">Oturacaqların havalandırılması</label>
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-check">
            <input class="form-check-input" <?=$perde?'checked':''; ?> name="perde" type="checkbox" id="perde">
            <label class="form-check-label" for="perde">Yan pərdələr</label>
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-check">
            <input class="form-check-input" <?=$esp?'checked':''; ?> name="esp" type="checkbox" id="esp">
            <label class="form-check-label" for="esp">ESP</label>
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-check">
            <input class="form-check-input" <?=$baby_chair?'checked':''; ?> name="baby_chair" type="checkbox" id="baby_chair">
            <label class="form-check-label" for="baby_chair">Uşaq oturacağı</label>
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-check">
            <input class="form-check-input" <?=$roof_rack?'checked':''; ?> name="roof_rack" type="checkbox" id="roof_rack">
            <label class="form-check-label" for="roof_rack">Dam üstü baqaj</label>
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-check">
            <input class="form-check-input" <?=$insurance?'checked':''; ?> name="insurance" type="checkbox" id="insurance">
            <label class="form-check-label" for="insurance">Sığorta</label>
        </div>
    </div>
  </div>
  <span class="not_main_title mobile_none">Axtarışın nəticələri</span>
  <div class="row firefox_row mobile_none">
    <div class="col-md-6">
      <div class="filter_line">
        <div class="col-md-4">
          <span class="filter_title">Çeşidləmə</span>
        </div>
        <div class="col-md-8">
          <select class="form-control filter_mini_input" name="order">
            <option <?=$order=='createdate'?'selected':''; ?> value="createdate">Tarixə görə</option>
            <option <?=$order=='car.price asc'?'selected':''; ?> value="car.price asc">Əvvəlcə ucuz</option>
            <option <?=$order=='car.price desc'?'selected':''; ?> value="car.price desc">Əvvəlvə bahalı</option>
            <option <?=$order=='car.year desc'?'selected':''; ?> value="car.year desc">Buraxılış ili</option>
          </select>
        </div>
      </div>
    </div>
  </div>
  <div class="row firefox_row">
    <div class="col-md-12">
      <button type="submit" class="btn btn-danger main_button">Axtar</button>
    </div>
  </div>
  </form>
</div>

<div class="all_classes_window">
  <div class="marks_mini_head">
    <button type="button" class="class_back btn btn-default">
      <i class="fa fa-chevron-left" aria-hidden="true"></i>
      Geri
    </button>
    <span class="mark_head_title">Bütün siniflər</span>
  </div>
  <div class="class_row">
    <?php foreach ($classes as $row): ?>
      <div class="class_block2" data="<?=$row->id; ?>">
        <img src="/assets/img/rent_classes/<?=$row->img; ?>">
        <div class="class_block_content">
          <span><?=$row->class; ?></span>
          <div class="for_loader"></div>
          <span><?=$row->count?$row->count:0; ?> elan</span>
        </div>
      </div>
    <?php endforeach; ?>
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
  <div class="mark_row">
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

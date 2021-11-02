<input type="hidden" id="token" name="<?=$this->security->get_csrf_token_name(); ?>" value="<?=$this->security->get_csrf_hash(); ?>">

<div class="my_container">
  <div class="mark_select_block">
    <span class="select_title">Marka seçin</span>
    <input type="text" placeholder="Axtarış..." class="form-control appraisement_search_input mark_search">
    <?php foreach($mark_list as $row): ?>
      <div class="appraisement_mark_block" data="<?=$row->ap_mark; ?>">
        <img src="/assets/img/car_marks/small/<?=$row->img; ?>">
        <span><?=$row->mark; ?></span>
      </div>
    <?php endforeach; ?>
  </div>
  <div class="appraisement_selected_block mark_selected_block">
    <span class="selected_title">Marka</span>
    <span class="selected_content">Mercedes</span>
  </div>
  <div class="model_select_block">
    <span class="select_title">Model seçin</span>
    <input type="text" placeholder="Axtarış..." class="form-control appraisement_search_input model_search">
    <div class="for_model_block"></div>
  </div>
  <div class="appraisement_selected_block model_selected_block">
    <span class="selected_title">Model</span>
    <span class="selected_content"></span>
  </div>
  <div class="year_select_block">
    <span class="select_title">İlini seçin</span>
    <input type="text" placeholder="Axtarış..." class="form-control appraisement_search_input year_search">
    <div class="for_year_block"></div>
  </div>
  <div class="appraisement_selected_block year_selected_block">
    <span class="selected_title">İl</span>
    <span class="selected_content"></span>
  </div>

  <button type="button" class="btn btn-danger calculate_button">
    <i class="fa fa-calculator" aria-hidden="true"></i>
    Qiymətləndir
  </button>

  <div class="appraisement_result">
    <span class="result_title">Ortalama qiymət: </span>
    <span class="result_content"></span>
    <span class="relative_100"><b>Diggət:</b> Avtomobilin qiyməti 5-8% kimi komplektasiyasına görə dayişə bilər !</span>
  </div>

</div>

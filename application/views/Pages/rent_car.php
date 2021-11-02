<?php
    function get_url2($row)
    {
      $stitle = stripslashes($row['title']);

      if(preg_match( '/[\p{Cyrillic}]/u', $stitle))
      {
          $cyr  = array('а','б','в','г','д','е','ё','ж','з','и','й','к','л','м','н','о','п','р','с','т','у',
              'ф','х','ц','ч','ш','щ','ъ', 'ы','ь', 'э', 'ю','я',
              'А','Б','В','Г','Д','Е','Ё','Ж','З','И','Й','К','Л','М','Н','О','П','Р','С','Т','У',
              'Ф','Х','Ц','Ч','Ш','Щ','Ъ', 'Ы','Ь', 'Э', 'Ю','Я');
          $lat = array( 'a','b','v','g','d','e','e','zh','z','i','y','k','l','m','n','o','p','r','s','t','u',
              'f' ,'h' ,'ts' ,'ch','sh' ,'sht' ,'i', 'y', 'y', 'e' ,'yu' ,'ya','A','B','V','G','D','E','E','Zh',
              'Z','I','Y','K','L','M','N','O','P','R','S','T','U',
              'F' ,'H' ,'Ts' ,'Ch','Sh' ,'Sht' ,'I' ,'Y' ,'Y', 'E', 'Yu' ,'Ya' );

          $stitle = str_replace($cyr, $lat, $stitle);
      }

      $stitle = htmlspecialchars($stitle);
      $stitle = strtolower($stitle);
      $slug=str_replace('quot;','',$stitle);
      $slug=str_replace('"','',$slug);
      $slug=str_replace('(','',$slug);
      $slug=str_replace(')','',$slug);
      $slug=str_replace('+','',$slug);
      $slug=str_replace('-','',$slug);
      $slug=str_replace('$','',$slug);
      $slug=str_replace("'","",$slug);
      $slug=str_replace(';','',$slug);
      $slug=str_replace(':','',$slug);
      $slug=str_replace(',','',$slug);
      $slug=str_replace('.','',$slug);
      $slug=str_replace(' ','-',$slug);
      $slug=str_replace('ə','e',$slug);
      $slug=str_replace('Ə','e',$slug);
      $slug=str_replace('ü','u',$slug);
      $slug=str_replace('Ü','u',$slug);
      $slug=str_replace('ı','i',$slug);
      $slug=str_replace('İ','i',$slug);
      $slug=str_replace('ö','o',$slug);
      $slug=str_replace('Ö','o',$slug);
      $slug=str_replace('ğ','q',$slug);
      $slug=str_replace('ç','c',$slug);
      $slug=str_replace('Ç','c',$slug);
      $slug=str_replace('ş','s',$slug);
      $slug=str_replace('Ş','s',$slug);
      $slug=str_replace('&','',$slug);
      $slug=str_replace('|','',$slug);
      $slug=str_replace('!','',$slug);
      $url=$slug."/".$row['eid'];
      return $url;
    }
?>

        <input type="hidden" id="main_token" name="<?=$this->security->get_csrf_token_name(); ?>" value="<?=$this->security->get_csrf_hash(); ?>">

        <div class="container category_container">
            <div class="category_div">
                <span class="cat_main_title">Bölümü seç</span>
                <a href="/pages/index?search=1" class="cat_cont">
                    <div class="circle_category_div all_ads_div"></div>
                    <span>Bütün elanlar</span>
                    <p class="mobile_text2">Bölümü seç</p>
                </a>
                <a href="/pages/rent_car" class="cat_cont all_ads">
                    <div class="circle_category_div rent_calculate_div"></div>
                    <span>Rent a car</span>
                </a>
                <a href="/car_showroom" class="cat_cont">
                    <div class="circle_category_div showroom_div"></div>
                    <span>Avtosalonlar</span>
                </a>
                <a href="/pages/auction" class="cat_cont">
                    <div class="circle_category_div auction_div"></div>
                    <span>Hərrac</span>
                </a>
                <a href="/pages/appraisement" class="cat_cont">
                    <div class="circle_category_div calculate_div"></div>
                    <span>Qiymətləndirmə</span>
                </a>

                <a
                  href="https://instagram.com/leykoz.az?igshid=sz5nvx1ouw7v"
                  target="_blank"
                  class="xeyriyye_banner"
                >
                  <img src="/assets/img/banners/xeyriyye.<?=($webp)?'webp':'png'; ?>">
                </a>
            </div>
        </div>
    <main>
    <form action="/pages/rent_car" method="get">
        <div class="container">
            <div class="filter_div">
                <div class="filter_line">
                    <select class="first_select" name="mark">
                        <option value="">Bütün markalar</option>
                        <?php foreach ($mark as $row): ?>
                            <option <?=($filter_mark == $row->id)?'selected':''; ?> value="<?=$row->id; ?>"><?=$row->mark; ?></option>
                        <?php endforeach; ?>
                    </select>
                    <span class="price_span">Qiymət</span>
                    <select class="currency_select" name="currency">
                        <option <?=($filter_currency == 0)?'selected':''; ?> value="0">AZN</option>
                        <option <?=($filter_currency == 1)?'selected':''; ?> value="1">USD</option>
                        <option <?=($filter_currency == 2)?'selected':''; ?> value="2">EUR</option>
                    </select>
                    <input type="text" class="price_input" name="min_price" placeholder="min." value="<?=$filter_min_price?$filter_min_price:''; ?>">
                    <input type="text" class="price_input" name="max_price" placeholder="maks." value="<?=$filter_max_price?$filter_max_price:''; ?>">
                    <label class="cred_bart">
                      Çatdırılma
                      <input type="checkbox" class="filter_checkbox" name="delivery" <?=$filter_delivery?'checked':''; ?>>
                    </label>
                    <select class="second_select" name="city">
                        <option value="">Bütün şəhərlər</option>
                        <?php foreach ($city as $row): ?>
                            <option <?=($filter_city == $row->id)?'selected':''; ?> value="<?=$row->id; ?>"><?=$row->ad; ?></option>
                        <?php endforeach; ?>
                    </select>
                    <button type="submit" class="search_button">Axtar</button>
                </div>
                <div class="filter_line">
                    <select class="first_select" name="model">
                        <option value="">Bütün modellər</option>
                        <?php foreach ($filter_model_list as $row): ?>
                            <option <?=($filter_model == $row->id)?'selected':''; ?> value="<?=$row->id; ?>"><?=$row->model; ?></option>
                        <?php endforeach; ?>
                    </select>
                    <span class="year_span">Buraxılış ili</span>
                    <input type="text" class="year_input" name="min_year" placeholder="min." value="<?=$filter_min_year?$filter_min_year:''; ?>">
                    <input type="text" class="year_input" name="max_year" placeholder="maks." value="<?=$filter_max_year?$filter_max_year:''; ?>">
                    <label class="cred_bart">
                      Götürülmə
                      <input type="checkbox" class="filter_checkbox" name="returning" <?=$filter_returning?'checked':''; ?>>
                    </label>
                    <span class="total_span"><?=$total_row; ?> elan</span>
                    <a href="/pages/rent_detailed_search?<?=$_SERVER['QUERY_STRING']; ?>" class="full_search_button">Ətraflı axtarış</a>
                </div>
            </div>
            <div class="class_div">
              <input type="hidden" name="class" value="<?=$filter_class?$filter_class:''; ?>">
              <?php foreach ($classes as $row): ?>
                <div class="class_block <?=$row->id == $filter_class?'active_class':''; ?>" class_id="<?=$row->id; ?>">
                  <div class="flex_img">
                    <img src="/assets/img/rent_classes/<?=$row->img; ?>">
                  </div>
                  <span><?=$row->class; ?></span>
                </div>
              <?php endforeach; ?>
            </div>
        </div>
    </form>
    <div class="filter_mobile">
        <form action="/pages/rent_car" method="get">
            <div class="filter_row">
              <div class="for_filter_button">
                <button type="button" style="text-align: left; border: 1px solid #dadfe3; color: #6f7d8d;" class="btn btn-default filter_button"><?=(isset($filter_mark_name) && $filter_mark_name)?($filter_model_name?$filter_mark_name->mark.' '.$filter_model_name->model:$filter_mark_name->mark):'Bütün siniflər'; ?></button>
                <div class="null_button" style="<?=(isset($filter_mark_name) && $filter_mark_name)?'display: flex':''; ?>">
                  <i class="fa fa-times" aria-hidden="true"></i>
                </div>
              </div>
            </div>
            <div class="filter_row">
                <input type="number" class="max_price_mobile form-control" name="max_price" placeholder="maks. qiymət" value="<?=$filter_max_price?$filter_max_price:''; ?>">
                <select class="currency_select_mobile form-control" name="currency">
                    <option <?=($filter_currency == 0)?'selected':''; ?> value="0">AZN</option>
                    <option <?=($filter_currency == 1)?'selected':''; ?> value="1">USD</option>
                    <option <?=($filter_currency == 2)?'selected':''; ?> value="2">EUR</option>
                </select>
            </div>
            <div class="filter_row">
                <input type="number" class="min_year_mobile form-control" name="min_year" placeholder="min. il" value="<?=$filter_min_year?$filter_min_year:''; ?>">
                <input type="number" class="max_year_mobile form-control" name="max_year" placeholder="max. il" value="<?=$filter_max_year?$filter_max_year:''; ?>">
                <input type="hidden" name="mark" class="mobile_mark" value="<?=(isset($filter_mark2))?$filter_mark2:''; ?>">
                <input type="hidden" name="model" class="mobile_model" value="<?=(isset($filter_mark2))?$filter_model2:''; ?>">
                <input type="hidden" name="min_price" value="">
                <input type="hidden" name="city" value="">
                <button type="submit" class="btn btn-danger filter_button2">Axtar</button>
            </div>
        </form>

        <span class="mark_list_title">Tez tap:</span>

        <div id="drag" class="filter_row2">
          <?php foreach ($classes as $row): ?>
            <div class="mark_list" data="<?=$row->id; ?>">
              <img src="<?=$row->img?'/assets/img/rent_classes/'.$row->img:'/assets/img/car_photos/logo/nophoto.png'; ?>">
              <span><?=$row->class; ?></span>
            </div>
          <?php endforeach; ?>
        </div>

        <div class="filter_row3">
          <a href="/pages/rent_detailed_search?<?=$_SERVER['QUERY_STRING']; ?>" class="full_search_mobile btn btn-danger">
            <i class="fa fa-search" aria-hidden="true"></i>
            Ətraflı axtarış
          </a>
          <select class="select_mobile">
            <option value="">Çeşidləmə</option>
            <option <?=$order=='createdate'?'selected':''; ?> value="createdate">Tarixə görə</option>
            <option <?=$order=='car.price asc'?'selected':''; ?> value="car.price asc">Əvvəlcə ucuz</option>
            <option <?=$order=='car.price desc'?'selected':''; ?> value="car.price desc">Əvvəlvə bahalı</option>
            <option <?=$order=='car.year desc'?'selected':''; ?> value="car.year desc">Buraxılış ili</option>
          </select>
        </div>
    </div>
    <section class="filter d-none">
        <div class="container d-flex">
            <div class="cities select col-md-3">
                <select name="">
                    <option value="AllCities">Bütün Şəhərlər</option>
                </select>
            </div>
            <div class="categories select col-md-3">
                <select name="">
                    <option value="Category">Kateqoriya</option>
                </select>
            </div>
            <div class="brends select col-md-3">
                <select name="">
                    <option value="Brend">Marka</option>
                </select>
            </div>
            <div class="statuses select col-md-3">
                <select name="">
                    <option value="">Vəziyyət</option>
                    <option value="Əla">Əla</option>
                    <option value="Yaxşı">Yaxşı</option>
                    <option value="Orta">Orta</option>
                    <option value="Kafi">Kafi</option>
                </select>
            </div>
        </div>
    </section>
    <?php if($premium_list): ?>
    <section class="premium_ads super-eds-container sec ">
        <div class="container">
            <div class="super-eds">
              <a href="/pages/rent_top?top=1&<?=$_SERVER['QUERY_STRING']; ?>">
                <div class="super-ed-text">
                    <p>
                        <b style="border-bottom: 3px solid #e53238; padding-bottom: 3px;">VIP Elanlar</b>
                        <span class="top_link">Hamısına bax<i class="fa fa-external-link" aria-hidden="true"></i></span>
                    </p>
                </div>
              </a>
                <div class="containers">
                    <div class="super-ed-container pb-0" style="width: 100%;">
                      <?php foreach ($premium_list as $row):
                            $url = get_url2(array('title' => $row->title, 'eid' => $row->id)); ?>
                        <div class="super-ed post">
                            <a href="/pages/rent_product/<?=$url; ?>" class="super-ed-image">
                                <img src="/assets/img/rent_car_photos/90x90/<?php $arr = $row->image?explode('.', $row->image):[]; echo $row->image?($webp?$arr[0].'.webp':$row->image):'nophoto.png'; ?>" alt="">
                            </a>
                            <div class="details">
                                <a href="/pages/rent_product/<?=$url; ?>">
                                    <p class="car_titles">
                                        <span class="car_title_first"><?=$row->title; ?></span>
                                        <span class="car_title_second"><?=$row->year; ?></span>
                                    </p>
                                    <p class="car_price">
                                        <?php echo $row->price;
                                                  switch ($row->currency) {
                                                    case '0':
                                                      echo " AZN";
                                                      break;
                                                    case '1':
                                                      echo " USD";
                                                      break;
                                                    case '2':
                                                      echo " EUR";
                                                      break;
                                                    default:
                                                      echo " AZN";
                                                }
                                          ?>
                                    </p>
                                    <p class="d-flex" style="position: relative; padding-right: 28px; height: 18px;">
                                        <span class="addDate"><?=$row->city_name; ?>, <?=date('d-m-Y, H:m', strtotime($row->createdate)); ?></span>
                                        <span class="ml-auto">
                                            <?=$row->vip?'<img src="/assets/img/car_photos/icons/new_kubok.png">':''; ?>
                                            <?=$row->premium?'<img src="/assets/img/car_photos/icons/new_fire.ico">':''; ?>
                                        </span>
                                    </p>
                                </a>
                                <br>
                                <?//=$row->autosalon?'<img class="salon_ico" src="/assets/img/car_photos/icons/salon.svg">':''; ?>
                                <p class="like p_block_like <?=$row->favorit?'active':''; ?>"  title="<?=$row->favorit?'Seçilmişlərdən sil':'Seçilmişlərə əlavə et' ?>" name="<?=$row->id; ?>">
                                    <img src="<?=$row->favorit?'/Images/heart-red-full.svg':'/Images/heart-red.svg'; ?>" alt="">
                                </p>
                            </div>
                        </div>
                      <?php endforeach; ?>
                    </div>
                    <div class="super-eds-adv-container" style="position: absolute; right: 0px;">
                        <!-- <div class="super-eds-adv" style="max-height: 60rem">
                            <a href="http://haval.az/" target="_blank"><img src="/assets/img/banners/haval_banner2.<?=($webp)?'webp':'jpeg'; ?>"></a>
                        </div> -->
                        <!-- <div class="super-eds-adv" style="max-height: 60rem">
                          <a href="http://haval.az/" target="_blank"><img src="/assets/img/banners/haval_banner1.<?=($webp)?'webp':'jpeg'; ?>"></a>
                        </div> -->
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php endif; ?>
    <?php if($vip_list): ?>
    <section class="premium_ads super-eds-container mt-20">
        <div class="container">
            <div class="super-eds">
              <a href="/pages/rent_top?top=0&<?=$_SERVER['QUERY_STRING']; ?>">
                <div class="super-ed-text">
                    <p>
                        <b style="border-bottom: 3px solid #e53238; padding-bottom: 3px;">Top Elanlar</b>
                        <span class="top_link for_top_link">Hamısına bax<i class="fa fa-external-link" aria-hidden="true"></i></span>
                    </p>
                </div>
              </a>
                <div class="containers">
                    <div class="super-ed-container" style="width: 100%;">
                      <?php foreach ($vip_list as $row):
                            $url = get_url2(array('title' => $row->title, 'eid' => $row->id)); ?>
                        <div class="super-ed post">
                            <a href="/pages/rent_product/<?=$url; ?>" class="super-ed-image">
                                <img src="/assets/img/rent_car_photos/90x90/<?php $arr = $row->image?explode('.', $row->image):[]; echo $row->image?($webp?$arr[0].'.webp':$row->image):'nophoto.png'; ?>" alt="">
                            </a>
                            <div class="details">
                                <a href="/pages/rent_product/<?=$url; ?>">
                                    <p class="car_titles">
                                        <span class="car_title_first"><?=$row->title; ?></span>
                                        <span class="car_title_second"><?=$row->year; ?></span>
                                    </p>
                                    <p class="car_price">
                                        <?php echo $row->price;
                                                  switch ($row->currency) {
                                                    case '0':
                                                      echo " AZN";
                                                      break;
                                                    case '1':
                                                      echo " USD";
                                                      break;
                                                    case '2':
                                                      echo " EUR";
                                                      break;
                                                    default:
                                                      echo " AZN";
                                                }
                                          ?>
                                    </p>
                                    <p class="d-flex" style="position: relative; padding-right: 28px; height: 18px;">
                                        <span class="addDate"><?=$row->city_name; ?>, <?=date('d-m-Y, H:m', strtotime($row->createdate)); ?></span>
                                        <span class="ml-auto">
                                            <?=$row->vip?'<img src="/assets/img/car_photos/icons/new_kubok.png">':''; ?>
                                            <?=$row->premium?'<img src="/assets/img/car_photos/icons/new_fire.ico">':''; ?>
                                        </span>
                                    </p>
                                </a>
                                <br>
                                <?//=$row->autosalon?'<img class="salon_ico" src="/assets/img/car_photos/icons/salon.svg">':''; ?>
                                <p class="like p_block_like <?=$row->favorit?'active':''; ?>"  title="<?=$row->favorit?'Seçilmişlərdən sil':'Seçilmişlərə əlavə et' ?>" name="<?=$row->id; ?>">
                                    <img src="<?=$row->favorit?'/Images/heart-red-full.svg':'/Images/heart-red.svg'; ?>" alt="">
                                </p>
                            </div>
                        </div>
                      <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php endif; ?>
    <section class="ad-middle">
        <div class="container">
            <div class="col-md-10 mx-auto" style="background-image: url(/Images/reklam.svg);"></div>
        </div>
    </section>
    <?php if($simple_list): ?>
    <section class="premium_ads latest-ads-container">
        <div class="container">
            <div class="super-eds">
                <div class="super-ed-text">
                    <p><b style="border-bottom: 3px solid #e53238; padding-bottom: 3px;">Rent a car</b></p>
                    <select class="ad_order form-control" name="ad_order">
                      <option <?=$order=='createdate'?'selected':''; ?> value="createdate">Tarixə görə</option>
                      <option <?=$order=='car.price asc'?'selected':''; ?> value="car.price asc">Əvvəlcə ucuz</option>
                      <option <?=$order=='car.price desc'?'selected':''; ?> value="car.price desc">Əvvəlvə bahalı</option>
                      <option <?=$order=='car.year desc'?'selected':''; ?> value="car.year desc">Buraxılış ili</option>
                    </select>
                </div>
                <div class="containers">
                      <div class="super-ed-container" style="width: 100%;">
                        <?=$simple_list; ?>
                        </div>
                        <div class="super-eds-adv-container">
                            <!-- <div class="super-eds-adv" style="max-height:60rem">
                                <a href="#"><img src="/assets/img/banners/haval_banner1.<?=($webp)?'webp':'jpeg'; ?>"></a>
                            </div> -->
                            <!-- <div class="super-eds-adv mt">
                              <a href="#"><img src="/assets/img/banners/haval_banner2.<?=($webp)?'webp':'jpeg'; ?>"></a>
                            </div> -->
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <div class="for_pagination_loader">
          <div class="lds-spinner for_pagination" style="left: 0px; top: -8px; ">
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            <div></div>
          </div>
        </div>
    <?php endif;?>
</main>

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

<div class="all_models_window2">
  <div class="marks_mini_head">
    <button type="button" class="model_back2 btn btn-default">
      <i class="fa fa-chevron-left" aria-hidden="true"></i>
      Geri
    </button>
    <span class="mark_head_title">Modellər</span>
  </div>
  <div class="mark_search_div">
    <i class="fa fa-search" aria-hidden="true"></i>
    <input type="text" class="model_search2 form-control" placeholder="Axtar...">
  </div>
  <div class="model_row2">
  </div>
</div>

<div class="all_years_window">
  <div class="marks_mini_head">
    <button type="button" class="years_back btn btn-default">
      <i class="fa fa-chevron-left" aria-hidden="true"></i>
      Geri
    </button>
    <span class="mark_head_title">İllər</span>
  </div>
  <div class="mark_search_div">
    <i class="fa fa-search" aria-hidden="true"></i>
    <input type="text" class="years_search form-control" placeholder="Axtar...">
  </div>
  <div class="years_row">
  </div>
</div>

<input type="hidden" name="simple_count" value="<?=$simple_list_count->count; ?>">
<input type="hidden" name="rec_pass" value="<?=$rec_pass; ?>">

<script type="text/javascript">


    /*----- CAROUSEL -----*/

    <?php if(!$search): ?>

      // $(document).ready(function(){
      //   $(".owl-carousel").owlCarousel({
      //     loop: true,
      //     items: 1
      //   });
      // });

    <?php endif; ?>



</script>

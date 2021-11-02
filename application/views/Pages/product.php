<?php
  function get_url($row)
  {
    $stitle = stripslashes($row['title']);

    if(preg_match( '/[\p{Cyrillic}]/u', $stitle))
    {
        $cyr = array('а','б','в','г','д','е','ё','ж','з','и','й','к','л','м','н','о','п','р','с','т','у',
            'ф','х','ц','ч','ш','щ','ъ', 'ы','ь', 'э', 'ю','я',
            'А','Б','В','Г','Д','Е','Ё','Ж','З','И','Й','К','Л','М','Н','О','П','Р','С','Т','У',
            'Ф','Х','Ц','Ч','Ш','Щ','Ъ', 'Ы','Ь', 'Э', 'Ю','Я' );
        $lat = array( 'a','b','v','g','d','e','e','zh','z','i','y','k','l','m','n','o','p','r','s','t','u',
            'f' ,'h' ,'ts' ,'ch','sh' ,'sht' ,'i', 'y', 'y', 'e' ,'yu' ,'ya','A','B','V','G','D','E','E','Zh',
            'Z','I','Y','K','L','M','N','O','P','R','S','T','U',
            'F' ,'H' ,'Ts' ,'Ch','Sh' ,'Sht' ,'I' ,'Y' ,'Y', 'E', 'Yu' ,'Ya' );

        $stitle = str_replace($cyr, $lat, $stitle);
    }

    $stitle=htmlspecialchars($stitle);
    $stitle=strtolower($stitle);
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

<input type="hidden" name="id" value="<?=$car->id; ?>">
<input type="hidden" name="<?=$this->security->get_csrf_token_name(); ?>" value="<?=$this->security->get_csrf_hash(); ?>">

<div class="my_container">
  <?php if($car->autosalon): ?>
    <div class="p_autosalon_header_block">
      <img class="logo" src="/assets/img/car_photos/logo/<?=$showroom->logo?$showroom->logo:'nophoto.png'; ?>">
      <div class="p_showroom_data_block">
        <span class="p_showroom_title"><?=$showroom->shirketad; ?></span>
        <div class="p_showroom_line"></div>
        <span class="showroom_mob_des"><?=$showroom->etraflimelumat; ?></span>
        <table class="comp_showroom">
          <tr>
            <td width="55%" class="p_showroom_description"><?=$showroom->etraflimelumat; ?></td>
            <td width="45%" style="padding: 5px 0px">
              <div class="p_showroom_phone">
                <i class="fa fa-phone" aria-hidden="true"></i>
                <div class="p_showroom_row">
                  <?php if($show_phone): ?>
                    <div class="row">
                      <div class="col-md-6">
                        <span class="p_showroom_phone_number"><a href="tel:<?=$showroom->mobile; ?>"><?=$showroom->mobile; ?></a></span>
                      </div>
                      <div class="col-md-6">
                        <span class="p_showroom_phone_number"><a href="tel:<?=$showroom->mobile2; ?>"><?=$showroom->mobile2; ?></a></span>
                      </div>
                      <div class="col-md-6">
                        <span class="p_showroom_phone_number"><a href="tel:<?=$showroom->mobile3; ?>"><?=$showroom->mobile3; ?></a></span>
                      </div>
                    </div>
                  <?php else: ?>
                    <span class="p_showroom_phone_number" style="color: #fafafa;">Gizli</span>
                  <?php endif; ?>
                </div>
              </div>
            </td>
          </tr>
          <tr>
            <td width="55%" class="p_showroom_location">
              <i class="fa fa-map-marker" aria-hidden="true"></i>
              <?=$showroom->address; ?>
            </td>
            <td width="45%" class="p_showroom_work_day">
              <i class="fa fa-clock-o" aria-hidden="true"></i>
              <?=$showroom->ishgunleri; ?>
            </td>
          </tr>
        </table>
      </div>
    </div>
  <?php endif; ?>
  <div class="<?=$car->autosalon?'p_autosalon_main_content':'p_main_content'?>">
    <div class="p_photo">
      <div
        class="fotorama"
        data-nav="thumbs"
        data-allowfullscreen="true"
        data-arrows="true"
        data-click="false"
        data-loop="true"
        data-width="100%"
        data-min-width="200"
      >
        <?php foreach ($images as $row): ?>
          <a href="/assets/img/car_photos/800xauto/<?php $arr = $row->name?explode('.', $row->name):[]; echo $row->name?($webp?$arr[0].'.webp':$row->name):'nophoto.png'; ?>">
            <img src="/assets/img/car_photos/90x90/<?php $arr = $row->name?explode('.', $row->name):[]; echo $row->name?($webp?$arr[0].'.webp':$row->name):'nophoto.png'; ?>">
          </a>
        <?php endforeach; ?>
      </div>
    </div>
    <div class="p_right_side">
      <div class="p_date_and_show">
        <span class="p_date" title="Tarix">Tarix: <?=date('d.m.Y', strtotime($car->createdate)); ?></span>
        <span class="p_show" title="Baxış sayı">
          <i class="fa fa-eye" aria-hidden="true"></i>
          <?=$car->counter; ?>
        </span>
      </div>
      <div class="p_date_and_show">
        <span class="p_date">Elanın kodu: <?=$car->id; ?></span>
      </div>
      <span class="p_title">
        <span class="p_title_first"><?=$car->title; ?></span>
        <span class="p_title_second"><?=$car->year." | ".$car->engine." | ".$car->mileage." km"; ?></span>
      </span>
      <span class="p_price">
        <?php if(!$car->agreement){
            echo trim(strrev(chunk_split(strrev($car->price),3, ' ')));
            if($car->currency == 0) echo ' ₼'; else if($car->currency == 1) echo ' $'; else if($car->currency == 2) echo ' €';
          } else {
            echo 'Razılaşma yolu ilə';
          } ?>
      </span>
      <?php if(!$car->autosalon): ?>
        <span class="p_author">
          <i class="fa fa-phone" aria-hidden="true"></i>
          <?=$car->first_name.": " ?>
          <a href="tel:<?=$car->mobile; ?>"><?=$car->mobile; ?></a>
        </span>
      <?php endif; ?>
      <span class="p_description mobile_none"><?=$car->additionalinfo; ?></span>
      <span class="tez_sat">Tez sat:</span>
      <div class="p_top_buttons">
        <button type="button" class="btn btn-primary" id="p_do_top" title="Top et">
          <img src="/assets/img/car_photos/icons/new_kubok2.ico">
          Top
          <span class="mini_text">1 AZN-dən</span>
        </button>
        <button type="button" class="btn btn-danger" style="margin-left: 5px;" id="p_do_top_plus" title="Vip et">
          <img src="/assets/img/car_photos/icons/new_fire2.ico">
          VIP
          <span class="mini_text">2 AZN-dən</span>
        </button>
      </div>
    </div>
    <?php if($car->on_auction): ?>
      <div class="p_bottom_side">
        <span class="auction_title">Hərrac</span>
        <div style="position: relative; float: left; width: 100%;">
          <div class="clock" style="margin:2em;"></div>
        </div>
        <div class="auction_div">
          Hərrac qiyməti:
          <span class="auction_price">
            <?=trim(strrev(chunk_split(strrev(($car->price)*(100 - $car->discount)/100),3, ' ')));
              if($car->currency == 0) echo ' ₼'; else if($car->currency == 1) echo ' $'; else if($car->currency == 2) echo ' €';
            ?>
          </span>
        </div>
        <div class="auction_div">
          Son təklif olunan qiymət:
          <span class="auction_price">
            <?=$auction_offers?trim(strrev(chunk_split(strrev($auction_offers[0]->offer_price),3, ' '))):0;
              if($car->currency == 0) echo ' ₼'; else if($car->currency == 1) echo ' $'; else if($car->currency == 2) echo ' €';
            ?>
          </span>
        </div>
        <div class="auction_note">
          <i class="fa fa-circle" aria-hidden="true"></i>
          Hərrac başa çatmamış və ya çatdıqdan sonra  satış qərarını satıcı verir
        </div>

        <div class="<?=$car->autosalon?'auction_table_div_autosalon':'auction_table_div_simple'; ?>">
          <table class="auction_table">
            <tr>
              <th style="width: 20%">Adı</th>
              <th style="width: 20%">Əlaqə</th>
              <th style="width: 20%">Məbləğ</th>
              <th style="width: 30%">Tarix</th>
              <th style="width: 10%">Status</th>
            </tr>
              <?php $selled = 0;
              if (isset($auction_offers) && $auction_offers):
                $i = 1;
                foreach($auction_offers as $row):
                  if ($row->selled) $selled = 1; ?>
                <tr>
                  <td class="td_style"><?=$row->user_name; ?></td>
                  <td><?=$row->phone; ?></td>
                  <td>
                    <?=$row->offer_price?trim(strrev(chunk_split(strrev($row->offer_price), 3, ' '))):0;
                    if($car->currency == 0) echo ' ₼'; else if($car->currency == 1) echo ' $'; else if($car->currency == 2) echo ' €'; ?>
                  </td>
                  <td><?=date('d-m-Y H:i', strtotime($row->offer_date)); ?></td>
                  <td>
                    <?php if($car->authorid == $this->session->userdata('uid')){ ?>
                      <?php if ($i == 1){
                        if ($row->selled) { ?>
                          <span style="color: #12bf5a; font-weight: 600">Satıldı</span>
                        <? } else { ?>
                          <button type="button" class="btn btn-success auction_sell" data="<?=$row->id; ?>">
                            <i class="fa fa-shopping-basket" aria-hidden="true"></i>
                            Sat
                          </button>
                        <? }
                       } else
                        echo "---";
                    } else {
                      echo $row->selled?'<span style="color: #12bf5a; font-weight: 600">Satıldı</span>':'---';
                    } ?>
                  </td>
                </tr>
                <?php $i++;
                endforeach;
              endif; ?>
          </table>
        </div>
        <?php if($selled == 0 && $car->authorid != $this->session->userdata('uid')): ?>
          <div class="auction_button">
            <button type="button" class="btn btn-danger <?=$this->session->userdata('uid')?'':'not_authorized'; ?>" id="open_offer_form">
              <i class="fa fa-plus" aria-hidden="true"></i>
              Yeni təklif ver
            </button>
          </div>
        <?php endif; ?>
        <input type="hidden" name="elapsed_date" value="<?=($car->period*24*60*60 + strtotime($car->create_date) - strtotime(date('Y-m-d H:i:s'))); ?>">
      </div>
    <?php endif; ?>
    <div class="p_bottom_side">
      <div class="<?=$car->autosalon?'p_bottom_left_side2':'p_bottom_left_side'; ?>">
        <table>
          <tr>
            <td>Şəhər</td>
            <td><?=$car->city; ?></td>
          </tr>
          <tr>
            <td>Marka</td>
            <td><?=$car->mark; ?></td>
          </tr>
          <tr>
            <td>Model</td>
            <td><?=$car->model; ?></td>
          </tr>
          <tr>
            <td>Buraxılış ili</td>
            <td><?=$car->year; ?></td>
          </tr>
          <tr>
            <td>Ban növü</td>
            <td><?=$car->body; ?></td>
          </tr>
          <tr>
            <td>Rəng</td>
            <td><?=$car->color; ?></td>
          </tr>
          <tr>
            <td>Salonun rəngi</td>
            <td><?=$car->interiorcolor; ?></td>
          </tr>
          <tr>
            <td>Mühərrik</td>
            <td><?=$car->engine; ?> l</td>
          </tr>
          <tr>
            <td>Mühərrikin gücü</td>
            <td><?=$car->horsepower; ?> a.g.</td>
          </tr>
          <tr>
            <td>Yanacaq növü</td>
            <td>
              <?php foreach($fuel as $row):
                if($car->fuel == $row)
                  echo $row;
               endforeach; ?>
            </td>
          </tr>
          <tr>
            <td>Yürüş</td>
            <td><?=trim(strrev(chunk_split(strrev($car->mileage),3, ' '))); ?> km</td>
          </tr>
          <tr>
            <td>Sürətlər qutusu</td>
            <td>
              <?php foreach($transmission as $row):
                if($car->transmission == $row)
                  echo $row;
               endforeach; ?>
            </td>
          </tr>
          <tr>
            <td>Ötürücü</td>
            <td>
              <?php foreach($drive as $row):
                if($car->drive == $row)
                  echo $row;
               endforeach; ?>
            </td>
          </tr>
        </table>
      </div>
      <div class="<?=$car->autosalon?'p_bottom_right_side2':'p_bottom_right_side'; ?>">
        <table>
          <?php
            foreach($array as $row)
            {
              if($row['for_if'])
                echo '<tr><td>
                        <div class="p_round">
                          <i class="fa fa-chevron-right" aria-hidden="true"></i>
                        </div>
                        '.$row['for_echo'].'
                      </td></tr>';
            }
          ?>
        </table>
        <?php if($car->credit || $car->barter): ?>
          <table class="p_table">
            <?php
              $array2 = array(['for_if' => $car->credit, 'for_echo' => 'Kredit'], ['for_if' => $car->barter, 'for_echo' => 'Barter']);
              foreach($array2 as $row)
              {
                if($row['for_if'])
                  echo '<tr><td class="p_bold">
                          <div class="p_round">
                            <i class="fa fa-chevron-right" aria-hidden="true"></i>
                          </div>
                          '.$row['for_echo'].'
                        </td></tr>';
              }
            ?>
          </table>
        <?php endif; ?>
        <span class="p_description mobile_open" style="margin-top: 10px;"><?=$car->additionalinfo; ?></span>
        <?php if(!$car->autosalon): ?>
          <div class="p_action_icons_not_autosalon">
            <button type="button" class="btn btn-default add_favorit <?=$car->favorit?'active':''; ?>">
              <i style="<?=$car->favorit?'color: #9f2d2d':''; ?>" class="fa fa-heart<?=$car->favorit?'':'-o'; ?>" aria-hidden="true"></i>
              <?=$car->favorit?'Seçilmişlərdən sil':'Seçilmişlərə əlavə et'; ?>
            </button>
            <button type="button" class="btn btn-default p_edit_car">
              <i class="fa fa-pencil" aria-hidden="true"></i>
              Redaktə et
            </button>
            <?php if(!$car->on_auction): ?>
              <button type="button" class="btn btn-default p_do_auction">
                <i class="fa fa-gavel" aria-hidden="true"></i>
                Hərraca çıxart
              </button>
            <?php endif; ?>
            <button type="button" class="btn btn-default p_delete_car">
              <i class="fa fa-trash-o" aria-hidden="true"></i>
              Elanı sil
            </button>
            <button type="button" class="btn btn-default p_complain_car">
              <i class="fa fa-exclamation" aria-hidden="true"></i>
              Şikayət et!
            </button>
          </div>
        <?php endif; ?>
      </div>
      <?php if($car->autosalon): ?>
        <div class="p_showroom_bottom">
          <span class="p_showroom_bottom_title"><?=$showroom->shirketad; ?></span>
          <div class="p_showroom_bottom_phone">
            <i aria-hidden="true" class="fa fa-phone"></i>
            <div class="p_showroom_bottom_phone_number">
              <?php if ($show_phone): ?>
                <a href="tel:<?=$showroom->mobile; ?>"><span><?=$showroom->mobile; ?></span></a>
                <a href="tel:<?=$showroom->mobile2; ?>"><span><?=$showroom->mobile2; ?></span></a>
                <a href="tel:<?=$showroom->mobile3; ?>"><span><?=$showroom->mobile3; ?></span></a>
              <?php else: ?>
                <span>Gizli</span>
              <?php endif; ?>
            </div>
          </div>
          <div class="p_showroom_bottom_side_line"></div>
          <span class="p_showroom_bottom_location">
            <i aria-hidden="true" class="fa fa-map-marker"></i>
            <?=$showroom->address; ?>
          </span>
          <div class="p_showroom_bottom_side_line"></div>
          <a href="/car_showroom/car_showroom/<?=$showroom->id; ?>" target="_blank" class="p_showroom_bottom_all">
            <i aria-hidden="true" class="fa fa-car"></i>
            Salonun bütün elanları
          </a>
        </div>
        <div class="p_action_icons">
          <button type="button" class="btn btn-default add_favorit <?=$car->favorit?'active':''; ?>">
            <i style="<?=$car->favorit?'color: #9f2d2d':''; ?>" class="fa fa-heart<?=$car->favorit?'':'-o'; ?>" aria-hidden="true"></i>
            <?=$car->favorit?'Seçilmişlərdən sil':'Seçilmişlərə əlavə et'; ?>
          </button>
          <button type="button" class="btn btn-default p_edit_car">
            <i class="fa fa-pencil" aria-hidden="true"></i>
            Redaktə et
          </button>
          <?php if(!$car->on_auction): ?>
            <button type="button" class="btn btn-default p_do_auction">
              <i class="fa fa-gavel" aria-hidden="true"></i>
              Hərraca çıxart
            </button>
          <?php endif; ?>
          <button type="button" class="btn btn-default p_delete_car">
            <i class="fa fa-trash-o" aria-hidden="true"></i>
            Elanı sil
          </button>
          <button type="button" class="btn btn-default p_complain_car">
            <i class="fa fa-exclamation" aria-hidden="true"></i>
            Şikayət et!
          </button>
        </div>
      <?php endif; ?>
      <a href="tel:<?=@$car->mobile; ?>" class="<?=$car->autosalon?'open_call_curtain':''; ?> mobile_call_jquery mobile_call">
        <button type="button" class="btn btn-danger mobile_call_button">
          <i class="fa fa-phone" aria-hidden="true"></i>
          Zəng et
        </button>
      </a>
    </div>
  </div>
  <?php if(!$car->autosalon): ?>
    <!-- <div class="p_ad_block">
        <img src="/assets/img/banners/haval_banner2.<?=($webp)?'webp':'jpeg'; ?>">
    </div> -->
  <?php endif; ?>
  <div class="p_line"></div>
  <?php if($similar || @$similar2): ?>
    <div class="p_row">
      <span class="p_title2">Oxşar elanlar</span>
      <?php if($show_more): ?>
        <a href="<?=$car->autosalon?'/car_showroom/car_showroom/'.$showroom->id:'/pages/index?mark='.$car->mark_id.'&model='.$car->model_id; ?>" class="p_all">
          Daha çoxunu göstər
          <i class="fa fa-external-link" aria-hidden="true"></i>
        </a>
      <?php endif; ?>
      <div class="p_similar">
        <?php foreach ($similar as $row):
            $url = get_url(array('title' => $row->title, 'eid' => $row->id)); ?>
            <div class="p_block">
                <a href="/pages/product/<?=$url; ?>" target="_blank" class="p_img">
                    <img src="/assets/img/car_photos/90x90/<?php $arr = $row->image?explode('.', $row->image):[]; echo $row->image?($webp?$arr[0].'.webp':$row->image):'nophoto.png'; ?>" alt="">
                    <?php if($row->on_auction): ?>
                      <div class="auction_ico_div">
                        <img src="/assets/img/car_photos/icons/auction.png">
                      </div>
                    <?php endif; ?>
                </a>
                <div class="p_details">
                    <a href="/pages/product/<?=$url; ?>" target="_blank">
                        <span class="p_block_title p_block_row">
                          <span><?=$row->title; ?></span>
                          <span><?=$row->year." | ".$row->engine." | ".$row->mileage." km"; ?></span>
                        </span>
                        <span class="p_block_row p_block_price">
                          <?php if($row->agreement)
                                  echo 'Razılaşma yolu ilə';
                                else {
                                  echo $row->price;
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
                          }?>
                        </span>
                        <span class="p_block_row">
                            <span class="p_block_date"><?=$row->city; ?>, <?=date('d-m-Y, H:m', strtotime($row->createdate)); ?></span>
                            <div class="p_vip_premium">
                              <?=$row->vip?'<img title="Top" class="p_vip" src="/assets/img/car_photos/icons/new_kubok.png">':''; ?>
                              <?=$row->premium?'<img title="Vip" class="p_premium" src="/assets/img/car_photos/icons/new_fire.ico">':''; ?>
                            </div>
                        </span>
                    </a>
                </div>
                <?//=$row->autosalon?'<img class="p_salon_ico" src="/assets/img/car_photos/icons/salon.svg">':''; ?>
                <span class="p_block_like <?=$row->favorit?'active':''; ?>" title="<?=$row->favorit?'Seçilmişlərdən sil':'Seçilmişlərə əlavə et' ?>" name="<?=$row->id; ?>">
                  <img src="<?=$row->favorit?'/Images/heart-red-full.svg':'/Images/heart-red.svg'; ?>" alt="">
                </span>
            </div>
          <?php endforeach; ?>
      </div>
    </div>
  <?php endif; ?>
</div>

<div class="p_curtain">
  <div class="p_for_map">
    <span class="p_map_close">
      <i class="fa fa-times" aria-hidden="true"></i>
    </span>
    <div id="map" class="map" style="height: 100%; width: 100%; border: 1px solid #DDD;"></div>
  </div>
</div>

<div class="p_pin_curtain">
  <div class="p_pin_block_edit">
    <form class="" action="/pages/edit_with_pin/<?=$car->id; ?>" method="post">
      <input type="hidden" name="<?=$this->security->get_csrf_token_name(); ?>" value="<?=$this->security->get_csrf_hash(); ?>">
      <input type="hidden" name="title" value="<?=get_url(array('title' => $car->title, 'eid' => $car->id)); ?>">
      <span>Elanın pin kodu</span>
      <input type="number" name="pincode" value="" placeholder="Pin kod...">
      <button type="button" class="p_edit_cancel">İmtina</button>
      <button type="submit" class="p_edit">Redaktə et</button>
    </form>
  </div>
</div>

<div class="p_pin_curtain2">
  <div class="p_pin_block_edit2">
    <form class="" action="/pages/delete_with_pin/<?=$car->id; ?>" method="post">
      <input type="hidden" name="<?=$this->security->get_csrf_token_name(); ?>" value="<?=$this->security->get_csrf_hash(); ?>">
      <input type="hidden" name="title" value="<?=get_url(array('title' => $car->title, 'eid' => $car->id)); ?>">
      <span>Elanın pin kodu</span>
      <input type="number" name="pincode" value="" placeholder="Pin kod...">
      <button type="button" class="p_edit_cancel2">İmtina</button>
      <button type="submit" class="p_edit2">Elanı sil</button>
    </form>
  </div>
</div>

<div class="p_pin_curtain3">
  <div class="p_pin_block_edit3">
    <form class="" action="/pages/complain/<?=$car->id; ?>" method="post">
      <input id="token" type="hidden" name="<?=$this->security->get_csrf_token_name(); ?>" value="<?=$this->security->get_csrf_hash(); ?>">
      <input type="hidden" name="title" value="<?=get_url(array('title' => $car->title, 'eid' => $car->id)); ?>">
      <span>Şikayətiniz</span>
      <textarea name="complain" placeholder="Şikayətiniz..."></textarea>
      <button type="button" class="p_edit_cancel3">İmtina</button>
      <button type="submit" class="p_edit3">Şikayət et</button>
    </form>
  </div>
</div>

<div class="p_pin_curtain4">
  <div class="p_pin_block_edit4">
    <form class="" action="/payment/do_top" method="post">
      <input type="hidden" name="<?=$this->security->get_csrf_token_name(); ?>" value="<?=$this->security->get_csrf_hash(); ?>">
      <input type="hidden" name="title" value="<?=get_url(array('title' => $car->title, 'eid' => $car->id)); ?>">
      <input type="hidden" name="carad_id" value="<?=$car->id; ?>">
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
    <form class="" action="/payment/do_top" method="post">
      <input type="hidden" name="<?=$this->security->get_csrf_token_name(); ?>" value="<?=$this->security->get_csrf_hash(); ?>">
      <input type="hidden" name="title" value="<?=get_url(array('title' => $car->title, 'eid' => $car->id)); ?>">
      <input type="hidden" name="carad_id" value="<?=$car->id; ?>">
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

<?php if($car->autosalon): ?>
  <div class="call_curtain">
    <div class="call_block">
      <span class="call_title">Telefon</span>
      <i class="fa fa-close call_close_button" aria-hidden="true"></i>
      <div class="call_numbers">
        <?php if($show_phone): ?>
          <?php if($showroom->mobile): ?>
            <a href="tel:<?=$showroom->mobile; ?>">
              <i class="fa fa-phone" aria-hidden="true"></i>
              <?=$showroom->mobile; ?>
            </a>
          <?php endif; ?>
          <?php if($showroom->mobile2): ?>
            <a href="tel:<?=$showroom->mobile2; ?>">
              <i class="fa fa-phone" aria-hidden="true"></i>
              <?=$showroom->mobile2; ?>
            </a>
          <?php endif; ?>
          <?php if($showroom->mobile3): ?>
            <a href="tel:<?=$showroom->mobile3; ?>">
              <i class="fa fa-phone" aria-hidden="true"></i>
              <?=$showroom->mobile3; ?>
            </a>
          <?php endif; ?>
        <?php else: ?>
          <span class="show_phone_false">
            <i class="fa fa-circle" aria-hidden="true"></i>
            Elanın sahibi nömrəni gizlətmişdir
          </span>
        <?php endif; ?>
      </div>
    </div>
  </div>
<?php endif; ?>

<div class="p_pin_curtain6">
  <div class="p_pin_block_edit6">
    <form class="" action="/pages/add_offer/<?=$car->auction_id; ?>" method="post">
      <input type="hidden" name="<?=$this->security->get_csrf_token_name(); ?>" value="<?=$this->security->get_csrf_hash(); ?>">
      <input type="hidden" name="carad_id" value="<?=$car->id; ?>">
      <span style="margin-bottom: 10px;">Yeni təklif</span>
      <?php if (!$this->session->userdata('uid')): ?>
        <input
          type="text"
          name="user_name"
          placeholder="Adınız..."
          required
          class="form-control alphabet session_save"
          style="margin: 5px 0px;"
          value="<?=@$this->session->userdata('s_user_name')?$this->session->userdata('s_user_name'):''; ?>"
        >
        <input
          type="text"
          name="phone"
          placeholder="Əlaqə..."
          required
          class="form-control phone_format only_numeric session_save user_phone"
          value="<?=@$this->session->userdata('s_phone')?$this->session->userdata('s_phone'):''; ?>"
        >
      <?php endif; ?>

      <span class="for_offer_radio_div">Təklif faizinı seçin:</span>
      <div class="offer_radio_div">
        <div>
          <input type="radio" id="offer_1" class="offer_1" name="offer_procent" value="1" checked>
          <label for="offer_1">1%</label>
        </div>
        <div>
          <input type="radio" id="offer_2" class="offer_2" name="offer_procent" value="2">
          <label for="offer_2">2%</label>
        </div>
        <div>
          <input type="radio" id="offer_3" class="offer_3" name="offer_procent" value="3">
          <label for="offer_3">3%</label>
        </div>
      </div>
      <span class="for_auction_calc_price">
        <div><?php if($car->currency == 0) echo '₼'; else if($car->currency == 1) echo '$'; else if($car->currency == 2) echo '€'; ?>&nbsp;</div>
        <div class="change"></div>
      </span>
      <input type="hidden" name="auction_id" value="<?=$car->auction_id; ?>">
      <input type="hidden" name="discount" value="<?=$car->discount; ?>">
      <button type="button" class="p_edit_cancel6">İmtina</button>
      <button type="submit" class="p_edit">Təklif et</button>
    </form>
  </div>
</div>

<div class="auction_curtain">
  <div class="auction_block_edit">
    <form class="" action="/pages/add_to_auction_with_pin" method="post">
      <input type="hidden" name="<?=$this->security->get_csrf_token_name(); ?>" value="<?=$this->security->get_csrf_hash(); ?>">
      <input type="hidden" name="carad_id" value="<?=$car->id; ?>">
      <input type="hidden" name="title" value="<?=get_url(array('title' => $car->title, 'eid' => $car->id)); ?>">
      <span class="p_top_title">Elanınız hərraca çıxarılacaq</span>
      <br>
      <span class="auction_content">Elanın pin kodu:</span>
      <input type="number" class="form-control" name="pin_code" required placeholder="Pin kod...">
      <span class="auction_content">Hərrac qiyməti:</span>
      <div class="p_top_radio">
        <select class="form-control" name="discount" required>
          <option value="">Faizi seçin:</option>
          <option value="10">10%</option>
          <option value="15">15%</option>
          <option value="20">20%</option>
        </select>
      </div>
      <br>
      <span class="auction_content">Hərrac müddəti:</span>
      <div class="p_top_radio">
        <select class="form-control" name="period" required>
          <option value="">Müddət seçin:</option>
          <option value="1">1 gün</option>
          <option value="3">3 gün</option>
          <option value="5">5 gün</option>
        </select>
      </div>
      <span class="auction_content">İştirakçı sayı:</span>
      <div class="p_top_radio">
        <select class="form-control" name="participants" required>
          <option value="">İştirakçı sayı:</option>
          <option value="5">5</option>
          <option value="10">10</option>
          <option value="0">Limitsiz</option>
        </select>
      </div>
      <span class="auction_content">Telefon nömrəni göstər:</span>
      <div class="p_top_radio">
        <select class="form-control" name="phone_show" required>
          <option value="">Seç:</option>
          <option value="1">Hə</option>
          <option value="2">Yox</option>
        </select>
      </div>
      <div class="how_br"></div>
      <div style="position: relative; float: left; width: 100%; height: 65px;">
        <button type="button" class="auction_cancel">İmtina</button>
        <button type="submit" class="p_edit3">Əlavə et</button>
      </div>
    </form>
  </div>
</div>

<input type="hidden" name="map_lat" value="<?=@$showroom->lat; ?>">
<input type="hidden" name="map_lng" value="<?=@$showroom->lng; ?>">
<input type="hidden" name="status" value="<?=$status; ?>">
<input type="hidden" name="code" value="<?=$code; ?>">

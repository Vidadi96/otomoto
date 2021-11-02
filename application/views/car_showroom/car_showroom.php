<?php
  function get_url($row)
  {
    $stitle = stripslashes($row['title']);

    if(preg_match( '/[\p{Cyrillic}]/u', $stitle))
    {
        $cyr  = array('а','б','в','г','д','е','ё','ж','з','и','й','к','л','м','н','о','п','р','с','т','у',
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

<div class="my_container">
  <?php if($showroom->avatar): ?>
    <img src="/assets/img/car_photos/avatar/<?=$showroom->avatar; ?>" class="avatar">
  <?php endif;?>
  <div class="p_autosalon_header_block">
    <img class="logo" src="/assets/img/car_photos/logo/<?=$showroom->logo?$showroom->logo:'nophoto.png'; ?>">
    <div class="p_showroom_data_block">
      <div class="p_new_head">
        <span class="p_showroom_title"><?=$showroom->shirketad; ?></span>
        <span class="p_show" title="Baxış sayı">
          <i class="fa fa-eye" aria-hidden="true"></i>
          <?=$showroom->counter; ?>
        </span>
      </div>
      <div class="p_showroom_line"></div>
      <table>
        <tr>
          <td width="55%" class="p_showroom_description"><?=$showroom->etraflimelumat; ?></td>
          <td width="45%" style="padding: 5px 0px">
            <div class="p_showroom_phone">
              <i class="fa fa-phone" aria-hidden="true"></i>
              <div class="p_showroom_row">
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
      <div class="p_head_mobile">
        <span class="p_mobile_desc p_mobile_padding"><?=$showroom->etraflimelumat; ?></span>
        <div class="p_show2 p_mobile_padding">
          <i class="fa fa-eye" aria-hidden="true"></i>
          <?=$showroom->counter; ?>
        </div>
        <div class="p_address2 p_mobile_map2 p_mobile_padding">
          <i class="fa fa-map-marker" aria-hidden="true"></i>
          <?=$showroom->address; ?>
        </div>
        <div class="p_address2 p_mobile_wd p_mobile_padding">
          <i class="fa fa-clock-o" aria-hidden="true"></i>
          <?=$showroom->ishgunleri; ?>
        </div>
        <div class="row p_mobile_padding p_adress1">
          <div class="col-md-4 col-sm-4 col-6">
            <span class="p_mobile_map">
              <i class="fa fa-map-marker" aria-hidden="true"></i>
              <?=$showroom->address; ?>
            </span>
          </div>
          <div class="col-md-4 col-sm-4 col-6">
            <span class="p_mobile_wd">
              <i class="fa fa-clock-o" aria-hidden="true"></i>
              <?=$showroom->ishgunleri; ?>
            </span>
          </div>
        </div>
      </div>
    </div>
  </div>

  <span class="p_mobile_desc2">
    <table>
      <tr>
        <td class="p_for_i"><i class="fa fa-file-text-o" aria-hidden="true"></i></td>
        <td class="p_for_text"><?=$showroom->etraflimelumat; ?></td>
      </tr>
    </table>
  </span>

  <div class="p_line"></div>
  <?php if($cars): ?>
    <div class="p_row">
      <div class="p_similar">
        <?php foreach ($cars as $row):
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

  <button type="button" class="mobile_call_jquery mobile_call btn btn-danger">
    <i class="fa fa-phone" aria-hidden="true"></i>
    Zəng et
  </button>
  <div class="button_zamena"></div>
</div>

<div class="p_curtain">
  <div class="p_for_map">
    <span class="p_map_close">
      <i class="fa fa-times" aria-hidden="true"></i>
    </span>
    <div id="map" class="map" style="height: 100%; width: 100%; border: 1px solid #DDD;"></div>
  </div>
</div>

<div class="call_curtain">
  <div class="call_block">
    <span class="call_title">Telefon</span>
    <i class="fa fa-close call_close_button" aria-hidden="true"></i>
    <div class="call_numbers">
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
    </div>
  </div>
</div>

<input type="hidden" name="map_lat" value="<?=@$showroom->lat; ?>">
<input type="hidden" name="map_lng" value="<?=@$showroom->lng; ?>">
<input type="hidden" name="id" value="<?=$showroom->id; ?>">
<input type="hidden" id="token" name="<?=$this->security->get_csrf_token_name(); ?>" value="<?=$this->security->get_csrf_hash(); ?>">

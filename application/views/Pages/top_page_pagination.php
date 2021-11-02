<?php
  function get_url3($row)
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

<?php foreach ($cars as $row):
    $url = get_url3(array('title' => $row->title, 'eid' => $row->id)); ?>
    <div class="p_block insert_after">
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
                      <?=($row->vip || $row->unlimited)?'<img title="Top" class="p_vip" src="/assets/img/car_photos/icons/new_kubok.png">':''; ?>
                      <?=($row->premium || $row->unlimited)?'<img title="Vip" class="p_premium" src="/assets/img/car_photos/icons/new_fire.ico">':''; ?>
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

<?php
include 'db.php';
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

        <div class="categories-container">
            <?=$cat_carusel; ?>
        </div>

        <div class="to-top">
            <p class="text-center">
                <i class="fas fa-angle-up"></i>
            </p>
        </div>

       <?//=$chat; ?>

        <div class="mobile-bottom">
            <div class="columns">
                <div class="column home">
                    <a href="/">
                        <div class="image">
                            <img src="/Images/home.svg" alt="">
                        </div>
                        <p class="text-center">Ana Səhifə</p>
                    </a>
                </div>
                <div class="column category">
                    <a href="">
                        <div class="image">
                            <img src="/Images/category.svg" alt="">
                        </div>
                        <p class="text-center">Kateqoriyalar</p>
                    </a>
                    <div class="category-modal modal">
                        <div class="category-modal-text">
                            <span>
                                <img src="/Images/previous.svg" alt="">
                            </span>
                            <span class="mx-auto">
                                <b>Kateqoriyalar</b>
                            </span>
                        </div>
                        <div class="categories">
                            <div class="container">
                                <div class="category-container draggable d-flex">
                                    <?php
                                    foreach($second as $row)
                                    {
                                      $i++;
                                      $class = ($i==1)?"active":'';

                                      echo '<div class="category '.$class.'" id="ca'.$i.'">
                                              <p>
                                                  <img src="/'.$row['img'].'">
                                                  <p class="name text-center">
                                                      <b>'.$row['ad'].'</b>
                                                  </p>
                                                  <p class="line"></p>
                                              </p>
                                            </div>';
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="subcategory-modal modal">
                        <div class="subcategory-modal-text">
                            <span>
                                <img src="/Images/previous.svg" alt="">
                            </span>
                            <span class="mx-auto">
                                <b>Kateqoriyalar</b>
                            </span>
                        </div>
                        <div class="categories">
                            <div class="container">
                                <div class="category-container draggable d-flex">
                                    <?php
                                    $i=0;
                                    foreach($first as $row)
                                    {
                                        $i++;
                                        echo'<div class="category" id="ca'.$i.'">
                                                <p>
                                                    <img src="/'.$row['img'].'">
                                                    <p class="name text-center">
                                                        <b>'.$row['ad'].'</b>
                                                    </p>
                                                    <p class="line"></p>
                                                </p>
                                             </div>';
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                        <?php
                        $i=0;
                        foreach($first as $row)
                        {
                            $i++;
                            $class = ($row['id']==97 or $row['id']==55)?'line2':'';

                            echo '<div class="subcategories ca'.$i.'">';

                            if ($row['id']!=97 && $row['id']!=98)
                            {
                              echo '<nav>
                                      <ul>
                                        <li>
                                            <a href="/pages/products?cat='.$row['id'].'#result">Bütün elanlar</a>
                                        <li>';

                              $info1 = $this->universal_model->get_more_item('elancats', 'active=1 AND maincat='.$row['id'].' AND altcat=0', 1, false);

                              foreach($info1 as $raw)
                              {
                                  echo '<li>
                                          <a href="/pages/products?subcat='.$raw['id'].'#result">'.$raw['ad'].'</a>
                                        </li>';
                              }

                              echo '</ul>
                                  </nav>';
                            }

                            echo '</div>';
                        }
                        ?>
                    </div>
                </div>
                <div class="column addAd">
                    <a href="/addad.php">
                        <div class="image">
                            <img src="/Images/add-plus.svg" alt="">
                        </div>
                        <p class="text-center">Elan Yerləşdir</p>
                    </a>
                </div>
                <div class="column feel-lucky">
                    <a href="/pages/feellucky">
                        <div class="image">
                            <img src="/Images/feel-lucky.svg" alt="">
                        </div>
                        <p class="text-center"><a href="/pages/feellucky?ferq=1">Feel Lucky</a></p>
                    </a>
                </div>
                <div class="column bartyChat">
                    <a <?php if(!isset($_SESSION['uid'])){echo'class="nr"';} ?> href="/pages/bartychat">
                        <div class="image">
                            <img src="/Images/chat.svg" alt="">
                        </div>
                        <p class="text-center">BartiChat</p>
                    </a>
                </div>
            </div>
        </div>
    </header>
    <main>
        <div class="container">
            <p class="main-text">
                <a href="index" class="gray">Elanlar</a>
                <img src="/Images/arrow-right.svg" alt="">
                <?php
                  if (isset($catad))
                    echo'<a href="http://new.otomoto.az/pages/products?cat='.$cat.'#result" class="gray">'.$catad.'</a> ';

                  if (isset($subad))
                    echo'<img src="/Images/arrow-right.svg" alt="">
                     <a href="http://new.otomoto.az/pages/products?subcat='.$subcat.'#result" class="black">'.$subad.'</a>';
                ?>
            </p>

            <section class="products-container">

                <div class="col-md-3 side-filter">
                    <p class="filters-text">
                        <span>
                            <i class="fas fa-times"></i>
                        </span>
                        <span class="mx-auto">
                            <b>Filterlər</b>
                        </span>
                    </p>
                    <form action="?product&<?php if(isset($cat)){echo 'cat='.$cat;} if(isset($subcat)){echo'subcat='.$subcat;} ?>" method="post">
                      <input type="hidden" name="<?=$this->security->get_csrf_token_name(); ?>" value="<?=$this->security->get_csrf_hash(); ?>">
                    <nav>
                        <ul>
                            <?php
                             if(isset($cat) || isset($subcat))
                             {
                            ?>
                            <li class="categories li active">
                                <a href="" class="title">
                                    <span>
                                        <b><?=$catad ?></b>
                                    </span>
                                    <span class="ml-auto">
                                        <i class="fas fa-angle-down"></i>
                                    </span>
                                </a>
                                <nav class="dropdown">
                                    <ul>
                                        <?php
                                          foreach($ninfo as $row)
                                          {
                                              $style = (isset($subcat) && $subcat==$row['id'])?'style="font-weight:bolder;"':"";
                                              echo '<li>
                                                      <a href="?subcat='.$row['id'].'"'.$style.'>'.$row['ad'].'</a>
                                                    </li>';
                                          }
                                        ?>
                                    </ul>
                                </nav>
                            </li>

                          <?php
                            }

                            if(isset($subcat))
                            {
                              if($asay1)
                              {
                            ?>
                            <li class="li active">
                                <a href="" class="title">
                                    <span>
                                        <b>Ətraflı</b>
                                    </span>
                                    <span class="ml-auto">
                                        <i class="fas fa-angle-down"></i>
                                    </span>
                                </a>
                                <nav class="dropdown">
                                    <ul>
                                      <?php
                                        $i=0;
                                        foreach($ainfo1 as $row)
                                        {
                                            $i++;
                                            if($i < 8)
                                            {
                                                for($subarr=0; $subarr < $asay1; $subarr++)
                                                {
                                                  if($subsubcat[$subarr] == $row['id'])
                                                  {
                                                    $cityclass = 'class="selected"';
                                                    break;
                                                  }
                                                  else
                                                    $cityclass = "";
                                                }

                                                echo '<li class="checkbox">
                                                        <a '.$cityclass.' href="#">'.$row['ad'].'</a>
                                                        <input type="checkbox" name="subsubcat[]" hidden value="'.$row['id'].'">
                                                      </li>';
                                            }
                                        }

                                        if($asay1 > 8)
                                        {
                                        ?>

                                        <li>
                                            <a href="" class="show-more">
                                                <b>Hamsını Göstər</b>
                                                <i class="fas fa-sort-down"></i>
                                            </a>
                                            <nav class="drop-dropdown">
                                                <ul>
                                                    <?php
                                                      $i=0;
                                                      foreach($ainfo2 as $row)
                                                      {
                                                          $i++;
                                                          if($i > 8)
                                                          {
                                                              for($subarr=0; $subarr < $asay1; $subarr++)
                                                              {
                                                                if($subsubcat[$subarr] == $row['id'])
                                                                {
                                                                  $cityclass = 'class="selected"';
                                                                  break;
                                                                }
                                                                else
                                                                  $cityclass = "";
                                                              }

                                                              echo'<li class="checkbox">
                                                                      <a '.$cityclass.' href="#">'.$row['ad'].'</a>
                                                                      <input type="checkbox" name="subsubcat[]" hidden value="'.$row['id'].'">
                                                                   </li>';
                                                          }
                                                      }
                                                    ?>
                                                </ul>
                                            </nav>
                                        </li>
                                        <?php } ?>
                                    </ul>
                                </nav>
                            </li>
                            <?php
                                }
                             }

                             if ($asay2)
                             {
                            ?>
                            <li class="li active">
                                <a href="" class="title">
                                    <span>
                                        <b>Şəhər</b>
                                    </span>
                                    <span class="ml-auto">
                                        <i class="fas fa-angle-down"></i>
                                    </span>
                                </a>
                                <nav class="dropdown">
                                    <ul>
                                      <?php
                                        $i=0;
                                        foreach($ainfo3 as $row)
                                        {
                                            $i++;
                                            if($i < 8)
                                            {
                                                $cityclass="";
                                                for($cityarr=0; $cityarr < count($city); $cityarr++)
                                                {
                                                  if ($city[$cityarr] == $row['id'])
                                                  {
                                                    $cityclass='class="selected"';
                                                    break;
                                                  }
                                                }

                                                echo'<li class="checkbox">
                                                        <a '.$cityclass.' href="#">'.$row['ad'].'</a>
                                                        <input type="checkbox" name="city[]" hidden value="'.$row['id'].'">
                                                     </li>';
                                            }
                                        }

                                        if($asay2 > 8)
                                        {
                                        ?>
                                        <li>
                                            <a href="" class="show-more">
                                                <b>Hamsını Göstər</b>
                                                <i class="fas fa-sort-down"></i>
                                            </a>
                                            <nav class="drop-dropdown">
                                                <ul>
                                                    <?php
                                                      $i=0;
                                                      foreach($ainfo4 as $row)
                                                      {
                                                          $i++;
                                                          if($i > 8)
                                                          {
                                                              $cityclass="";
                                                              for($cityarr=0; $cityarr < count($city); $cityarr++)
                                                              {
                                                                if($city[$cityarr] == $row['id'])
                                                                {
                                                                  $cityclass='class="selected"';
                                                                  break;
                                                                }
                                                              }

                                                              echo '<li class="checkbox">
                                                                      <a '.$cityclass.' href="#">'.$row['ad'].'</a>
                                                                      <input type="checkbox" name="city[]" hidden value="'.$row['id'].'">
                                                                    </li>';
                                                          }
                                                      }
                                                    ?>
                                                </ul>
                                            </nav>
                                        </li>
                                        <?php } ?>
                                    </ul>
                                </nav>
                            </li>
                            <?php
                              }
                            ?>
                            <li class="li active">
                                <a href="" class="title">
                                    <span>
                                        <b>Vəziyyəti</b>
                                    </span>
                                    <span class="ml-auto">
                                        <i class="fas fa-angle-down"></i>
                                    </span>
                                </a>
                                <nav class="dropdown">
                                    <ul>
                                        <li class="checkbox">
                                            <a <?php
                                                  foreach($status as $status_row)
                                                  {
                                                    if ($status_row == 4)
                                                    {
                                                      echo 'class="selected"';
                                                      break;
                                                    }
                                                  }
                                                ?> href="#">Əla</a>
                                            <input type="checkbox" name="status[]" hidden value="4">
                                        </li>
                                        <li class="checkbox">
                                            <a <?php
                                                  foreach($status as $status_row)
                                                  {
                                                    if ($status_row == 3)
                                                    {
                                                      echo 'class="selected"';
                                                      break;
                                                    }
                                                  }
                                                ?>
                                                href="#">Yaxşı</a>
                                            <input type="checkbox" name="status[]" hidden value="3">
                                        </li>
                                        <li class="checkbox">
                                            <a <?php
                                                  foreach($status as $status_row)
                                                  {
                                                    if ($status_row == 2)
                                                    {
                                                      echo 'class="selected"';
                                                      break;
                                                    }
                                                  }
                                                ?>
                                             href="#">Orta</a>
                                            <input type="checkbox" name="status[]" hidden value="2">
                                        </li>
                                        <li class="checkbox">
                                            <a <?php
                                                  foreach($status as $status_row)
                                                  {
                                                    if ($status_row == 3)
                                                    {
                                                      echo 'class="selected"';
                                                      break;
                                                    }
                                                  }
                                                ?>
                                             href="#">Kafi</a>
                                            <input type="checkbox" name="status[]" hidden value="1">
                                        </li>
                                    </ul>
                                </nav>
                            </li>
                            <li class="li">
                                <input type="submit" value="Axtar" class="btn-submit col-3"/>
                            </li>
                        </ul>
                    </nav>
                    </form>
                    <div class="ads-container">
                        <div class="ad"><a href="/pages/products?cat=98#result" target="_blank"><img src="/Images/banner-xeyriyye.png"></a></div>
                    </div>
                </div>

                <div class="col-md-9 contents-container">
                <form action="?product&<?php if(isset($cat)){echo'cat='.$cat;} if(isset($subcat)){echo'subcat='.$subcat;} ?>" method="post">
                  <input type="hidden" id="token" name="<?=$this->security->get_csrf_token_name(); ?>" value="<?=$this->security->get_csrf_hash(); ?>">
                    <p class="result-sorting">
                        <span><?=$say; ?> elan tapıldı</span>
                        <?php
                          if($cat==49 || $subcat==50 || $subcat==51 || $subcat==52 || $subcat==53 || $subcat==54)
                          {
                              $class = "ml-0";
                        ?>
                        <span class="sorting">
                            <select name="year" onchange="this.form.submit()">
                                <option value="">Buraxılış ili</option>
                               <?php
                                 foreach($bdinfo as $row)
                                 {
                                   echo '<option ';
                                   if($year == $row['year'])
                                      echo 'selected';
                                   echo ' value="'.$row['year'].'">'.$row['year'].'</option>';
                                 }
                               ?>
                            </select>
                            <i class="fas fa-sort-down"></i>
                        </span>
                        <?php } ?>

                        <span class="sorting <?php if(isset($class)){echo $class;} ?>">
                            <select name="filter" onchange="this.form.submit()">
                                <option value="">Sıralama</option>
                                <option value="vaxt">Vaxta görə</option>
                                <option value="mebleg">Məbləğə görə</option>
                            </select>
                            <i class="fas fa-sort-down"></i>
                        </span>
                      </form>
                    </p>
                    <p class="find">100 məhsul tapıldı</p>
                    <div class="result-sorting-mobile">
                        <p class="sorting-container text-center">
                            <span class="image">
                                <img src="/Images/transfer.svg" alt="">
                            </span>
                            <span>Sıralama</span>
                        </p>
                        <p class="filter-container text-center">
                            <span class="image">
                                <img src="/Images/filter.svg" alt="">
                            </span>
                            <span>Filter</span>
                        </p>
                        <div class="sorting-modal modal">
                            <form class="sorting-modal-container" action="?product&amp;subcat=50" method="post">
                                <input type="hidden" name="<?=$this->security->get_csrf_token_name(); ?>" value="<?=$this->security->get_csrf_hash(); ?>">
                                <p class="sorting-title">
                                    <span>
                                        <i class="fas fa-times"></i>
                                    </span>
                                    <span class="mx-auto">
                                        <b>Sıralama</b>
                                    </span>
                                </p>
                                <nav>
                                    <ul>
                                        <li class="active">
                                            <p>
                                                <span>Vaxta görə</span>
                                                <span class="input-mobile">
                                                    <input type="radio" hidden name="" id="" value="vaxt" onclick="this.form.submit()">
                                                </span>
                                            </p>
                                        </li>
                                        <li>
                                            <p>
                                                <span>Məbləğə görə</span>
                                                <span class="input-mobile">
                                                    <input type="radio" hidden name="" id="" value="mebleg" onclick="this.form.submit()">
                                                </span>
                                            </p>
                                        </li>
                                    </ul>
                                </nav>
                            </form>
                        </div>
                    </div>
                    <div class="contents">
                         <?php
                            if($say > 0)
                            {
                              foreach($infooo as $row)
                              {
                                  $url = get_url($row);
                                  $qid = $row['user'];

                                  if(isset($row['altkat']) && $row['altkat'] == 56)
                                  {
                                      $locinfo = $this->universal_model->get_item_where('house_details', array('elan' => $row['eid']), 'location');
                                      $location=", ".$locinfo->location;
                                  }
                                  else
                                    $location='';

                                  $curr = ($row['curr']==2)?'USD':'AZN';

                                  if($row['price']==0 && $row['razi']!=1)
                                    $price = 'Xeyriyyə';
                                  if($row['razi']==1)
                                    $price = 'Razılaşma yolu ilə';
                                  if($row['price']>0)
                                    $price = $row['price']." ".$curr;
                                  if($row['price']>0)
                                  {
                                      $price_str = "".$row['price'];
                                      if(strlen($price_str)<4){
                                          $price = $price_str.' '.$curr;
                                      }
                                      elseif(strlen($price_str)<6){
                                          $price = substr($price_str,0,strlen($price_str)-3).' '.substr($price_str,strlen($price_str)-3,3).' '.$curr;
                                      }
                                      elseif(strlen($price_str)<9){
                                          $price = substr($price_str,0,strlen($price_str)-6).' '.substr($price_str,strlen($price_str)-6,3).' '.substr($price_str,strlen($price_str)-3,3).' '.$curr;
                                      }
                                  }

                                  $date = explode(" ", $row['tarix']);

                                  $saat = $date[1];
                                  $saat = explode(":",$saat);
                                  $saat = $saat[0].":".$saat[1];
                                  $gun = $date[0];

                                  $current = strtotime(date("Y-m-d"));
                                  $date = strtotime($gun);

                                  $datediff = $date - $current;
                                  $difference = floor($datediff/(60*60*24));

                                  if($difference==0){$tarix='Bugün';}
                                  else if($difference > 0){$tarix=$gun;}
                                  else if($difference < -1){$tarix=$gun;}
                                  else{$tarix='Dünən';}

                                  if(empty($tarix))
                                    $tarix = $gun;

                                  if(!empty($this->session->userdata('uid')))
                                  {
                                      $favorit = $this->universal_model->get_more_item('favorit', "pid='".$row['eid']."' AND uid='".$_SESSION['uid']."' AND beyen=1", 1,);
                                      if(count($favorit) > 0)
                                      {$bimg='http://new.otomoto.az/Images/heart-red-full.svg'; $bclass='beyenme';}
                                      else
                                      {$bimg='http://new.otomoto.az/Images/heart-red.svg'; $bclass='beyen';}
                                  }
                                  else
                                  {$bimg='http://new.otomoto.az/Images/heart-red.svg'; $bclass='beyen';}

                          ?>
                          <script>
                             var token = $('#token').val();

                             $(document).on('click', '.beyen<?=$row['eid']; ?>', function(){
                                var bid = $(this).attr("id");

                          			$.ajax({
                            				url:"/pages/ajax_index",
                            				method: "POST",
                            				data:{bid:bid, otomoto: token},
                            				success: function(data) {
                            				    $("#b<?=$row['eid']?>").attr("src", "https://new.otomoto.az/Images/heart-red-full.svg");
                            				    $("#b<?=$row['eid']?>").parent().removeClass( "beyen<?=$row['eid'] ?>" );
                            				    $("#b<?=$row['eid']?>").parent().addClass( "beyenme<?=$row['eid'] ?>" );
                            				}
                          			});
                      	     });

                             $(document).on('click', '.beyenme<?=$row['eid'] ?>', function(){
                                var nid = $(this).attr("id");

                          			$.ajax({
                            				url:"/pages/ajax_index",
                            				method:"POST",
                            				data:{nid:nid, otomoto: token},
                            				success: function(data) {
                            				    $("#b<?=$row['eid']; ?>").attr("src", "https://new.otomoto.az/Images/heart-red.svg");
                            				    $("#b<?=$row['eid']; ?>").parent().removeClass( "beyenme<?=$row['eid']; ?>" );
                            				    $("#b<?=$row['eid']; ?>").parent().addClass( "beyen<?=$row['eid']; ?>" );
                            				}
                          			});
                          	 });
                      	</script>

                              <div class="content">
                                  <a href="/pages/product/<?=$url; ?>" class="super-ed-image" target="_blank">
                                      <img src="http://new.otomoto.az/barthaus/users/admin/elan/uploadengine/<?=$row['target']?>" alt="">
                                  </a>
                                  <div class="details">
                                      <a href="/pages/product/<?=$url ?>" target="_blank">
                                          <p class="d-flex brand-name">
                                              <a href="/pages/product/<?=$url ?>">
                                                <span>Kateqoriya</span>
                                              </a>
                                              <span class="ml-auto">
                                                  <a href="">
                                                      <img src="https://new.otomoto.az/barthaus/users/admin/elan/uploadengine/<?=$row['target']?>">
                                                  </a>
                                              </span>
                                          </p>
                                      </a>
                                      <a href="/pages/product/<?=$url ?>" target="_blank">
                                          <p class="d-flex model-name">
                                              <a href="/pages/product/<?=$url ?>" target="_blank"><b><?php if(strlen($row['title'])>53){echo substr($row['title'],0,49).'...';} else {echo $row['title'];}?><?=$location ?></b></a>
                                          </p>
                                      </a>
                                      <a href="/pages/product/<?=$url ?>" target="_blank">
                                          <p class="d-flex cost">
                                              <b><?=$price?></b>
                                          </p>
                                      </a>
                                      <a href="/pages/product/<?=$url ?>" target="_blank">
                                          <p class="d-flex">
                                              <span class="addDate"><?=$row['town']?>, <?=$tarix?>, <?=$saat?></span>
                                          </p>
                                      </a>
                                      <br>
                                      <p class="like <?=$bclass.$row['eid'] ?>">
                                          <img id="b<?=$row['eid']?>" src="<?=$bimg ?>" alt="">
                                      </p>
                                  </div>
                              </div>

                              <?php
                              }
                            }
                            else
                            {
                                if(empty($axtar))
                                  echo'<div class="alert alert-danger" role="alert" style="font-size:15px; width:95%;"><i style="font-size:12px;" class="fa fa-exclamation-triangle"></i> Bazada heç bir aktiv elan yoxdur</div>';
                                else
                                  echo'<div class="alert alert-danger" role="alert" style="font-size:15px; width:95%;"><i style="font-size:12px;" class="fa fa-exclamation-triangle"></i> Axtardığınız sorğu üzrə heç bir məlumat tapılmadı</div>';
                            }
                            ?>
                        </p>
                    </div>
                </div>
            </section>
        </div>
    </main>

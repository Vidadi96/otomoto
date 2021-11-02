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

    function for_info($info)
    {
      $i=0;
      foreach($info as $row)
      {
          $i++;
          $class = ($i==1)?"active":'';
          $imagee = (substr($row['img'], 0, 4) != 'http' && substr($row['img'], 0, 1) != '/')?'/'.$row['img']:$row['img'];

          echo '<div class="category '.$class.'" id="ca'.$i.'">
                    <p>
                        <img src="'.$imagee.'">
                        <p class="name text-center">
                            <b>'.$row['ad'].'</b>
                        </p>
                        <p class="line"></p>
                    </p>
                </div>';
        }
    }
?>
        <input type="hidden" id="token" name="<?=$this->security->get_csrf_token_name(); ?>" value="<?=$this->security->get_csrf_hash(); ?>">
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
                                    <?php for_info($info); ?>
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
                                    <?php for_info($info); ?>
                                </div>
                            </div>
                        </div>
                        <?php
                            $i=0;
                            foreach($info as $row)
                            {
                                $i++;
                                $class = ($row['id']==97 or $row['id']==55)?'line2':'';
                                echo '<div class="subcategories ca'.$i.'">';

                                if($row['id']!=97 && $row['id']!=98)
                                {
                                    echo '<nav>
                                              <ul>
                                                  <li>
                                                      <a href="/pages/products?cat='.$row['id'].'#result">Bütün elanlar</a>
                                                  <li>';

                                    $info1 = $this->universal_model->get_more_item('elancats', array('active' => 1, 'maincat' => $row['id'], 'altcat' => 0), 1);

                                    foreach($info1 as $raw)
                                        echo '<li><a href="/pages/products?subcat='.$raw['id'].'#result">'.$raw['ad'].'</a></li>';

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
                    <?php $class = (!isset($_SESSION['uid']))?"nr":""; ?>
                    <a class="<?=$class; ?>" href="/pages/bartychat">
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
                <a href="/" class="gray">Əsas Səhifə</a>
                <img src="/Images/arrow-right.svg" alt="">
                <a href="" class="black">Elan Yerləşdir</a>
            </p>
            <section class="userads-container">
                <div class="left">
                    <div class="user-details-container">
                        <div class="user-details">
                            <div class="back d-md-none">
                                <a href="/">
                                    <img src="/Images/previous.svg" alt="">
                                </a>
                            </div>
                            <div class="user-image">
                                <?php $image = (substr($uinfo['image'], 0, 4) != 'http' && substr($uinfo['image'], 0, 1) != '/')?'/'.$uinfo['image']:$uinfo['image']; ?>
                                <img src="<?=$image; ?>" alt="">
                            </div>
                            <div class="user-detail">
                                <p class="user-name">
                                    <span>
                                        <b><?=$uinfo['first_name']." ".$uinfo['last_name']; ?></b>
                                    </span>
                                </p>
                                <script>
                                    var token = $("#token").val();
                                    $(document).on('click', '.reytinq', function(){
                                    		var reytinq = $(this).attr("id");
                                    		var rid = <?=$_GET["user_id"] ?>;

                                  			$.ajax({
                                  				url:"/reytinq.php",
                                  				method:"POST",
                                  				data: {reytinq:reytinq, rid:rid, otomoto: token},
                                  				success:function(data) {
                                  				    if (data!=='')
                                  				        alert(data);
                                  				}
                                  			});
                                			  return false;
                                	  });
                                </script>
                                <p class="user-rating">
                                    <?php
                                        $rcem = $rinfo?$rinfo->rtnq:0;
                                        $rveren = count($rsec2);
                                        $rveren_del = $rveren?$rveren:1;
                                        $orta = $rcem/$rveren_del;
                                        $netice = round($orta);
                                        if ($rveren == 0)
                                            $netice = 0;

                                        $nr = (!isset($_SESSION["uid"]))?'nr':'';

                                        for($j=0; $j<$netice; $j++)
                                            echo '<img class="reytinq '.$nr.'" src="/Images/filled-star.svg" id="img'.($j+1).'">';

                                        for($j=$netice; $j<5; $j++)
                                            echo '<img class="reytinq '.$nr.'" src="/Images/empty-star.svg" id="img'.($j+1).'">';

                                    ?>
                                </p>
                                <p class="online">Online</p>
                                <p class="date"><?=date("d.m.Y") ?> / <?=date("H:i") ?></p>
                            </div>
                        </div>
                        <div class="change-now">
                            <form action="/pages/bartychat" method="post" class="change-now-form">
                                <input type="hidden" name="<?=$this->security->get_csrf_token_name(); ?>" value="<?=$this->security->get_csrf_hash(); ?>">
                                <input type="phone" disabled placeholder=" <?=$uinfo['mobile'] ?>" class="phone col-md-7">
                                <input type="hidden" name="qid" value="<?=$user_id; ?>">
                                <input type="submit" class="message col-md-5 <?php if(!isset($_SESSION['uid'])){echo'nr';} ?>" value="Mesaj yaz" class="message col-md-5">
                            </form>
                        </div>
                    </div>
                    <div class="ad">
                        <a href="http://azerinnovation.az/" target="_blank"><img src="/Images/banner3.png"></a>
                    </div>
                </div>
                <div class="right">
                    <div class="userads">
                        <?php
                            if(count($info2) > 0)
                            {
                                foreach($info2 as $row)
                                {
                                    $url = get_url($row);
                                    $price = ($row['curr']=1)?$row['price']."AZN":$row['price']."USD";
                                    $date = explode(" ", $row['tarix']);

                                    $saat = $date[1];
                                    $saat = explode(":",$saat);
                                    $saat = $saat[0].":".$saat[1];
                                    $gun = $date[0];
                                    $current = strtotime(date("Y-m-d"));
                                    $date2 = strtotime($gun);
                                    $datediff = $date2 - $current;
                                    $difference = floor($datediff/(60*60*24));

                                    if ($difference==0)
                                      $tarix = 'Bugün';
                                    else if ($difference > 0)
                                      $tarix = $date[0];
                                    else if ($difference < -1)
                                      $tarix = $date[0];
                                    else
                                      $tarix = 'Dünən';

                                    if (empty($tarix))
                                      $tarix = $date[0];

                                    if(!empty($_SESSION['uid']))
                                    {
                                        $favorit = $this->universal_model->get_more_item('favorit', array('pid' => $row['eid'], 'uid' => $this->session->userdata('uid'), 'beyen' => 1), 1);
                                        if (count($favorit) > 0) {
                                          $bimg = '/Images/heart-red-full.svg';
                                          $bclass = 'beyenme';
                                        } else {
                                          $bimg = '/Images/heart-red.svg';
                                          $bclass = 'beyen';
                                        }
                                    } else {
                                      $bimg = '/Images/heart-red.svg';
                                      $bclass='beyen';
                                    }
                        ?>
                        <script>
                           $(document).on('click', '.beyen<?=$row['eid'] ?>', function(){
                              var bid = $(this).attr("id");

                              $.ajax({
                                url:"/pages/ajax_index",
                                method:"POST",
                                data:{bid: bid, otomoto: $('#token').val()},
                                success:function(data) {
                                    $("#b<?=$row['eid']?>").attr("src", "/Images/heart-red-full.svg");
                                    $("#b<?=$row['eid']?>").parent().removeClass( "beyen<?=$row['eid'] ?>" );
                                    $("#b<?=$row['eid']?>").parent().addClass( "beyenme<?=$row['eid'] ?>" );
                                }
                              });
                           });

                           $(document).on('click', '.beyenme<?=$row['eid'] ?>', function(){
                              var nid = $(this).attr("id");

                              $.ajax({
                                url: "/pages/ajax_index",
                                method: "POST",
                                data: {nid: nid, otomoto: $('#token').val()},
                                success:function(data) {
                                    $("#b<?=$row['eid']?>").attr("src", "/Images/heart-red.svg");
                                    $("#b<?=$row['eid']?>").parent().removeClass( "beyenme<?=$row['eid'] ?>" );
                                    $("#b<?=$row['eid']?>").parent().addClass( "beyen<?=$row['eid'] ?>" );
                                }
                              });
                           });
                      </script>
    	                <div class="userad">
                          <a href="/pages/product/<?=$url ?>" class="userad-image" target="_blank" ?>>
                              <img src="/barthaus/users/admin/elan/uploadengine/<?=$row['target']?>" alt="">
                          </a>
                          <div class="details">
                              <p class="d-flex model-name">
                                  <a href="/pages/product?eid=<?=$row['token']; ?>" target="_blank"><b><?php if(strlen($row['title'])>53){echo substr($row['title'],0,49).'...';} else {echo $row['title'];}?></b></a>
                              </p>
                              <p class="d-flex cost">
                                  <b><?=$price; ?></b>
                              </p>
                              <p class="d-flex addDate">
                                  <span class="addDate"><?=$row['town']; ?>, <?=$tarix; ?>, <?=$saat; ?></span>
                              </p>
                              <br>
                              <p class="like">
                                  <img id="b<?=$row['eid']; ?>" class="<?=$bclass.$row['eid']; ?>" src="<?=$bimg; ?>" alt="">
                              </p>
                          </div>
                      </div>
                      <?php
                      }
                  }
                  else
                  {
                      if (empty($axtar))
                        echo '<div class="alert alert-danger" role="alert" style="font-size:15px; width:95%;"><i style="font-size:12px;" class="fa fa-exclamation-triangle"></i> Bazada heç bir aktiv elan yoxdur</div>';
                      else
                        echo '<div class="alert alert-danger" role="alert" style="font-size:15px; width:95%;"><i style="font-size:12px;" class="fa fa-exclamation-triangle"></i> Axtardığınız sorğu üzrə heç bir məlumat tapılmadı</div>';
                  }
                  ?>
              </div>
          </div>
      </section>
  </div>
</main>

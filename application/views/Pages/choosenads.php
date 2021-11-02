<?php
  function info_func($info)
  {
    $i=0;
    foreach($info as $row)
    {
        $i++;
        $class = ($i==1)?"active":"";
        $image = (substr($row['img'], 0, 4) != 'http' && substr($row['img'], 0, 1) != '/')?'/'.$row['img']:$row['img'];

        echo '<div class="category '.$class.'" id="ca'.$i.'">
                  <p>
                      <img src="'.$image.'">
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
        <?php //echo $chat; ?>
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
                                    <?php info_func($info); ?>
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
                                    <?php info_func($info); ?>
                                </div>
                            </div>
                        </div>
                        <?php
                            $i=0;
                            foreach($info as $row)
                            {
                                $i++;
                                $class = ($row['id']==97 || $row['id']==55)?'line2':'';

                                echo '<div class="subcategories ca'.$i.'">';

                                if($row['id']!=97 && $row['id']!=98)
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
                                echo'</div>';
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
            <div class="main-text-container">
                <p class="main-text">
                    <a href="/" class="gray">Əsas Səhifə</a>
                    <img src="/Images/arrow-right.svg" alt="">
                    <a href="" class="black">Elan Yerləşdir</a>
                </p>
                <div class="ml-auto">
                    <p>Balansınız: <span class="cost">0,00</span> AZN</p>
                    <p class="text-center">
                        <a href="">
                            <b>Balansı Artır</b>
                        </a>
                    </p>
                </div>
            </div>
            <section class="choosenads-container">
                <?=$profilemenu; ?>
                <div class="right">
                    <div class="like-balance">
                        <p class="like text-center">
                            <a href="/pages/choosenads">
                                <img src="/Images/heart-red.svg" alt="">
                                <span>
                                    <b>Seçilmişlər</b>
                                </span>
                            </a>
                        </p>
                        <p class="balance text-center">
                            <span class="text">
                                <b>Balansınız:</b>
                            </span>
                            <span class="red">
                                <span class="cost">0,00</span>
                                <span class="currency">AZN</span>
                            </span>
                        </p>
                    </div>
                    <div class="choosenads">
                         <?php
                            if(count($info2) > 0)
                            {
                                foreach($info2 as $row)
                                {
                                    $qid = $row['user'];
                                    $url = $this->get_url($row);

                                    $date = explode(" ", $row['tarix']);
                                    $saat = $date[1];
                                    $saat = explode(":", $saat);
                                    $saat = $saat[0].":".$saat[1];
                                    $gun = $date[0];
                                    $gun = date("d-m-Y", strtotime($gun));

                                    $current = strtotime(date("Y-m-d"));
                                    $date = strtotime($gun);
                                    $datediff = $date - $current;
                                    $difference = floor($datediff/(60*60*24));

                                    if ($difference == 0)
                                      $tarix = 'Bugün';
                                    else if ($difference > 0)
                                      $tarix = $gun;
                                    else if ($difference < -1)
                                      $tarix = $gun;
                                    else
                                      $tarix = 'Dünən';

                                    if (empty($tarix))
                                      $tarix = $gun;

                                    if(!empty($_SESSION['uid']))
                                    {
                                        $favorit2 = $this->universal_model->get_more_item('favorit', array('pid' => $row['eid'], 'uid' => $this->session->userdata('uid'), 'beyen' => 1), 1);
                                        if (count($favorit2) > 0) {
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
                               var token = $('#token').val();

                               $(document).on('click', '.beyen<?=$row['eid']; ?>', function(){
                                  var bid = $(this).attr("id");

                            			$.ajax({
                            				url:"/pages/ajax_index",
                            				method:"POST",
                            				data:{bid: bid, otomoto: token},
                            				success:function(data) {
                            				    $("#b<?=$row['eid']?>").attr("src", "/Images/heart-red-full.svg");
                            				    $("#b<?=$row['eid']?>").removeClass( "beyen<?=$row['eid'] ?>" );
                            				    $("#b<?=$row['eid']?>").addClass( "beyenme<?=$row['eid'] ?>" );
                            				}
                            			});
                        	     });

                    	         $(document).on('click', '.beyenme<?=$row['eid'] ?>', function(){
                                  var nid = $(this).attr("id");

                                  $.ajax({
                            				url:"/pages/ajax_index",
                            				method:"POST",
                            				data:{nid: nid, otomoto: token},
                            				success: function(data) {
                            				    $("#b<?=$row['eid']?>").attr("src", "/Images/heart-red.svg");
                            				    $("#b<?=$row['eid']?>").removeClass( "beyenme<?=$row['eid'] ?>" );
                            				    $("#b<?=$row['eid']?>").addClass( "beyen<?=$row['eid'] ?>" );
                            				}
                            			});
                        	     });
                        	</script>
                          <div class="choosenad">
                              <a href="/pages/product/<?=$url ?>" class="choosenad-image">
                                  <img src="/barthaus/users/admin/elan/uploadengine/<?=$row['target']?>" target="_blank" alt="">
                              </a>
                              <div class="details">
                                  <p class="d-flex model-name">
                                      <a href="/pages/product/<?=$url ?>" target="_blank">
                                          <span>
                                              <b><?php if(strlen($row['title'])>53){echo substr($row['title'],0,49).'...';} else {echo $row['title'];}?></b>
                                          </span>
                                      </a>
                                      <span class="ml-auto">
                                          <img id="b<?=$row['eid']?>" class="<?=$bclass.$row['eid'] ?> like" src="<?=$bimg; ?>" alt="">
                                      </span>
                                  </p>
                                  <p class="d-flex cost">
                                      <b><?=$row['price']; ?> AZN</b>
                                  </p>
                                  <p class="d-flex addDate"><?=$row['town']; ?>, <?=$tarix; ?>, <?=$saat; ?></p>
                              </div>
                              <br>
                           </div>
                          <?php
                          }
                      }
                      else
                      {
                          if(empty($axtar))
                            echo '<div class="alert alert-danger" role="alert" style="font-size:15px; width:95%;"><i style="font-size:12px;" class="fa fa-exclamation-triangle"></i> Bazada heç bir aktiv elan yoxdur</div>';
                          else
                            echo'<div class="alert alert-danger" role="alert" style="font-size:15px; width:95%;"><i style="font-size:12px;" class="fa fa-exclamation-triangle"></i> Axtardığınız sorğu üzrə heç bir məlumat tapılmadı</div>';
                      }
                      ?>
                    </div>
                </div>
            </section>
        </div>
    </main>

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
       <input type="hidden" id="lucky_token" name="<?=$this->security->get_csrf_token_name(); ?>" value="<?=$this->security->get_csrf_hash(); ?>">
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
                    <a href="/addad.php?elan">
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
                        <p class="text-center"><a href="/pages/products?ferq=1">Feel Lucky</a></p>
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
            <div class="feel-lucky-container">
                <div class="owl-carousel">
                    <?php
                            $i=0;
                            if(count($info2) > 0)
                            {
                                foreach($info2 as $row)
                                {
                                    $i++;

                                    $curr = ($row['curr'] == 2)?'USD':'AZN';
                                    $url = get_url($row);

                                    if ($row['price'] == 0 && $row['razi'] != 1)
                                        $price = 'Xeyriyyə';
                                    if ($row['razi'] == 1)
                                        $price = 'Razılaşma yolu ilə';
                                    if ($row['price'] > 0)
                                        $price=$row['price']." ".$curr;

                                    $eid = $row['token'];
                                    $aid = $row['eid'];
                                    $uid = $row['uid'];
                                    $ad = $row['first_name'];
                                    $soyad = $row['last_name'];

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
                            <div class="item">
                                <div class="image-container">
                                    <a href="/pages/product/<?=$url ?>"><img src="/barthaus/users/admin/elan/uploadengine/<?=$row['target'] ?>" alt="<?=$row['title'] ?>"></a>
                                </div>
                                <div class="details">
                                    <div class="col-7">
                                        <p class="title">
                                            <b><?php if(strlen($row['title'])>53){echo substr($row['title'],0,49).'...';} else {echo $row['title'];}?></b>
                                        </p>
                                        <p class="cost">
                                            <b><?=$price; ?></b>
                                        </p>
                                    </div>
                                    <div class="col-5">
                                        <p class="text-center" id="barter-reg<?php if(isset($_SESSION['uid'])){echo'1';} ?>">
                                            <span class="img">
                                                <img src="/Images/chat-red.svg" alt="">
                                            </span>
                                            <span>Barter təklif et</span>
                                        </p>
                                    </div>
                                </div>
                                <?php $_SESSION['token'] = md5(time()); ?>
                                <script>
                                    var token = $('#lucky_token').val();
                                    $(document).ready(function(){
                                        $("#teklifet<?=$i ?>").click(function(event){
                                            event.preventDefault();

                                            var form = document.sform;
                                            var fd = new FormData();

                                            fd.append("files[]", document.getElementById('image<?=$i ?>').files[0]);
                                            fd.append("files[]", document.getElementById('image<?=$i ?>').files[1]);
                                            fd.append("files[]", document.getElementById('image<?=$i ?>').files[2]);
                                            fd.append("files[]", document.getElementById('image<?=$i ?>').files[3]);
                                            fd.append("files[]", document.getElementById('image<?=$i ?>').files[4]);
                                            fd.append("files[]", document.getElementById('image<?=$i ?>').files[5]);
                                            fd.append("text",$("#exampleModal .desc textarea").val());
                                            fd.append("firstname",$("#firstname<?=$i ?>").val());
                                            fd.append("email",$("#email<?=$i ?>").val());
                                            fd.append("mobile",$("#mobile<?=$i ?>").val());
                                            fd.append("text",$("#mezmun<?=$i ?>").val());
                                            fd.append("uid",$("#uid<?=$i ?>").val());
                                            fd.append("eid",$("#eid<?=$i ?>").val());
                                            fd.append("aid",$("#aid<?=$i ?>").val());
                                            fd.append("tkn",$("#tkn").val());
                                            fd.append("otomoto", token);

                                            $.ajax({
                                                url: '/include2/ajaxsuggest',
                                                type: 'post',
                                                data: fd,
                                                contentType: false,
                                                processData: false,
                                                success: function(response){
                                                    if(response==' ')
                                                        $(".success-modal").append('<div class="row modal"><div class="modalbox success col-sm-6 col-md-5 col-lg-4 center animate"><div class="icon"><img src="/Images/okay.svg"></div><h1>Barter təklifiniz göndərildi. Sizə uğurlar diləyirik!</h1><a href="">Ok</a></div></div>');
                                                    else
                                                        $(".success-modal").append('<div class="row modal"><div class="modalbox error col-sm-6 col-md-5 col-lg-4 center animate"><div class="icon"><img src="/Images/error.svg"></div><h1>'+response+'</h1><button type="button" class="redo btn" onclick="Close()">Ok</button></div></div>');
                                                },
                                            });
                                        });
                                    });
                                </script>
                                <div class="modal barter barter-reg" id="exampleModal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title" id="exampleModalLabel">Barter təklif et</h4>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">×</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="/pages/product?eid=<?=$eid ?>"  onsubmit="return false;" method="POST" name="sform" id="barterform" enctype='multipart/form-data'>
                                                    <input type="hidden" name="<?=$this->security->get_csrf_token_name(); ?>" value="<?=$this->security->get_csrf_hash(); ?>">
                                                    <input type="hidden" name="tkn" id="tkn" value="<?=$_SESSION['token'] ?>">

                                                    <div class="form-group">
                                                        <label for="name" class="control-label">Adınız<span class="asteriks">*</span>:</label>
                                                        <input type="text" required class="form-control" id="firstname<?=$i ?>" name="firstname">
                                                        <input type="hidden" class="form-control" id="uid<?=$i ?>" name="uid" value="<?=$uid ?>">
                                                        <input type="hidden" class="form-control" id="eid<?=$i ?>" name="eid" value="<?=$eid ?>">
                                                        <input type="hidden" class="form-control" id="aid<?=$i ?>" name="aid" value="<?=$aid ?>">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="phone" class="control-label">Telefon nömrəniz<span class="asteriks">*</span>:</label>
                                                        <input type="text" required class="form-control" id="mobile<?=$i ?>" name="mobile">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="email" class="control-label">Email ünvanınız:</label>
                                                        <input type="email" required class="form-control" id="email<?=$i ?>" name="email">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="text" class="control-label">Mətn<span class="asteriks">*</span>:</label>
                                                        <textarea class="form-control" required="" id="mezmun<?=$i ?>" name="text" rows="5" cols="30" style="height:6.3rem;"></textarea>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="imageToUpload">
                                                            <span>Şəkillər</span>
                                                        </label>
                                                        <?php
                                                            if(!isset($_SESSION['uid']))
                                                            {
                                                        ?>

                                                        <script>
                                                            function readURL<?=$i ?>(input) {

                                                                if (input.files && input.files[0]) {
                                                                    var reader = new FileReader();

                                                                    reader.onload = function (e) {
                                                                        $('.ac<?=$i ?> #bla1').attr('src', e.target.result);
                                                                    }

                                                                    reader.readAsDataURL(input.files[0]);
                                                                }

                                                                if (input.files && input.files[1]) {
                                                                    var reader = new FileReader();

                                                                    reader.onload = function (e) {
                                                                        $('.ac<?=$i ?> #bla2').attr('src', e.target.result);
                                                                    }

                                                                    reader.readAsDataURL(input.files[1]);
                                                                }

                                                                if (input.files && input.files[2]) {
                                                                    var reader = new FileReader();

                                                                    reader.onload = function (e) {
                                                                        $('.ac<?=$i ?> #bla3').attr('src', e.target.result);
                                                                    }

                                                                    reader.readAsDataURL(input.files[2]);
                                                                }

                                                                if (input.files && input.files[3]) {
                                                                    var reader = new FileReader();

                                                                    reader.onload = function (e) {
                                                                        $('.ac<?=$i ?> #bla4').attr('src', e.target.result);
                                                                    }

                                                                    reader.readAsDataURL(input.files[3]);
                                                                }

                                                                if (input.files && input.files[4]) {
                                                                    var reader = new FileReader();

                                                                    reader.onload = function (e) {
                                                                        $('.ac<?=$i ?> #bla5').attr('src', e.target.result);
                                                                    }

                                                                    reader.readAsDataURL(input.files[4]);
                                                                }

                                                                if (input.files && input.files[5]) {
                                                                    var reader = new FileReader();

                                                                    reader.onload = function (e) {
                                                                        $('.ac<?=$i ?> #bla6').attr('src', e.target.result);
                                                                    }

                                                                    reader.readAsDataURL(input.files[5]);
                                                                }
                                                            }
                                                        </script>
                                                        <?php } ?>
                                                        <br>
                                                        <label class="btn btn-default btn-file center-block" style="background-color: #337ab7;color: white;"> Şəkilləri seç
                                                            <input id="image<?=$i ?>" name="imageToUpload[]" required multiple class="form-control img upload-img" type="file" style="display: none;" data-name="images[]" onchange="readURL<?=$i ?>(this)">
                                                        </label>
                                                        <div class="ads-container ac<?=$i ?> modal-header">
                                                            <div class="d-flex">
                                                                <div class="ad">
                                                                    <img id="bla1" src="">
                                                                </div>
                                                                <div class="ad">
                                                                    <img id="bla2" src="">
                                                                </div>
                                                                <div class="ad">
                                                                    <img id="bla3" src="">
                                                                </div>
                                                                <div class="ad">
                                                                    <img id="bla4" src="">
                                                                </div>
                                                                <div class="ad">
                                                                    <img id="bla5" src="">
                                                                </div>
                                                                <div class="ad">
                                                                    <img id="bla6" src="">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                            <div class="modal-footer text-center">
                                                <button class="btn btn-primary" id="teklifet<?=$i ?>" form="barterform">Təklif et</button>
                                            </div>
                                        </div>
                                    </div>
                              </div>
                              <script>
                                  $(document).ready(function(){
                                      $("#but_upload<?=$i ?>").click(function(event){

                                          event.preventDefault();

                                          var form = document.tform;
                                          var fd = new FormData();
                                          var dt = new FormData();
                                          var dt = $(form).serialize();

                                          fd.append("files[]", document.getElementById('file<?=$i ?>').files[0]);
                                          fd.append("files[]", document.getElementById('file<?=$i ?>').files[1]);
                                          fd.append("files[]", document.getElementById('file<?=$i ?>').files[2]);
                                          fd.append("files[]", document.getElementById('file<?=$i ?>').files[3]);
                                          fd.append("files[]", document.getElementById('file<?=$i ?>').files[4]);
                                          fd.append("files[]", document.getElementById('file<?=$i ?>').files[5]);
                                          fd.append("text",$("#text<?=$i ?>").val());
                                          fd.append("qid",$("#qid<?=$i ?>").val());
                                          fd.append("ad",$("#ad<?=$i ?>").val());
                                          fd.append("soyad",$("#soyad<?=$i ?>").val());
                                          fd.append("aid",$("#aid<?=$i ?>").val());
                                          fd.append("selected",$("#selected<?=$i ?>").val());
                                          fd.append("tkn",$("#token<?=$i ?>").val());
                                          fd.append('otomoto', token);

                                          $.ajax({
                                              url: '/include2/ajaxsuggest',
                                              type: 'post',
                                              data: fd,
                                              contentType: false,
                                              processData: false,
                                              success: function(response){
                                                  if(response==' ')
                                                      $(".success-modal").append('<div class="row modal"><div class="modalbox success col-sm-6 col-md-5 col-lg-4 center animate"><div class="icon"><img src="/Images/okay.svg"></div><h1>Barter təklifiniz göndərildi. Sizə uğurlar diləyirik!</h1><a href="">Ok</a></div></div>');
                                                  else
                                                      $(".success-modal").append('<div class="row modal"><div class="modalbox error col-sm-6 col-md-5 col-lg-4 center animate"><div class="icon"><img src="/Images/error.svg"></div><h1>'+response+'</h1><button type="button" class="redo btn" onclick="Close()">Ok</button></div></div>');
                                              },
                                          });
                                      });
                                  });
                              </script>
                              <div class="modal barter-login barter-reg1" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
                                   <form action="/pages/product?eid=<?=$eid ?>" onsubmit="return false;" method="POST" name="tform" id="barterform2" enctype='multipart/form-data'>
                                     <input type="hidden" name="<?=$this->security->get_csrf_token_name(); ?>" value="<?=$this->security->get_csrf_hash(); ?>">

                                    <div class="barter-login-container">
                                        <div class="ads-container">
                                            <input type="hidden" id="token<?=$i; ?>" name="tkn" value="<?=$_SESSION['token']; ?>">
                                            <input type="hidden" id="qid<?=$i; ?>" name="qid" value="<?=$uid; ?>">
                                            <input type="hidden" id="ad<?=$i; ?>" name="ad" value="<?=$ad; ?>">
                                            <input type="hidden" id="soyad<?=$i; ?>" name="soyad" value="<?=$soyad; ?>">
                                            <input type="hidden" id="aid<?=$i; ?>" name="aid" value="<?=$aid; ?>">

                                            <?php
                                                if(isset($_SESSION['uid']))
                                                {
                                            ?>
                                            <script type="text/javascript">
                                                function readURL_login<?=$i ?>(input) {

                                                    if (input.files && input.files[0]) {
                                                        var reader = new FileReader();

                                                        reader.onload = function (e) {
                                                            $('.ac<?=$i ?> #blah1').attr('src', e.target.result);
                                                        }

                                                        reader.readAsDataURL(input.files[0]);
                                                    }

                                                    if (input.files && input.files[1]) {
                                                        var reader = new FileReader();

                                                        reader.onload = function (e) {
                                                            $('.ac<?=$i ?> #blah2').attr('src', e.target.result);
                                                        }

                                                        reader.readAsDataURL(input.files[1]);
                                                    }

                                                    if (input.files && input.files[2]) {
                                                        var reader = new FileReader();

                                                        reader.onload = function (e) {
                                                            $('.ac<?=$i ?> #blah3').attr('src', e.target.result);
                                                        }

                                                        reader.readAsDataURL(input.files[2]);
                                                    }

                                                    if (input.files && input.files[3]) {
                                                        var reader = new FileReader();

                                                        reader.onload = function (e) {
                                                            $('.ac<?=$i ?> #blah4').attr('src', e.target.result);
                                                        }

                                                        reader.readAsDataURL(input.files[3]);
                                                    }

                                                    if (input.files && input.files[4]) {
                                                        var reader = new FileReader();

                                                        reader.onload = function (e) {
                                                            $('.ac<?=$i ?> #blah5').attr('src', e.target.result);
                                                        }

                                                        reader.readAsDataURL(input.files[4]);
                                                    }

                                                    if (input.files && input.files[5]) {
                                                        var reader = new FileReader();

                                                        reader.onload = function (e) {
                                                            $('.ac<?=$i ?> #blah6').attr('src', e.target.result);
                                                        }

                                                        reader.readAsDataURL(input.files[5]);
                                                    }
                                                }
                                            </script>
                                            <?php } ?>
                                        <div class="addAd">
                                            <p class="add">+</p>
                                               <input id="file<?=$i ?>" name="file[]" multiple class="form-control img upload-img2" type="file" style="display: none;" data-name="images[]" onchange="readURL_login<?=$i ?>(this);">
                                            <p class="text-center">Məhsul əlavə et</p>
                                        </div>
                                        <div class="ads">
                                        <?php
                                            foreach($binfo as $rew)
                                            {
                                                if(!empty($rew['target']))
                                                {
                                            ?>
                                                <div class="ad selected">
                                                    <img src="/barthaus/users/admin/elan/uploadengine/<?=$rew['target']?>" id="<?=$rew['id']?>" alt="">
                                                    <input type="radio" id="selected<?=$i ?>" hidden name="selected" value="<?=$rew['id']?>">
                                                </div>
                                            <?php
                                                }
                                            }
                                        ?>
                                        </div>
                                    </div>
                                    <div class="ads-container ac<?=$i ?> modal-header" style="display:none">
                                    <div class="d-flex">
                                        <div class="ad">
                                            <img id="blah1" src="">
                                        </div>
                                        <div class="ad">
                                            <img id="blah2" src="">
                                        </div>
                                        <div class="ad">
                                            <img id="blah3" src="">
                                        </div>
                                        <div class="ad">
                                            <img id="blah4" src="">
                                        </div>
                                        <div class="ad">
                                            <img id="blah5" src="">
                                        </div>
                                        <div class="ad">
                                            <img id="blah6" src="">
                                        </div>
                                    </div>
                                    <span class="x" syle="cursor:pointer">x</span>
                                </div>
                                    <p class="bl-text">Barter etmək istədiyiniz məhsulu seçin və ya əlavə edin</p>
                                    <div class="desc">
                                        <label for="desc">Məzmun:</label>
                                        <textarea name="text" id="text<?=$i ?>" id="" cols="30" rows="5"></textarea>
                                    </div>
                                    <div class="submit-container">
                                        <input type="submit" value="Təklif et" id="but_upload<?=$i ?>" class="submit tsubmit">
                                    </div>
                                </div>
                                </form>
                            </div>
                           <p class="like">
                              <img id="b<?=$row['eid']?>" class="<?=$bclass.$row['eid'] ?>" src="<?=$bimg; ?>" alt="">
                           </p>
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
                </div>
            </div>
        </div>
    </main>

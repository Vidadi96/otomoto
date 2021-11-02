
        <?=$detect?'<header>':''; ?>
        <div class="to-top">
            <p class="text-center">
                <i class="fas fa-angle-up"></i>
            </p>
        </div>
        <?//=$chat; ?>
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

            <form role="form" method="POST" enctype="multipart/form-data">
                <input type="hidden" id="token" name="<?=$this->security->get_csrf_token_name(); ?>" value="<?=$this->security->get_csrf_hash(); ?>">
                <section class="profile-container">
                <?php
                    if(isset($_POST['edit']) && isset($_SESSION['uid']))
                        include "edit.php";
                ?>
                    <div class="left">
                        <p class="name-photo">
                            <span class="photo">
                            <script type="text/javascript">
                                function readURL(input) {
                                    if (input.files && input.files[0]) {
                                        var reader = new FileReader();

                                        reader.onload = function (e) {
                                            $('#blah').attr('src', e.target.result);
                                        }

                                        reader.readAsDataURL(input.files[0]);
                                    }
                                }
                            </script>
                            <img id="blah" src="<?php if(!empty($_SESSION['foto'])){echo $_SESSION['foto'];} else{echo '/Images/user-add.svg';} ?>" alt="">
                            <input type="file" name="fileToUpload" id="" hidden class="add-photo" onchange="readURL(this);">
                            <input type="hidden" name="cimage" id="<?=$info['image']; ?>" class="add-photo">

                        </span>
                        <span class="name">
                            <b><?=$info['first_name']." ".$info['last_name'] ?></b>
                        </span>
                    </p>
                    <nav>
                        <ul>
                            <ul>
                            <li <?php if(isset($_GET['p'])){echo'class="active"';  $b1="<b>"; $b2="</b>";} else{  $b1=""; $b2="";} ?>>
                                <a href="/pages/profile?p">
                                    <span class="icon">
                                        <img src="/Images/process.svg" alt="">
                                    </span>
                                    <span class="name"><?=$b1; ?>Profil Ayarları<?=$b2; ?></span>
                                </a>
                            </li>
                            <li <?php if(isset($_GET['m'])){echo'class="active"'; $b1="<b>"; $b2="</b>";} else{  $b1=""; $b2="";} ?>>
                                <a href="/myads.php?m">
                                    <span class="icon">
                                        <img src="/Images/edvertisement.svg" alt="">
                                    </span>
                                    <span class="name">
                                        <?=$b1; ?>Mənim Elanlarım<?=$b2; ?>
                                    </span>
                                </a>
                            </li>
                            <li <?php if(isset($_GET['c'])){echo'class="active"'; $b1="<b>"; $b2="</b>";} else{  $b1=""; $b2="";} ?>>
                                <a <?php if(!isset($_SESSION['uid'])){echo'class="nr"';} ?>  href="/pages/bartychat?c">
                                    <span class="icon">
                                        <img src="/Images/chat.svg" alt="">
                                    </span>
                                    <span class="name"><?=$b1 ?>BartiChat<?=$b2 ?></span>
                                </a>
                            </li>
                            <li <?php if(isset($_GET['f'])){echo'class="active"'; $b1="<b>"; $b2="</b>";} else{  $b1=""; $b2="";} ?>>
                                <a href="/pages/choosenads?f">
                                    <span class="icon">
                                        <img src="/Images/like-black.svg" alt="">
                                    </span>
                                    <span class="name"><?=$b1 ?>Seçilmiş Elanlar<?=$b2 ?></span>
                                </a>
                            </li>
                            <li>
                                <a href="/auth/logout">
                                    <span class="icon">
                                        <img src="/Images/exit.svg" alt="">
                                    </span>
                                    <span class="name">Çıxış</span>
                                </a>
                            </li>
                        </ul>
                    </nav>
                </div>
                <div class="right">

                        <div class="title">
                            <a href="/myads.php">
                                <i class="fas fa-times"></i>
                            </a>
                            <span class="mx-auto">
                                <b>Profili Redakte Edin</b>
                            </span>
                        </div>
                        <div class="profile">
                            <p class="profile-details">
                                <b>Profil Detalları</b>
                            </p>
                            <div class="d-flex name">
                                <label for="name" class="col-4">
                                    <b>Ad</b>
                                </label>
                                <p class="name-text"><?=$info['first_name']; ?></p>
                                <input type="text" value="<?=$info['first_name']; ?>" name="firstname" id="">
                            </div>
                            <div class="d-flex surname">
                                <label for="surname" class="col-4">
                                    <b>Soyad</b>
                                </label>
                                <p class="surname-text"><?=$info['last_name']; ?></p>
                                <input type="text"  value="<?=$info['last_name']; ?>" name="lastname" id="">
                            </div>
                            <div class="d-flex city">
                                <label for="city" class="col-7 col-md-4">
                                    <b>Şəhər</b>
                                </label>
                                <div class="select">
                                    <select name="city" id="">
                                        <option value="">Siyahıdan seçin</option>;
                                        <?php
                                            foreach ($info1 as $row) {
                                              echo '<option value="'.$row->id.'"';
                                              if ($info['city'] == $row->id)
                                                  echo 'selected';
                                              echo'>'.$row->ad.'</option>';
                                            }
                                        ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="contact">
                            <p class="contact-text">
                                <b>Əlaqə Məlumatları</b>
                            </p>
                            <div class="d-flex phone">
                                <label for="mobile" class="col-4">
                                    <b>Telefon</b>
                                </label>
                                <p class="phone-text"><?=$info['mobile']; ?></p>
                                <div class="phone-container">
                                    <input type="text" name="mobile" value="<?=$info['mobile']; ?>" placeholder="+994XXXXXX">
                                    <input type="hidden" name="cmobile" value="<?=$info['mobile']; ?>">
                                </div>
                            </div>
                            <div class="d-flex email">
                                <label for="email" class="col-4">
                                    <b>E-mail</b>
                                </label>
                                <p class="phone-text"><?=$info['email']; ?></p>
                                <input type="text" name="email" value="<?=$info['email']; ?>" placeholder="info@example.com">
                                <input type="hidden" name="cemail" value="<?=$info['email']; ?>">
                            </div>
                        </div>
                        <div class="social">
                            <p class="social-text">
                                <span>
                                    <b>Sosial Detallar</b>
                                </span>
                                <span class="ml-auto">
                                    <img src="/Images/previous-gray.svg" alt="">
                                </span>
                            </p>
                            <div class="social-container">
                                <div class="d-flex fb">
                                    <label for="fb" class="col-4">
                                        <img src="/Images/facebook.svg" alt="">
                                        <b>Facebook</b>
                                    </label>
                                    <input type="text" name="fb" value="<?=$info['fb']; ?>">
                                </div>
                                <div class="d-flex insta">
                                    <label for="insta" class="col-4">
                                        <img src="/Images/instagram.svg" alt="">
                                        <b>Instagram</b>
                                    </label>
                                    <input type="text" name="insta" value="<?=$info['insta']; ?>">
                                </div>
                                <div class="d-flex linkedin">
                                    <label for="linkedin" class="col-4">
                                        <img src="/Images/linkedin.svg" alt="">
                                        <b>Linkedin</b>
                                    </label>
                                    <input type="text" name="ldin" value="<?=$info['ldin']; ?>">
                                </div>
                            </div>
                        </div>
                        <div class="password">
                            <p class="password-text">
                                <span>
                                    <b>Şifrəni Dəyişin</b>
                                </span>
                                <span class="ml-auto">
                                    <img src="/Images/previous-gray.svg" alt="">
                                </span>
                            </p>
                            <div class="password-container">
                                <?php if(!isset($_SESSION['kod'])): ?>
                                    <div class="d-flex old-password">
                                        <label for="epasswd" class="col-4">
                                            <b>Mövcud Şifrə</b>
                                        </label>
                                        <input type="passwd" name="epasswd" id="" placeholder="**********">
                                    </div>
                                <?php endif; ?>
                                <div class="d-flex new-password">
                                    <label for="passwd" class="col-4">
                                        <b>Yeni Şifrə</b>
                                    </label>
                                    <input type="password" name="passwd" id="" placeholder="**********">
                                </div>
                                <div class="d-flex password-retry">
                                    <label for="cpasswd" class="col-4">
                                        <b>Şifrəni Təsdiq Edin</b>
                                    </label>
                                    <input type="password" name="cpasswd" id="" placeholder="**********">
                                </div>
                            </div>
                        </div>
                        <div class="col-6 submit">
                            <input type="submit" name="edit" value="Yaddaşda saxlayın">
                        </div>
                     </form>

                      <div class="other-sites">
                          <a href="/contact.php" class="site-ad">
                              <span>
                                  <b>Saytda Reklam</b>
                              </span>
                              <span class="ml-auto">
                                  <img src="/Images/previous-gray.svg" alt="">
                              </span>
                          </a>
                          <a href="/rules.php" class="site-ad">
                              <span>
                                  <b>Qaydalar</b>
                              </span>
                              <span class="ml-auto">
                                  <img src="/Images/previous-gray.svg" alt="">
                              </span>
                          </a>
                          <a href="/contact.php" class="site-ad">
                              <span>
                                  <b>Əlaqə</b>
                              </span>
                              <span class="ml-auto">
                                  <img src="/Images/previous-gray.svg" alt="">
                              </span>
                          </a>
                      </div>
                      <div class="d-md-none logout">
                          <p class="text-center">
                              <a href="/auth/logout">
                                  <b>Çıxış</b>
                              </a>
                          </p>
                      </div>
                  </form>
              </div>
          </section>
      </div>
  </main>

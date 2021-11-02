<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="/assets/dashboard/bootstrap.min.css">
    <link rel="stylesheet" href="/assets/dashboard/css/main.css">
    <script src="/assets/dashboard/jquery.min.js"></script>
    <script src="/assets/dashboard/popper.min.js" ></script>
    <script src="/assets/dashboard/bootstrap.min.js"></script>
    <script src="/assets/dashboard/js/main.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- <script src='https://kit.fontawesome.com/a076d05399.js'></script> -->
    <title>Author Menu</title>
  </head>
  <body>
    <div class="container-fluid">
      <div class="row">
<div class="menu">
          <div class="container d-flex">
              <div class="logo">
                  <a href="/">
                      <img src="/Images/logo.svg">
                  </a>
              </div>

              <form action="/pages/products" method="post" class="mx-auto">
                <input type="hidden" name="otomoto" value="78875240ddd6ca90cec1291eeb1390c1">
              <div class="search">
                  <input type="search" name="sorgu" placeholder="Barti'də Axtar" value="">
                  <select name="scat" class="cities">
                      <option value="">Bütün kateqoriyalar</option><option value="49">Nəqliyyat</option>                  </select>
                  <p class="text-center ml-auto">
                      <button type="submit"><img src="/Images/search.svg"></button>
                  </p>
              </div>
              </form>

              <div class="right text-center">
                  <div class="login">
                      <div class="login-container text-center">
                          <a href="#" class="a">
                              <img src="/Images/user-icon.svg" alt="">
                              <img src="/Images/user-red.svg" class="red" alt="">
                              <b>Giriş</b>                          </a>

                                                </div>
                      <div class="login-register" style="display: none;">
                          <div class="login-register-container">
                              <div class="buttons">
                                  <div class="login-btn">
                                      <a href="" class="login-text">
                                          <span>Giriş</span>
                                      </a>
                                  </div>
                                  <a href="" class="register-btn">
                                      <span>Qeydiyyat</span>
                                  </a>
                              </div>
                          </div>
                      </div>
                  </div>
                  <div class="modal login-modal"></div>
                  <div class="register-dropdown">
                      <ul class="nav nav-tabs" id="myTab" role="tablist">
                          <li class="nav-item">
                              <a class="nav-link active" id="login-tab" data-toggle="tab" href="#login" role="tab" aria-controls="login" aria-selected="true">
                                  <b>Giriş</b>
                              </a>
                          </li>
                          <li class="nav-item">
                              <a class="nav-link" id="register-tab" data-toggle="tab" href="#register" role="tab" aria-controls="register" aria-selected="false">
                                  <b>Qeydiyyat</b>
                              </a>
                          </li>
                      </ul>
                      <div class="tab-content" id="myTabContent">
                          <div class="tab-pane fade show active" id="login" role="tabpanel" aria-labelledby="login-tab">
                              <div class="fb-google">
                                  <div class="col-md-12 google">
                                      <a href="https://accounts.google.com/o/oauth2/auth?redirect_uri=https://new.otomoto.az/&amp;response_type=code&amp;client_id=137276581019-j835731t76o9bn6bb06furkvhv7s8rtk.apps.googleusercontent.com&amp;scope=https://www.googleapis.com/auth/userinfo.email https://www.googleapis.com/auth/userinfo.profile"><img src="/Images/Google-register.svg" alt=""></a>
                                  </div>
                              </div>
                              <form name="sform" method="post" class="login-form" action="/auth/login">
                                <input type="hidden" id="token" name="otomoto" value="78875240ddd6ca90cec1291eeb1390c1">
                                  <div class="name">
                                      <label for="email">Telefon və ya E-mail
                                          <span class="asteriks">*</span>
                                      </label>
                                      <input type="text" required="" name="email">
                                  </div>
                                  <div class="password">
                                      <label for="password">Şifrəniz
                                          <span class="asteriks">*</span>
                                      </label>
                                      <input type="password" required="" name="password">
                                      <a href="forgetpassword.php" class="forget">Şifrənizi unutmusunuz?</a>
                                  </div>
                                  <button type="submit" class="submit mx-auto col-6 ssubmit">Giriş</button>
                              </form>
                          </div>
                          <div class="tab-pane fade" id="register" role="tabpanel" aria-labelledby="register-tab">
                              <div class="fb-google">
                                  <div class="col-md-12 google">
                                      <a href="https://accounts.google.com/o/oauth2/auth?redirect_uri=https://new.otomoto.az/&amp;response_type=code&amp;client_id=137276581019-j835731t76o9bn6bb06furkvhv7s8rtk.apps.googleusercontent.com&amp;scope=https://www.googleapis.com/auth/userinfo.email https://www.googleapis.com/auth/userinfo.profile"><img src="/Images/Google-register.svg" alt=""></a>
                                  </div>
                              </div>

                              <form name="rform" method="post" class="register-form" id="rform" action="/auth/registration">
                                <input type="hidden" name="otomoto" value="78875240ddd6ca90cec1291eeb1390c1">
                                <div class="name">
                                    <label for="firstname">Adınız
                                        <span class="asteriks">*</span>
                                    </label>
                                    <input type="text" required="" name="firstname">
                                </div>
                                <div class="phone-email">
                                    <label for="email">E-mail
                                        <span class="asteriks">*</span>
                                    </label>
                                    <input type="text" required="" name="email">
                                </div>
                                <div class="phone-email">
                                    <label for="email">Telefon</label>
                                    <input type="text" required="" name="phone" class="phone_format">
                                </div>
                                <div class="password">
                                    <label for="passwd">Şifrəniz
                                        <span class="asteriks">*</span>
                                    </label>
                                    <input type="password" required="" name="passwd">
                                    <span class="eye">
                                        <svg aria-hidden="true" class="stUf5b" fill="currentColor" focusable="false" width="24px" height="24px" viewBox="0 0 24 24" xmlns="https://www.w3.org/2000/svg">
                                            <path d="M12,7c-2.48,0-4.5,2.02-4.5,4.5S9.52,16,12,16s4.5-2.02,4.5-4.5S14.48,7,12,7z M12,14.2c-1.49,0-2.7-1.21-2.7-2.7 c0-1.49,1.21-2.7,2.7-2.7s2.7,1.21,2.7,2.7C14.7,12.99,13.49,14.2,12,14.2z"></path>
                                            <path d="M12,4C7,4,2.73,7.11,1,11.5C2.73,15.89,7,19,12,19s9.27-3.11,11-7.5C21.27,7.11,17,4,12,4z M12,17 c-3.79,0-7.17-2.13-8.82-5.5C4.83,8.13,8.21,6,12,6s7.17,2.13,8.82,5.5C19.17,14.87,15.79,17,12,17z"></path>
                                        </svg>
                                    </span>
                                </div>
                                <div class="re-password">
                                    <label for="repasswd">Şifrənizi təsdiq edin
                                        <span class="asteriks">*</span>
                                    </label>
                                    <input type="password" required="" name="repasswd">
                                    <span class="eye">
                                        <svg aria-hidden="true" class="stUf5b" fill="currentColor" focusable="false" width="24px" height="24px" viewBox="0 0 24 24" xmlns="https://www.w3.org/2000/svg">
                                            <path d="M12,7c-2.48,0-4.5,2.02-4.5,4.5S9.52,16,12,16s4.5-2.02,4.5-4.5S14.48,7,12,7z M12,14.2c-1.49,0-2.7-1.21-2.7-2.7 c0-1.49,1.21-2.7,2.7-2.7s2.7,1.21,2.7,2.7C14.7,12.99,13.49,14.2,12,14.2z"></path>
                                            <path d="M12,4C7,4,2.73,7.11,1,11.5C2.73,15.89,7,19,12,19s9.27-3.11,11-7.5C21.27,7.11,17,4,12,4z M12,17 c-3.79,0-7.17-2.13-8.82-5.5C4.83,8.13,8.21,6,12,6s7.17,2.13,8.82,5.5C19.17,14.87,15.79,17,12,17z"></path>
                                        </svg>
                                    </span>
                                </div>
                                <button name="register" type="submit" class="submit mx-auto col-6 rsubmit">Qeydiyyat</button>
                              </form>
                          </div>
                      </div>
                  </div>
                  <p class="addAd">
                      <a href="addad.php?elan">Elan Yerləşdir</a>
                  </p>
              </div>
          </div>
      </div>

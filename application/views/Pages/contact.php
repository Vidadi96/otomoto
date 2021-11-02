<div class="my_container">
<div class="cont_left_side">
  <span class="cont_title">Sualınızı qeyd edin. Biz sizinlə əlaqə saxlayaq</span>
  <div class="left_left_block">
    <form class="" action="/pages/contact_with" method="post">
      <input type="hidden" name="<?=$this->security->get_csrf_token_name(); ?>" value="<?=$this->security->get_csrf_hash(); ?>">
      <input type="text" name="name" class="form-control cont_input cont_name" placeholder="Adınız" required>
      <input type="text" name="surname" class="form-control cont_input cont_surname" placeholder="Soyadınız" required>
      <input type="text" name="phone_mail" class="form-control cont_input" placeholder="Telefon və ya email" required>
      <select class="form-control cont_input" name="contact_type" required>
        <option value="" style="color: #b6b6b6">Müraciət növü</option>
        <option value="1">Təklif və iradlarınız</option>
        <option value="2">Karyera</option>
        <option value="3">Reklam</option>
      </select>
      <textarea name="text" class="form-control cont_textarea" placeholder="Məzmun" required></textarea>
      <button type="submit" class="btn btn-danger cont_button">Göndər</button>
    </form>
  </div>
  <div class="left_right_block">
    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3039.109026168851!2d49.811468814826995!3d40.384276179368925!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x40307d8e74fbd403%3A0x648475c3adfdf54b!2zNyBIyZlzyZluIE3JmWNpZG92IEvDvMOnyZlzaSwgQmFrxLEsINCQ0LfQtdGA0LHQsNC50LTQttCw0L0!5e0!3m2!1sru!2s!4v1613478414164!5m2!1sru!2s"
      width="100%"
      height="100%"
      frameborder="0"
      style="border:0;"
      allowfullscreen="true"
      aria-hidden="false"
      tabindex="0"
    ></iframe>
  </div>
</div>
<div class="cont_right_side">
  <div class="mini_block">
    <a href="tel:+994552667730" class="cont_a">
      <span class="cont_right_mini_text">
        <i class="fa fa-phone" aria-hidden="true"></i>
        (+994) 55 266 77 30
      </span>
    </a>
    <a href="mailto:support@otomoto.az" class="cont_a">
      <span class="cont_right_mini_text">
        <i class="fa fa-envelope" aria-hidden="true"></i>
        support@otomoto.az
      </span>
    </a>
    <span class="cont_right_mini_text">
      <i class="fa fa-map-marker" aria-hidden="true"></i>
      Yasamal , Hasan Məcidov 7
    </span>
  </div>
</div>
</div>

<input type="hidden" name="message" value="<?=$message; ?>">

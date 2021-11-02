<div style="margin-top:15px;" class="row">
  <div class="col-md-10 offset-md-1 new-car-wrapper-col">
    <div class="new-car-wrapper">
      <?php if ($this->session->userdata('autosalon')==0) { ?>
        <p> <a href="/dashboard"> <i class="fa fa-arrow-left" ></i> Mənim Elanlarım</a> </p>
        <p>Siz pulsuz elanların limiti keçmisiniz.</p>
        <p>Elanı yerləşdirmək üçün AvtoSalon kimi qeydiyyatdan keçin və ya <a href="/dashboard/main">İdarə panelindən</a> "Gold Paket" əldə edin.</p>
      <?php } else { ?>
        <p>Siz limiti keçmisiniz, zehmet olmasa balansınızı artırın. </p>
        <a href="/dashboard/main"> <button type="button" class="btn btn-success" name="button">Balansı artırmaq</button> </a>
      <?php } ?>
    </div>
  </div>
</div>

<style media="screen">
  body{
    min-height: inherit;
  }
  .main_rp{
    position: relative;
    float: left;
    width: 100%;
    min-height: calc(100% - 314px);
  }
  .title_pr{
    position: relative;
    float: left;
    width: 100%;
    font-size: 18px;
    font-weight: 500;
    padding-bottom: 10px;
  }

  @media screen and (max-width: 768px){
    .main_rp{
      min-height: inherit;
    }
  }
</style>

<section class="main_rp">
  <span class="title_pr">Yeni şifrəni daxil edin:</span>
  <form action="/pages/recovery_pass_do" method="post">
    <input type="hidden" name="<?=$this->security->get_csrf_token_name(); ?>" value="<?=$this->security->get_csrf_hash(); ?>">
    <input type="hidden" name="email" value="<?=$mail; ?>">
    <input type="hidden" name="recovery_token" value="<?=$token; ?>">
    <div class="row">
      <div class="col-md-3 col-sm-4">
        <input type="password" name="password" class="form-control" placeholder="Yeni şifrə..." required>
      </div>
      <div class="col-md-3 col-sm-4">
        <input type="password" name="repeat_password" class="form-control" placeholder="Şifrəni təkrarla..." required>
      </div>
      <div class="col-md-3 col-sm-4 col-4">
        <button type="submit" class="btn btn-primary">
          <i class="fa fa-save" aria-hidden="true"></i>
          Dəyiş
        </button>
      </div>
    </div>
  </form>
</section>

<input type="hidden" name="error_msg" value="<?=$error_msg; ?>">

<script type="text/javascript">

  $(document).ready(function() {
    let error_msg = $('input[name="error_msg"]').val();

    if (error_msg) {
      if (error_msg == 1)
        toastr.error('Şifrə ən az 6 simvoldan ibarət olmalıdır', "Xəta");
      else if (error_msg == 2)
        toastr.error('Şifrəni təkrarla sahəsi şifrə ilə uyğun deyil', "Xəta");
      else if (error_msg == 3)
        toastr.error('Xəta baş verdi. Xaiş olunur yenidən cəhd edəsiniz', "Xəta");
    }
  });

</script>

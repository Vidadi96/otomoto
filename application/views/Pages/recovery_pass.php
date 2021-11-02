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
  <span class="title_pr">E-poçtunuzu daxil edin:</span>
  <form action="/pages/recovery_pass_send" method="post">
    <input type="hidden" name="<?=$this->security->get_csrf_token_name(); ?>" value="<?=$this->security->get_csrf_hash(); ?>">
    <div class="row">
      <div class="col-md-3 col-sm-6 col-8">
        <input type="text" name="email" class="form-control" placeholder="E-poçt...">
      </div>
      <div class="col-md-3 col-sm-6 col-4">
        <button type="submit" class="btn btn-primary">Göndər</button>
      </div>
    </div>
  </form>
</section>

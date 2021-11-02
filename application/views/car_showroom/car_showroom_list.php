<div class="my_container">
  <div class="row">
    <div class="col-md-4 offset-md-8">
      <form action="/car_showroom" method="get">
        <input type="hidden" name="<?=$this->security->get_csrf_token_name(); ?>" value="<?=$this->security->get_csrf_hash(); ?>">

        <select class="form-control" name="autosalon_type" onchange="this.form.submit()">
          <option value="1" <?=$type==1?'selected':''; ?>>Avtosalonlar</option>
          <option value="2" <?=$type==2?'selected':''; ?>>Rent a car</option>
        </select>
      </form>
    </div>
  </div>
  <div class="row">
    <?php foreach ($car_showroom_list as $row): ?>
      <div class="col-sm-12 col-md-6">
        <a href="/car_showroom/<?=$type==1?'car_showroom':'rent_car_showroom'; ?>/<?=$row->id; ?>">
          <div class="salon_container">
            <img src="/assets/img/car_photos/logo/<?=$row->logo?$row->logo:'nophoto.png'; ?>">
            <?php if($row->resmi): ?>
              <span class="resmi">Rəsmi</span>
            <?php endif; ?>
            <div class="right_side">
              <span class="salon_line salon_name"><?=$row->shirketad; ?></span>
              <span class="salon_line salon_description"><?=$row->etraflimelumat; ?></span>
              <span class="salon_line salon_mobile">
                <i class="fa fa-phone" aria-hidden="true"></i>
                <?=$row->mobile; ?>
              </span>
              <span class="salon_line salon_car_count">
                <?=$row->car_count?$row->car_count:0; ?> elan
              </span>
            </div>
          </div>
        </a>
      </div>
    <?php endforeach; ?>
  </div>
</div>

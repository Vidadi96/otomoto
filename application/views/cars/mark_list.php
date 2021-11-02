<div class="m-subheader ">
	<div class="d-flex align-items-center">
		<div class="mr-auto">
			<ul class="m-subheader__breadcrumbs m-nav m-nav--inline">
				<li class="m-nav__item m-nav__item--home">
					<a href="/slides/get_view_main/" class="m-nav__link m-nav__link--icon">
						<i class="m-nav__link-icon la la-home"></i>
					</a>
				</li>
			</ul>
			<h3 class="m-subheader__title m-subheader__title--separator">
				<?=$page_title; ?>
			</h3>
		</div>
	</div>
</div>
<!-- END: Subheader -->
	<div class="m-content">
		<div class="row">
			<div class="col-lg-12">
        <?php if(isset($status)): ?>
				<div class="m-alert m-alert--icon m-alert--outline alert alert-<?=$status['status'];?> alert-dismissible fade show" role="alert">
					<div class="m-alert__icon">
						<i class="fa fa-<?=$status['icon'];?>"></i>
					</div>
					<div class="m-alert__text">
						<strong><?=$status['title'];?> </strong> <?=$status['msg'];?>
					</div>
					<div class="m-alert__close">
						<button type="button" class="close" data-dismiss="alert" aria-label="Close"></button>
					</div>
				</div>
				<?php endif;?>
				<!--begin::Portlet-->
				<div class="m-portlet m-portlet--head-solid-bg m-portlet--head-sm" m-portlet="true" id="m_portlet_tools_2">
					<div class="m-portlet__head">
						<div class="m-portlet__head-caption">
							<div class="m-portlet__head-title">
								<span class="m-portlet__head-icon m--hide">
									<i class="la la-gear"></i>
								</span>
								<h3 class="m-portlet__head-text">
									Yeni marka
								</h3>
							</div>
						</div>
					</div>
					<div class="m-portlet__body">
						<div class="m-section">
							<div class="m-section__content">

                <form action="/cars/add_mark" method="post" enctype="multipart/form-data">
                  <input type="hidden" id="token" name="<?=$this->security->get_csrf_token_name(); ?>" value="<?=$this->security->get_csrf_hash(); ?>">

                  <div class="form-group m-form__group row">
                    <div class="col-lg-4">
                      <div class="form-group">
                        <label for="mark_photo">Foto</label>
                        <input type="file" id="mark_photo" name="mark_photo" class="form-control m-input" placeholder="" required>
                      </div>
                    </div>

                    <div class="col-lg-4">
                      <div class="form-group">
                        <label for="mark">Marka</label>
                        <input type="text" id="mark" name="mark" class="form-control m-input" placeholder="" required>
                      </div>
                    </div>

                    <div class="col-lg-4">
                      <label>Popular marka</label>
    									<div class="m-radio-inline">
    										<label class="m-radio m-radio--solid">
    											<input type="radio" name="popular" checked="" value="1">
    											Hə
    											<span></span>
    										</label>
    										<label class="m-radio m-radio--solid">
    											<input type="radio" name="popular" value="0">
    											Yox
    											<span></span>
    										</label>
    									</div>
                    </div>

                  </div>

                  <div class="col-lg-12 m--align-left">
                    <button type="submit_ru" class="btn btn-success"><i class="fa fa-plus"></i> Əlavə et</button>
                  </div>

                </form>

							</div>
						</div>

					</div>
				</div>

        <div class="m-portlet m-portlet--accent m-portlet--head-solid-bg m-portlet--head-sm" m-portlet="true" id="m_portlet_tools_2">
          <div class="m-portlet__head">
            <div class="m-portlet__head-caption">
              <div class="m-portlet__head-title">
                <span class="m-portlet__head-icon m--hide">
                  <i class="la la-gear"></i>
                </span>
                <h3 class="m-portlet__head-text">
                  Markalar siyahısı
                </h3>
              </div>
            </div>
          </div>
          <div class="m-portlet__body">
            <table delete_url="/cars/delete_mark/" class="table table-bordered m-table">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Foto</th>
                  <th>Marka</th>
                  <th>Popular</th>
                  <th>Aktiv/passiv</th>
                  <th>Sil</th>
                </tr>
              </thead>
              <tbody>
                <?php $i = $from;
                  foreach ($mark_list as $row):
                    $i++;

                    $word="Passiv et!"; $class="btn-success";
                    $active_passive = 0;
                    if(!$row->active)
                    {
                      $word="Aktiv et!";
                      $class="btn-danger";
                      $active_passive = 1;
                    }
                    $btn_active_passive ='<button name="'.$row->id.'" active_passive="'.$active_passive.'" type="button" data-container="body" data-skin="dark" data-toggle="m-popover" data-placement="right" data-content="'.$word.'" class="'.$class.' my_active_action btn m-btn m-btn--icon btn-sm m-btn--icon-only m-btn--pill m-btn--air"></button>';

                    $word2 = "Populardan sil!"; $class2="btn-success";
                    $popular = 0;
                    if(!$row->popular)
                    {
                      $word2 = "Popular et!";
                      $class2="btn-danger";
                      $popular = 1;
                    }
                    $btn_popular ='<button name="'.$row->id.'" active_passive="'.$popular.'" type="button" data-container="body" data-skin="dark" data-toggle="m-popover" data-placement="right" data-content="'.$word2.'" class="'.$class2.' my_popular_action btn m-btn m-btn--icon btn-sm m-btn--icon-only m-btn--pill m-btn--air"></button>';
                    ?>
                  <tr>
                    <td><?=$i; ?></td>
                    <td>
                      <img src="/assets/img/car_marks/small/<?=$row->img; ?>" style="width: 30px;">
                    </td>
                    <td><?=$row->mark; ?></td>
                    <td><?=$btn_popular; ?></td>
                    <td><?=$btn_active_passive; ?></td>
                    <td>
                      <button
                        class="btn btn-danger btn-sm m-btn m-btn--icon m-btn--icon-only delete"
                        rel="<?=$row->id; ?>"
                      >
  											<i class="fa fa-trash"></i>
  										</button>
                    </td>
                  </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
          </div>
        </div>

        <div class="text-center">
					 <ul class="pagination pagination-lg text-center" style="display: inline-flex;">
							<?=@$pagination; ?>
					 </ul>
				</div>
			</div>
		</div>
	</div>


<script type="text/javascript">

var token = $('#token').val();

$(document).on('click', '.my_active_action', function(){
  var mark_id = $(this).attr('name');
  var active_passive = $(this).attr('active_passive');
  var thiss = $(this);

  $.ajax({
    type: "POST",
    url: "/cars/active_passive_mark",
    data: {otomoto: token, id: mark_id, active_passive: active_passive},
    success: function(data)
    {
      var res = $.parseJSON(data);
      token = res.otomoto;
      $('#token').val(res.otomoto);

      if (active_passive == 1)
        thiss.attr('data-content', 'Passiv et!').removeClass('btn-danger').addClass('btn-success').attr('active_passive', 0);
      else
        thiss.attr('data-content', 'Aktiv et!').removeClass('btn-success').addClass('btn-danger').attr('active_passive', 1);

      if(res.status == 'success')
        toastr.success("Uğurla dəyişdirildi", 'Uğur');
      else
        toastr.error("Xəta baş verdi", "Xəta");
    }
  });
});

$(document).on('click', '.my_popular_action', function(){
  var mark_id = $(this).attr('name');
  var active_passive = $(this).attr('active_passive');
  var thiss = $(this);

  $.ajax({
    type: "POST",
    url: "/cars/change_popular_mark",
    data: {otomoto: token, id: mark_id, active_passive: active_passive},
    success: function(data)
    {
      var res = $.parseJSON(data);
      token = res.otomoto;
      $('#token').val(res.otomoto);

      if (active_passive == 1)
        thiss.attr('data-content', 'Populardan sil!').removeClass('btn-danger').addClass('btn-success').attr('active_passive', 0);
      else
        thiss.attr('data-content', 'Popular et!').removeClass('btn-success').addClass('btn-danger').attr('active_passive', 1);

      if(res.status == 'success')
        toastr.success("Uğurla dəyişdirildi", 'Uğur');
      else
        toastr.error("Xəta baş verdi", "Xəta");
    }
  });
});

</script>

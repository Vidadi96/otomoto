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
									Yeni şəhər
								</h3>
							</div>
						</div>
					</div>
					<div class="m-portlet__body">
						<div class="m-section">
							<div class="m-section__content">

                <form action="/cars/add_city" method="post">
                  <input type="hidden" id="token" name="<?=$this->security->get_csrf_token_name(); ?>" value="<?=$this->security->get_csrf_hash(); ?>">

                  <div class="form-group m-form__group row">

                    <div class="col-lg-4">
                      <div class="form-group">
                        <label for="city">Şəhər</label>
                        <input type="text" id="city" name="city" class="form-control m-input" required>
                      </div>
                    </div>

                    <div class="col-lg-4">
                      <label>&nbsp;</label>
										  <br>
                      <button type="submit" class="btn btn-success">
                        <i class="fa fa-plus"></i>
                        Əlavə et
                      </button>
                    </div>
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
                  Şəhərlər
                </h3>
              </div>
            </div>
          </div>
          <div class="m-portlet__body">
            <table delete_url="/cars/delete_city/" class="table table-bordered m-table"  active_passive_url="/cars/active_passive_city/">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Şəhər</th>
                  <th>Aktiv/passiv</th>
                  <th>Sil</th>
                </tr>
              </thead>
              <tbody>
                <?php $i = $from;
                  foreach ($cities as $row):
                    $i++;

                    $word="Passiv et!"; $class="btn-success";
                    $active_passive = 0;
                    if(!$row->active)
                    {
                      $word="Aktiv et!";
                      $class="btn-danger";
                      $active_passive = 1;
                    }
                    $btn_active_passive ='<button id="'.$row->id.'" active_passive="'.$active_passive.'" type="button" data-container="body" data-skin="dark" data-toggle="m-popover" data-placement="right" data-content="'.$word.'" class="'.$class.' set_active_passive btn m-btn m-btn--icon btn-sm m-btn--icon-only m-btn--pill m-btn--air"></button>';
                    ?>
                  <tr>
                    <td><?=$i; ?></td>
                    <td><?=$row->ad; ?></td>
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

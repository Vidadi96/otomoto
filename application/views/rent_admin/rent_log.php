<!-- BEGIN: Subheader -->
<div class="m-subheader ">
	<div class="d-flex align-items-center">
		<div class="mr-auto">
			<ul class="m-subheader__breadcrumbs m-nav m-nav--inline">
				<li class="m-nav__item m-nav__item--home">
					<a href="/adm/index/" class="m-nav__link m-nav__link--icon">
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
				<!--begin::Portlet-->
				<div class="m-portlet m-portlet--head-solid-bg m-portlet--head-sm" m-portlet="true" id="m_portlet_tools_2">
					<div class="m-portlet__head">
						<div class="m-portlet__head-caption">
							<div class="m-portlet__head-title">
								<span class="m-portlet__head-icon m--hide">
									<i class="la la-gear"></i>
								</span>
								<h3 class="m-portlet__head-text">
									Siyahı
								</h3>
							</div>
						</div>
						<div class="m-portlet__head-tools">
							<ul class="m-portlet__nav">
								<li class="m-portlet__nav-item">
									<a href="#"  m-portlet-tool="toggle" class="m-portlet__nav-link m-portlet__nav-link--icon">
										<i class="la la-angle-down"></i>
									</a>
								</li>
								<li class="m-portlet__nav-item">
									<a href="#"  m-portlet-tool="fullscreen" class="m-portlet__nav-link m-portlet__nav-link--icon">
										<i class="la la-expand"></i>
									</a>
								</li>

							</ul>
						</div>
					</div>
					<div class="m-portlet__body">
						<div class="m-section">
							<div class="m-section__content">

								<!--begin: Search Form -->
								<form action="/rent_admin/rent_log" method="GET">
                  <input type="hidden" id="token" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
									<div class="form-group m-form__group row">
										<div class="col-lg-3">
                      <label for="rent_car_id">Elanın nömrəsi</label>
                      <input type="text" id="rent_car_id" name="rent_car_id" value="<?=$rent_car_id?$rent_car_id:''; ?>" class="form-control">
										</div>
										<div class="col-md-3">
											<label>&nbsp;</label><br />
											<button type="submit" class="btn btn-primary"><i class="la la-search"></i> Axtar (<?=@$total_row; ?></i>)</button>
										</div>
									</div>

								</form>
								<!--end: Search Form -->


    						<div class="row">
    							<div class="col-xl-12">
    								<table delete_url="/rent_admin/delete_car/" class="table table-bordered m-table">
    									<thead>
    										<tr>
    											<th>Şəkil</th>
    											<th>Model</th>
                          <th>Sifarişçinin adı</th>
    											<th>Nömrəsi</th>
                          <th>Tarix</th>
    										</tr>
    									</thead>
    									<tbody>
    										<?php if(isset($log_list)):
                          foreach ($log_list as $row):?>
    											  <tr>
                              <td>
                                <img src="<?=($row->image)?'/assets/img/rent_car_photos/90x90/'.$row->image:''; ?>" width="50" height="50">
                              </td>
                              <td><?=$row->mark.' '.$row->model; ?></td>
                              <td><?=$row->name; ?></td>
                              <td><?=$row->mobile; ?></td>
                              <td><?=$row->create_date; ?></td>
                            </tr>
    										  <?php endforeach;
                        endif; ?>

    									</tbody>
    								</table>
    							</div>
    						</div>

							</div>
						</div>
					</div>
				</div>
				<!--end::Portlet-->
				<div class="text-center">
					 <ul class="pagination pagination-lg text-center" style="display: inline-flex;">
							<?=@$pagination; ?>
					 </ul>
				</div>
			</div>
		</div>
	</div>

<script src="/assets/demo/default/custom/components/portlets/tools.js" type="text/javascript"></script>

<style media="screen">
  .edit_open{
    display: none;
  }
	.reject_reason_div{
		display: none;
	}
</style>

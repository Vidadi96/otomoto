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
									Axtar
								</h3>
							</div>
						</div>
					</div>
					<div class="m-portlet__body">
						<div class="m-section">
							<div class="m-section__content">

                <form action="/users/add_user" method="get">
                  <input type="hidden" id="token" name="<?=$this->security->get_csrf_token_name(); ?>" value="<?=$this->security->get_csrf_hash(); ?>">

                  <div class="form-group m-form__group row">
                    <div class="col-lg-3">
											<label for="name">Adı</label>
											<input type="text" name="name" id="name" class="form-control" value="<?=$name; ?>">
										</div>

                    <div class="col-lg-3">
											<label for="mail">Elektron poçt</label>
											<input type="text" name="mail" id="mail" class="form-control"  value="<?=$mail; ?>">
										</div>

                    <div class="col-lg-3">
											<label for="phone">Telefon</label>
											<input type="text" name="phone" id="phone" class="form-control" value="<?=$phone; ?>">
										</div>

										<div class="col-lg-3">
                      <label>İstifadəçi növü</label>
    									<select class="form-control" name="user_type">
    										<option value=""></option>
												<option <?=($user_type == 2)?'selected':''; ?> value="2">Adi</option>
												<option <?=($user_type == 1)?'selected':''; ?> value="1">Avtosalon</option>
    									</select>
                    </div>

                  </div>

                  <div class="col-lg-12 m--align-left">
                    <button type="submit_ru" class="btn btn-success"><i class="fa fa-search"></i> Axtar</button>
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
                  İstifadəçilər siyahısı
                </h3>
              </div>
            </div>
          </div>
          <div class="m-portlet__body">
            <table
							delete_url="/users/delete_user/"
							class="table table-bordered m-table"
							active_passive_url="/users/active_passive_autosalon/"
							active_passive_url2="/users/active_passive_resmi/"
							active_passive_url3="/users/active_passive_unlimited/"
						>
              <thead>
                <tr>
                  <th>#</th>
                  <th style="width: 9%;">Adı</th>
                  <th style="width: 20%;">Elektron poçt</th>
                  <th>Telefon</th>
									<th>Balans</th>
									<th>Balansı artır</th>
									<th>Şifrəni dəyiş</th>
									<th>Salon</th>
									<th>Rəsmi</th>
									<th>Limitsiz</th>
                  <th>Sil</th>
                </tr>
              </thead>
              <tbody>
                <?php $i = $from;
                  foreach ($user_list as $row):
                    $i++;

                    $word="Passiv et!"; $class="btn-success";
                    $active_passive = 0;
                    if(!$row->autosalon)
                    {
                      $word="Aktiv et!";
                      $class="btn-danger";
                      $active_passive = 1;
                    }
                    $btn_active_passive ='<button id="'.$row->id.'" style="margin-top: 6px" active_passive="'.$active_passive.'" type="button" data-container="body" data-skin="dark" data-toggle="m-popover" data-placement="right" data-content="'.$word.'" class="'.$class.' set_active_passive btn m-btn m-btn--icon btn-sm m-btn--icon-only m-btn--pill m-btn--air"></button>';

										$word2 = "Passiv et!"; $class2 = "btn-success";
                    $active_passive2 = 0;
                    if(!$row->resmi)
                    {
                      $word2 = "Aktiv et!";
                      $class2 = "btn-danger";
                      $active_passive2 = 1;
                    }
                    $btn_active_passive2 ='<button id="'.$row->id.'" style="margin-top: 6px" active_passive="'.$active_passive2.'" type="button" data-container="body" data-skin="dark" data-toggle="m-popover" data-placement="right" data-content="'.$word2.'" class="'.$class2.' set_active_passive2 btn m-btn m-btn--icon btn-sm m-btn--icon-only m-btn--pill m-btn--air"></button>';

										$word3 = "Passiv et!"; $class3 = "btn-success";
                    $active_passive3 = 0;
                    if(!$row->unlimited)
                    {
                      $word3 = "Aktiv et!";
                      $class3 = "btn-danger";
                      $active_passive3 = 1;
                    }
                    $btn_active_passive3 ='<button id="'.$row->id.'" style="margin-top: 6px" active_passive="'.$active_passive3.'" type="button" data-container="body" data-skin="dark" data-toggle="m-popover" data-placement="right" data-content="'.$word3.'" class="'.$class3.' set_active_passive3 btn m-btn m-btn--icon btn-sm m-btn--icon-only m-btn--pill m-btn--air"></button>';
                    ?>
                  <tr>
                    <td><?=$i; ?></td>
                    <td><?=$row->first_name; ?></td>
                    <td>
											<span style="position: absolute;
																	 text-overflow: ellipsis;
															     white-space: nowrap;
															     overflow: hidden;
															     width: 17%;"
											>
												<?=$row->email; ?>
											</span>
										</td>
										<td><?=$row->mobile; ?></td>
										<td class="balance"><?=$row->balans; ?></td>
										<td>
											<div class="row">
												<div class="col-md-9">
													<input type="number" name="add_balance" class="form-control" />
												</div>
												<div class="col-md-3">
													<button
														type="button"
														title="artır"
														style="margin-top: 6px"
														class="btn btn-success btn-sm m-btn m-btn--icon m-btn--icon-only add_balance"
														name="<?=$row->id; ?>"
														salon="<?=$row->autosalon; ?>"
													>
														<i class="fa fa-plus" aria-hidden="true"></i>
													</button>
												</div>
											</div>
										</td>
										<td>
											<div class="row">
												<div class="col-md-9">
													<input type="password" name="cng_pass" class="form-control" />
												</div>
												<div class="col-md-3">
													<button
														type="button"
														title="Dəyiş"
														style="margin-top: 6px"
														class="btn btn-primary btn-sm m-btn m-btn--icon m-btn--icon-only cng_pass"
														name="<?=$row->id; ?>"
													>
														<i class="fa fa-save" aria-hidden="true"></i>
													</button>
												</div>
											</div>
										</td>
                    <td><?=$btn_active_passive; ?></td>
										<td><?=$btn_active_passive2; ?></td>
										<td><?=$btn_active_passive3; ?></td>
                    <td>
                      <button
											 	style="margin-top: 6px"
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

$('.add_balance').click(function(){
	var quantity = $(this).closest('td').find('input[name="add_balance"]').val();
	var user_id = $(this).attr('name');
	var salon = $(this).attr('salon');
	var thiss = $(this);

	if (quantity && quantity > 0) {
		if(confirm('Balansı artırmaq istədiyinizə əminsiniz?')) {
			$.ajax({
				url: '/users/add_balance',
				type: 'POST',
				data: {otomoto: token, user_id: user_id, quantity: quantity, salon: salon},
				success: function(res){
					if (res) {
						thiss.closest('tr').find('.balance').text(parseFloat(thiss.closest('tr').find('.balance').text()) + parseFloat(quantity));
						thiss.closest('tr').find('input[name="add_balance"]').val('');
						toastr.success('Uğurla artırıldı', 'Uğur');
					} else {
						toastr.error('Xəta baş verdi. Xaiş edirik yenidən cəhd edəsiniz', 'Xəta');
					}
				}
			});
		}
	} else {
		toastr.info('Qiymət daxil edin!', 'Bildiriş');
	}

})

$('.cng_pass').click(function(){
	var password = $(this).closest('td').find('input[name="cng_pass"]').val();
	var user_id = $(this).attr('name');
	var thiss = $(this);

	if (password && password.length > 5) {
		if(confirm('Şifrəni dəyişmək istədiyinizə əminsiniz?')) {
			$.ajax({
				url: '/users/cng_pass',
				type: 'POST',
				data: {otomoto: token, user_id: user_id, password: password},
				success: function(res){
					if (res) {
						thiss.closest('tr').find('input[name="cng_pass"]').val('');
						toastr.success('Uğurla dəyişdirildi', 'Uğur');
					} else {
						toastr.error('Xəta baş verdi. Xaiş edirik yenidən cəhd edəsiniz', 'Xəta');
					}
				}
			});
		}
	} else {
		toastr.info('Şifrənin uzunluğu ən azı 6 simvoldan ibarət olmalıdır!', 'Bildiriş');
	}
});

</script>

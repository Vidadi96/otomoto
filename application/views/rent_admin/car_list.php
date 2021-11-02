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
		<a class="btn btn-success pull-right" href="/rent_admin/add_car/"><i class="fa fa-plus"></i>Yeni elan</a>
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
								<form action="" method="GET">
                  <input type="hidden" id="token" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
									<div class="form-group m-form__group row">
                    <div class="col-lg-3">
											<label for="author_search">Elanı verən</label>
											<input list="author_search" class="form-control" value="<?=($author_id)?$author_id[0]->first_name.' - '.$author_id[0]->mobile:''; ?>">
											<datalist id="author_search">
                        <?php foreach($user_list as $row): ?>
													<option data-value="<?=$row->id; ?>" value="<?=$row->first_name.' - '.$row->mobile; ?>">
                        <?php endforeach; ?>
											</datalist>
											<input type="hidden" name="author_id" value="<?=$author_id?$author_id[0]->id:''; ?>" required>
										</div>
										<div class="col-lg-3">
                      <label for="status">Elanın statusu</label>
                      <select id="status" name="status" class="form-control">
                        <option value=""></option>
                        <option <?=($status == 5)?'selected':''; ?> value="5">Gözləmədə</option>
                        <option <?=($status == 1)?'selected':''; ?> value="1">Aktiv</option>
                        <option <?=($status == 2)?'selected':''; ?> value="2">Deaktiv</option>
                        <option <?=($status == 3)?'selected':''; ?> value="3">İmtina edilmiş</option>
                        <option <?=($status == 4)?'selected':''; ?> value="4">Silinmiş</option>
                      </select>
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
                          <th>Elanı paylaşan</th>
    											<th>Qiymət</th>
													<th>Top</th>
													<th>Vip</th>
    											<th>Status</th>
    											<th>Elana bax</th>
                          <th>Redaktə et</th>
													<th>Birdəfəlik sil</th>
    										</tr>
    									</thead>
    									<tbody>
    										<?php if(isset($car_list)):
                          foreach ($car_list as $row):?>
    											  <tr>
                              <td>
                                <img src="<?=($row->image)?'/assets/img/rent_car_photos/90x90/'.$row->image:''; ?>" width="50" height="50">
                              </td>
                              <td><?=$row->mark.' '.$row->model; ?></td>
                              <td><?=$row->user; ?></td>
                              <td>
																<?php echo $row->price;
                                  switch ($row->currency) {
                                    case '0':
                                      echo " AZN";
                                      break;
                                    case '1':
                                      echo " USD";
                                      break;
                                    case '2':
                                      echo " EUR";
                                      break;
                                    default:
                                      echo " AZN";
                            			}
																?>
															</td>
															<td>
                                <span name="edit_vip_span" class="edit_close">
                                  <?php
																		if ($row->vip) {
																			if ($row->vip_type == 1)
																				echo 'Top (1 gün)';
																			else if ($row->vip_type == 5)
																				echo 'Top (5 gün)';
																			else if ($row->vip_type == 15)
																				echo 'Top (15 gün)';
																			else if ($row->vip_type == 30)
																				echo 'Top (30 gün)';
																		}	else
																			echo 'Sadə';
																	?>
                                </span>
                                <select name="edit_vip" class="edit_open form-control">
                                  <option <?=($row->vip == 0)?'selected':''; ?> value="0">Sadə</option>
                                  <option <?=($row->vip && $row->vip_type == 1)?'selected':''; ?> value="1">Top (1 gün)</option>
																	<option <?=($row->vip && $row->vip_type == 5)?'selected':''; ?> value="5">Top (5 gün)</option>
																	<option <?=($row->vip && $row->vip_type == 15)?'selected':''; ?> value="15">Top (15 gün)</option>
																	<option <?=($row->vip && $row->vip_type == 30)?'selected':''; ?> value="30">Top (30 gün)</option>
                                </select>
                              </td>
															<td>
                                <span name="edit_premium_span" class="edit_close">
																	<?php
																		if ($row->premium) {
																			if ($row->premium_type == 1)
																				echo 'Vip (1 gün)';
																			else if ($row->premium_type == 5)
																				echo 'Vip (5 gün)';
																			else if ($row->premium_type == 15)
																				echo 'Vip (15 gün)';
																			else if ($row->premium_type == 30)
																				echo 'Vip (30 gün)';
																		}	else
																			echo 'Sadə';
																	?>
                                </span>
                                <select name="edit_premium" class="edit_open form-control">
                                  <option <?=($row->premium == 0)?'selected':''; ?> value="0">Sadə</option>
																	<option <?=($row->premium && $row->premium_type == 1)?'selected':''; ?> value="1">Vip (1 gün)</option>
																	<option <?=($row->premium && $row->premium_type == 5)?'selected':''; ?> value="5">Vip (5 gün)</option>
																	<option <?=($row->premium && $row->premium_type == 15)?'selected':''; ?> value="15">Vip (15 gün)</option>
																	<option <?=($row->premium && $row->premium_type == 30)?'selected':''; ?> value="30">Vip (30 gün)</option>
                                </select>
                              </td>
                              <td>
                                <span name="edit_status_span" class="edit_close">
                                  <?php
                                    switch ($row->status) {
                                      case "0":
                                        echo "Gözləmədə";
                                        break;
                                      case "1":
                                        echo "Aktiv";
                                        break;
                                      case "2":
                                        echo "Deaktiv";
                                        break;
                                      case "3":
                                        echo "İmtina edilmiş";
                                        break;
                                      case "4":
                                        echo "Silinmiş";
                                        break;
                                      default:
                                        echo "Gözləmədə";
                                    }
                                  ?>
                                </span>
                                <select name="edit_status" class="edit_open form-control">
                                  <option <?=($row->status == 0)?'selected':''; ?> value="0">Gözləmədə</option>
                                  <option <?=($row->status == 1)?'selected':''; ?> value="1">Aktiv</option>
                                  <option <?=($row->status == 2)?'selected':''; ?> value="2">Deaktiv</option>
                                  <option <?=($row->status == 3)?'selected':''; ?> value="3">İmtina edilmiş</option>
                                  <option <?=($row->status == 4)?'selected':''; ?> value="4">Silinmiş</option>
                                </select>
																<div class="reject_reason_div" data="reject_<?=$row->status; ?>">
																	<br>
																	<label>Imtina səbəbi</label>
																	<textarea name="reject_reason" class="form-control"><?=$row->reject_reason; ?></textarea>
																</div>
                              </td>
                              <td>
                                <a href="/rent_admin/edit_car/<?=$row->id; ?>" target="_blank" class="btn btn-info btn-sm m-btn m-btn--icon m-btn--icon-only">
                                  <i class="fa fa-eye" aria-hidden="true"></i>
                                </a>
                              </td>
                              <td>
                                <button name="<?=$row->id; ?>" class="edit btn btn-primary btn-sm m-btn m-btn--icon m-btn--icon-only">
      														<i class="fa fa-pencil-alt"></i>
      													</button>
                              </td>
															<td>
					                      <button
					                        class="btn btn-danger btn-sm m-btn m-btn--icon m-btn--icon-only delete"
					                        rel="<?=$row->id; ?>"
																	<?=($row->status != 3 && $row->status!=4)?'disabled':''; ?>
					                      >
					  											<i class="fa fa-trash"></i>
					  										</button>
					                    </td>
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

<script type="text/javascript">

    var token = $('#token').val();

    $(document).on('input', 'input[list="author_search"]', function(){
    	$('input[name="author_id"]').val('');

    	var input = $(this).val();
    	$('datalist option').each(function(i) {
    		if($(this).val() == input) {
    			var author_id = $(this).attr('data-value');
    			$('input[name="author_id"]').val(author_id);
    		}
    	});
    });

		/*----- REJECT REASON -----*/

		$(document).on('change', 'select[name="edit_status"]', function(){
		  if ($(this).val() == 3) {
				$(this).closest('td').find('.reject_reason_div').attr('data', 'reject_3');
				$(this).closest('td').find('.reject_reason_div').slideDown(200);
			} else {
				$(this).closest('td').find('.reject_reason_div').attr('data', 'reject');
				$(this).closest('td').find('.reject_reason_div').slideUp(100);
			}
		});

    /*------ EDIT FUNCITON ------*/

    $(document).on('click', '.edit', function(){
      $(this).closest('tr').find('.edit_open').show();
      $(this).closest('tr').find('.edit_close').hide();
			$(this).closest('tr').find('div[data="reject_3"]').slideDown(200);
      $(this).closest('td').html('<button class="save btn btn-success btn-sm m-btn m-btn--icon m-btn--icon-only" name="'+ $(this).attr('name') +'"><i class="fa fa-floppy-o" aria-hidden="true"></i></button>');
    });

    $(document).on('click', '.save', function(){
      var thiss = $(this);
      var closest = $(this).closest('tr');
			$.ajax({
				url: '/rent_admin/save_edit_car_list',
				type: 'POST',
				data: { otomoto: token,
      					id: thiss.attr('name'),
								vip: closest.find('select[name="edit_vip"]').val(),
								premium: closest.find('select[name="edit_premium"]').val(),
                status: closest.find('select[name="edit_status"]').val(),
								reject_reason: closest.find('textarea[name="reject_reason"]').val()
              },
				success: function(data){
					var res = $.parseJSON(data);
					token = res.otomoto;
					if (res.status == 'success')
					{
						closest.find('span[name="edit_vip_span"]').text(closest.find('select[name="edit_vip"] option:selected').text());
						closest.find('span[name="edit_premium_span"]').text(closest.find('select[name="edit_premium"] option:selected').text());
            closest.find('span[name="edit_status_span"]').text(closest.find('select[name="edit_status"] option:selected').text());

						closest.find('.edit_open').hide();
						closest.find('.edit_close').show();
						closest.find('.reject_reason_div').slideUp(100);
						thiss.closest('td').html('<button class="edit btn btn-primary btn-sm m-btn m-btn--icon m-btn--icon-only" name="'+ thiss.attr('name') +'"><i class="fa fa-pencil-alt"></i></button>');

						toastr.success(res.msg, 'Uğurlu');
					} else
					toastr.error(res.msg, "Xəta");
				},
				error: function(){
					toastr.error("Xəta baş verdi", "Xəta");
				}
			});
    });

		/*----- CHANGE DELETE BUTTON WITH STATUS -----*/

		$(document).on('change', 'select[name="edit_status"]', function(){
			if ($(this).val() != 3 && $(this).val() != 4)
				$(this).closest('tr').find('.delete').prop('disabled', true);
			else
				$(this).closest('tr').find('.delete').prop('disabled', false);
		});

</script>

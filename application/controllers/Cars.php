<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Cars extends MY_Controller {
	function __construct()
	{
		parent::__construct();
		$this->is_logged_in();
		$this->check_role();
    $this->load->model('cars_model');
    $this->load->model('universal_model');
	}

	public function car_list()
	{
    $data['user_list'] = $this->universal_model->get_more_item_select('user', 'id, first_name, mobile', array('status' => 1));

    $end = 30;
    if ($this->input->get())
      $filtered_get = $this->filter_data($this->input->get());

    $from = ($this->input->get('page'))?(int)$filtered_get['page']:0;
    $author_id = ($this->input->get('author_id'))?(int)$filtered_get['author_id']:0;
    $status = ($this->input->get('status'))?(int)$filtered_get['status']:(-1);

    $base_url = "/cars/car_list";
    $data['car_list'] = $this->cars_model->get_car_list($from, $end, $author_id, $status);
    $total = $this->cars_model->get_car_list_row($author_id, $status);

    $data['total_row'] = $total->count;
    $data['author_id'] = $this->universal_model->get_more_item_select('user', 'id, first_name, mobile', array('id' => $author_id));
    $data['status'] = $status;
    if ($total->count >= 1)
      $data["pagination"] = $this->pagination($from, $end, $base_url, $total->count, 3, 4);

		$this->home('cars/car_list', $data);
	}

  public function save_edit_car_list()
	{
    $this->load->library("template");
		if($this->input->post())
		{
			$filtered_post = $this->filter_data($this->input->post());
			$id = (int) $filtered_post['id'];
      $status = (int) $filtered_post['status'];
      $vip_type = (int) $filtered_post['vip'];
			$vip = $vip_type?1:0;
			$premium_type = (int) $filtered_post['premium'];
			$premium = $premium_type?1:0;
			$reject_reason = $filtered_post['reject_reason'];

      $mail_arr = $this->cars_model->get_mail_by_carad_id($id);
      $mail = ($mail_arr)?$mail_arr->email:'';
			$elan_name = ($mail_arr)?strtolower(str_replace(' ', '-', $mail_arr->mark.'-'.$mail_arr->model.'-'.$mail_arr->year.'-'.$mail_arr->mileage.'-km')):'auto';

			$car_status = $this->cars_model->get_car_status($id);
			if ($car_status->vip != $vip || $car_status->vip_type != $vip_type)
				$this->universal_model->item_edit_save('carad', array('id' => $id), array('vip' => $vip, 'vipdate' => date('Y-m-d H:i:s'), 'vip_update_date' => date('Y-m-d H:i:s'), 'vip_type' => $vip_type));

			if ($car_status->premium != $premium || $car_status->premium_type != $premium_type)
				$this->universal_model->item_edit_save('carad', array('id' => $id), array('premium' => $premium, 'premium_date' => date('Y-m-d H:i:s'), 'premium_update_date' => date('Y-m-d H:i:s'), 'premium_type' => $premium_type));

			$result1 = $this->universal_model->item_edit_save('carad', array('id' => $id), array('status' => $status, 'reject_reason' => $reject_reason));

			$unlimited = $this->cars_model->get_car_unlimited($id);

			if ($status == 1 && @$unlimited->unlimited)
				$this->universal_model->item_edit_save('carad', array('id' => $id), array('vip_update_date' => date('Y-m-d H:i:s'), 'premium_update_date' => date('Y-m-d H:i:s')));

			if ($result1)
			{
				$msg = '';
				if ($status == 1 && $car_status->status != 1) {
					$pin_arr = $this->universal_model->get_more_item_select_row('carad', 'pincode', array('id' => $id));
					$pin_code = $pin_arr?$pin_arr->pincode:'';

					$msg = '<a href="https://otomoto.az/pages/product/'.$elan_name.'/'.$id.'">Elanınız aktiv edildi</a>
									<br><br><br>
									<h3>Elanın pin kodu: '.$pin_code.'</h3><br>
									<h2><b>Otomoto</b></h2>';
				} else if ($status == 2 && $car_status->status != 2)
					$msg = '<span>'.$mail_arr->mark.' '.$mail_arr->model.' '.$mail_arr->year.' '.$mail_arr->mileage.' km elanınız deaktiv edildi</span>
									<br><br><br>
									<h2><b>Otomoto</b></h2>';
				else if ($status == 3 && $car_status->status != 3)
					$msg = '<span>'.$mail_arr->mark.' '.$mail_arr->model.' '.$mail_arr->year.' '.$mail_arr->mileage.' km elanınıza imtina edildi</span>
									<br><br>
									<h3>İmtina səbəbi: </h3>
									<span>'.$reject_reason.'</span>
									<br><br><br>
									<h2><b>Otomoto</b></h2>';
				else if ($status == 4 && $car_status->status != 4)
					$msg = '<span>'.$mail_arr->mark.' '.$mail_arr->model.' '.$mail_arr->year.' '.$mail_arr->mileage.' km elanınız silindi</span>
									<br><br><br>
									<h2><b>Otomoto</b></h2>';
				if($msg)
						$result2 = $this->template->send_mail("Otomoto", $msg, $mail);
				else
						$result2 = true;
			}

			if ($result1 && $result2)
				echo '{"msg":"Uğurla dəyişdirildi", "'.($this->security->get_csrf_token_name()).'":"'.($this->security->get_csrf_hash()).'", "status":"success"}';
			else
				echo '{"msg":"Xəta baş verdi", "'.($this->security->get_csrf_token_name()).'":"'.($this->security->get_csrf_hash()).'", "status":"error"}';
		}
	}

	public function edit_car($id = 0)
	{
		$id = (int) $id;
		$car_status = $this->cars_model->get_car_status($id);

		if($this->input->post())
		{
			$this->load->library("template");
			$filtered_post = $this->filter_data($this->input->post());

			$unlimited = $this->universal_model->get_item_where('user', array('id' => (int) $filtered_post['author_id']), 'unlimited');

			$vars = array(
					'mark' => (int) $filtered_post['marka'],
					'model' => (int) $filtered_post['model'],
					'year' => (int) $filtered_post['year'],
					'city' => (int) $filtered_post['city'],
					'body' => (int) $filtered_post['car_body'],
					'mileage' => (int) $filtered_post['mileage'],
					'engine' => (int) $filtered_post['engine'],
					'fuel' => $filtered_post['fuel'],
					'horsepower' => (int) $filtered_post['horse_power'],
					'transmission' => $filtered_post['transmission'],
					'drive' => $filtered_post['drive'],
					'color' => (int) $filtered_post['color'],
					'interiorcolor' => (int) $filtered_post['interior_color'],
					'credit' => $this->input->post('credit')?1:0,
					'barter' => $this->input->post('barter')?1:0,
					'wheels' => $this->input->post('disk')?1:0,
					'parkingsensor' => $this->input->post('radar')?1:0,
					'camera' => $this->input->post('camera')?1:0,
					'centrallocking' => $this->input->post('qapanma')?1:0,
					'xenon' => $this->input->post('lampa')?1:0,
					'leather' => $this->input->post('leather')?1:0,
					'sunproof' => $this->input->post('lyuk')?1:0,
					'heatedseats' => $this->input->post('isidilme')?1:0,
					'abs' => $this->input->post('abs')?1:0,
					'aircondition' => $this->input->post('kondisioner')?1:0,
					'rainsensor' => $this->input->post('sensor')?1:0,
					'seatventilation' => $this->input->post('havalandirilma')?1:0,
					'sidecurtains' => $this->input->post('perde')?1:0,
					'esp' => $this->input->post('esp')?1:0,
					'additionalinfo' => $filtered_post['additional_information'],
					'youtubelink' => $filtered_post['youtube_link'],
					'currency' => $filtered_post['valyuta'],
					'status' => (int) $filtered_post['status'],
					'price' => $this->input->post('price')?(int)$filtered_post['price']:0,
					'agreement' => $this->input->post('agreement')?1:0,
					'reject_reason' => $filtered_post['reject_reason'],
					'authorid' => (int) $filtered_post['author_id'],
					'vip_update_date' => @$unlimited->unlimited?date('Y-m-d H:i:s'):'',
					'premium_update_date' => @$unlimited->unlimited?date('Y-m-d H:i:s'):''
			);

			$status = (int) $filtered_post['status'];
			$mail_arr = $this->cars_model->get_mail_by_carad_id($id);
			$mail = ($mail_arr)?$mail_arr->email:'';
			$elan_name = ($mail_arr)?strtolower(str_replace(' ', '-', $mail_arr->mark.'-'.$mail_arr->model.'-'.$mail_arr->year.'-'.$mail_arr->mileage.'-km')):'auto';

			// print_r($vars);
			$result = $this->universal_model->item_edit_save('carad', array('id' => $id), $vars);

			if ($result)
			{
				$msg = '';

				if ($status == 1 && $car_status->status != 1) {
					$pin_arr = $this->universal_model->get_more_item_select_row('carad', 'pincode', array('id' => $id));
					$pin_code = $pin_arr?$pin_arr->pincode:'';

					$msg = '<a href="https://otomoto.az/pages/product/'.$elan_name.'/'.$id.'">Elanınız aktiv edildi</a>
									<br><br><br>
									<h3>Elanın pin kodu: '.$pin_code.'</h3><br>
									<h2><b>Otomoto</b></h2>';
				} else if ($status == 2 && $car_status->status != 2)
					$msg = '<span>'.$mail_arr->mark.' '.$mail_arr->model.' '.$mail_arr->year.' '.$mail_arr->mileage.' km elanınız deaktiv edildi</span>
									<br><br><br>
									<h2><b>Otomoto</b></h2>';
				else if ($status == 3 && $car_status->status != 3)
					$msg = '<span>'.$mail_arr->mark.' '.$mail_arr->model.' '.$mail_arr->year.' '.$mail_arr->mileage.' km elanınıza imtina edildi</span>
									<br><br>
									<h3>İmtina səbəbi: </h3>
									<span>'.$filtered_post['reject_reason'].'</span>
									<br><br><br>
									<h2><b>Otomoto</b></h2>';
				else if ($status == 4 && $car_status->status != 4)
					$msg = '<span>'.$mail_arr->mark.' '.$mail_arr->model.' '.$mail_arr->year.' '.$mail_arr->mileage.' km elanınız silindi</span>
									<br><br><br>
									<h2><b>Otomoto</b></h2>';

				if($msg)
					$result2 = $this->template->send_mail("Otomoto", $msg, $mail);
				else
					$result2 = true;

				if ($result2) {
					$this->load->model('PagesModel');
					$this->cache->delete('mark_list');
					$cache_mark_list = $this->PagesModel->get_marks('');
					$this->cache->write($cache_mark_list, 'mark_list');
					$this->cache->delete('popular_mark_list');
					$cache_popular_mark_list = $this->PagesModel->get_marks(' and popular = 1');
					$this->cache->write($cache_popular_mark_list, 'popular_mark_list');

					$data["status"] = array("status"=>"success","title"=>"Success", "icon"=>"check-circle", "msg"=>"Elan uğurla yenilendi.");
				}
				else
	      		$data["status"] = array("status"=>"danger","title"=>"Error", "icon"=>"exclamation-triangle",  "msg"=>"Xəta baş verdi");
			}
			else
      		$data["status"] = array("status"=>"danger","title"=>"Error", "icon"=>"exclamation-triangle",  "msg"=>"Xəta baş verdi");
		}

		$data['car_data'] = $this->cars_model->get_car_data($id);
		$data['mark'] = $this->universal_model->get_more_item_select('carmark', 'id, mark', array('active' => 1));
		$data['model'] = $this->universal_model->get_more_item_select('carmodel', 'id, model', array('active' => 1, 'markid' => $data['car_data']->mark));
		$data['city'] = $this->universal_model->get_more_item_select('elancities', 'id, ad', array('active' => 1));
		$data['body'] = $this->universal_model->get_more_item_select('carbody', 'id, body', array('active' => 1));
		$data['engine'] = $this->universal_model->get_more_item_select('carengine', 'id, engine', array('active' => 1));
		$data['fuel'] = ['Benzin', 'Dizel', 'Qaz', 'Elektro', 'Hibrid'];
		$data['transmission'] = ['Mexaniki', 'Avtomat', 'Robotlaşdırılmış', 'Variator'];
		$data['drive'] = ['Arxa', 'Ön', 'Tam'];
		$data['interiorcolor'] = $this->universal_model->get_more_item_select('carinteriorcolor', 'id, interiorcolor', array('active' => 1));
		$data['color'] = $this->universal_model->get_more_item_select('carcolor', 'id, color', array('active' => 1));
		$data['added'] = ((int) $this->input->get('added') == 1)?1:0;
		$data['users'] = $this->universal_model->get_more_item_select('user', 'id, first_name, mobile', array('status' => 1));

		$this->home('cars/edit_car', $data);
	}

	public function add_car()
	{
		$data['mark'] = $this->universal_model->get_more_item_select('carmark', 'id, mark', array('active' => 1));
		$data['city'] = $this->universal_model->get_more_item_select('elancities', 'id, ad', array('active' => 1));
		$data['body'] = $this->universal_model->get_more_item_select('carbody', 'id, body', array('active' => 1));
		$data['engine'] = $this->cars_model->get_engines();
		$data['fuel'] = ['Benzin', 'Dizel', 'Qaz', 'Elektro', 'Hibrid'];
		$data['transmission'] = ['Mexaniki', 'Avtomat', 'Robotlaşdırılmış', 'Variator'];
		$data['drive'] = ['Arxa', 'Ön', 'Tam'];
		$data['interiorcolor'] = $this->universal_model->get_more_item_select('carinteriorcolor', 'id, interiorcolor', array('active' => 1));
		$data['color'] = $this->universal_model->get_more_item_select('carcolor', 'id, color', array('active' => 1));
		$data['users'] = $this->universal_model->get_more_item_select('user', 'id, first_name, mobile', array('status' => 1));
		$data['pincode'] = $this->generate_pin();

		$this->home('cars/add_car', $data);
	}

	public function add_car_func()
	{
		if($this->input->post())
		{
			$filtered_post = $this->filter_data($this->input->post());
			$unlimited = $this->universal_model->get_item_where('user', array('id' => (int) $filtered_post['author_id']), 'unlimited');

			$vars = array(
					'mark' => (int) $filtered_post['marka'],
					'model' => (int) $filtered_post['model'],
					'year' => (int) $filtered_post['year'],
					'city' => (int) $filtered_post['city'],
					'body' => (int) $filtered_post['car_body'],
					'mileage' => (int) $filtered_post['mileage'],
					'engine' => (int) $filtered_post['engine'],
					'fuel' => $filtered_post['fuel'],
					'horsepower' => (int) $filtered_post['horse_power'],
					'transmission' => $filtered_post['transmission'],
					'drive' => $filtered_post['drive'],
					'color' => (int) $filtered_post['color'],
					'interiorcolor' => (int) $filtered_post['interior_color'],
					'credit' => $this->input->post('credit')?1:0,
					'barter' => $this->input->post('barter')?1:0,
					'wheels' => $this->input->post('disk')?1:0,
					'parkingsensor' => $this->input->post('radar')?1:0,
					'camera' => $this->input->post('camera')?1:0,
					'centrallocking' => $this->input->post('qapanma')?1:0,
					'xenon' => $this->input->post('lampa')?1:0,
					'leather' => $this->input->post('leather')?1:0,
					'sunproof' => $this->input->post('lyuk')?1:0,
					'heatedseats' => $this->input->post('isidilme')?1:0,
					'abs' => $this->input->post('abs')?1:0,
					'aircondition' => $this->input->post('kondisioner')?1:0,
					'rainsensor' => $this->input->post('sensor')?1:0,
					'seatventilation' => $this->input->post('havalandirilma')?1:0,
					'sidecurtains' => $this->input->post('perde')?1:0,
					'esp' => $this->input->post('esp')?1:0,
					'additionalinfo' => $filtered_post['additional_information'],
					'youtubelink' => $filtered_post['youtube_link'],
					'currency' => $filtered_post['valyuta'],
					'status' => (int) $filtered_post['status'],
					'price' => $this->input->post('price')?(int)$filtered_post['price']:0,
					'agreement' => $this->input->post('agreement')?1:0,
					'authorid' => (int) $filtered_post['author_id'],
					'reject_reason' => $filtered_post['reject_reason'],
					'pincode' => (int) $filtered_post['pincode'],
					'createdate' => date('Y-m-d H:i:s'),
					'vip_update_date' => @$unlimited->unlimited?date('Y-m-d H:i:s'):'',
					'premium_update_date' => @$unlimited->unlimited?date('Y-m-d H:i:s'):''
			);

			$result = $this->universal_model->add_item($vars, 'carad');

			if ($result) {
				$mark_arr = $this->universal_model->get_item_where('carmark', array('id' => (int) $filtered_post['marka']), 'mark');
        $mark = (@$mark_arr && $mark_arr->mark)?$mark_arr->mark:'';
        $model_arr = $this->universal_model->get_item_where('carmodel', array('id' => (int) $filtered_post['model']), 'model');
        $model = (@$model_arr && $model_arr->model)?$model_arr->model:'';

        if($mark && $model) {
          $vars = array(
            'mark' => strtoupper($mark),
            'model' => strtoupper($model),
            'year' => (int) $filtered_post['year'],
            'price' => (float) $filtered_post['price'],
            'currency' => (int) $filtered_post['valyuta'],
            'carad_id' => $result
          );
          $this->universal_model->add_item($vars, 'appraisement');
        }

				$this->load->model('PagesModel');
				$this->cache->delete('mark_list');
				$cache_mark_list = $this->PagesModel->get_marks('');
				$this->cache->write($cache_mark_list, 'mark_list');
				$this->cache->delete('popular_mark_list');
				$cache_popular_mark_list = $this->PagesModel->get_marks(' and popular = 1');
				$this->cache->write($cache_popular_mark_list, 'popular_mark_list');

				$this->universal_model->item_edit_save('carphoto', array('caradid' => 999999999), array('caradid' => $result));
				redirect('/cars/edit_car/'.$result.'?added=1');
			}
		}
	}

	public function get_model_list()
	{
		if($this->input->post())
		{
			$filtered_post = $this->filter_data($this->input->post());

			$mark = (int) $filtered_post['mark'];
			$data['model'] = $this->universal_model->get_more_item_select('carmodel', 'id, model', array('active' => 1, 'markid' => $mark));
			$data['otomoto'] = $this->security->get_csrf_hash();

			echo json_encode($data);
		}
	}

	public function add_img()
  {
    if($this->input->get("type"))
      $this->ajax('/assets/img/car_photos');
  }

	public function add_mark()
	{
		if ($this->input->post())
		{
			$filtered_post = $this->filter_data($this->input->post());

			$mark = $filtered_post['mark'];
			$popular = (int) $filtered_post['popular'];

			$result_id = $this->universal_model->add_item(array('mark' => $mark, 'popular' => $popular, 'createdate' => date('Y-m-d H:i:s'), 'active' => 1), 'carmark');

			if ($result_id)
			{
				if(!empty($_FILES['mark_photo']['tmp_name']) && $_FILES['mark_photo']['tmp_name'] != 'none')
				{
					$img = $this->do_upload("mark_photo", $this->config->item('server_root').'/assets/img/car_marks/', 20000, 'mark', 'jpg|png|JPEG|jpeg');
					if (@$img["error"]==TRUE) {
						$data["status"] = array("status"=>"danger","title"=>"Xəta", "icon"=>"exclamation-triangle",  "msg"=>$img["error"]);
					}	else {
						$this->load->library('resize');
						$this->resize->getFileInfo($img['full_path']);

						$this->resize->resizeImage(50, 50, 'auto');
						$this->resize->saveImage($this->config->item('server_root').'/assets/img/car_marks/small/'.$img["file_name"], 75);
						$this->resize->resizeImage(200, 200, 'auto');
						$this->resize->saveImage($this->config->item('server_root').'/assets/img/car_marks/big/'.$img["file_name"], 75);
						unlink($img['full_path']);

						$result = $this->universal_model->item_edit_save('carmark', array('id' => $result_id), array('img' => $img['file_name']));
						$this->load->model('PagesModel');
						$this->cache->delete('mark_list');
						$cache_mark_list = $this->PagesModel->get_marks('');
	          $this->cache->write($cache_mark_list, 'mark_list');

						if($result)
			        $data["status"] = array("status"=>"success","title"=>"Uğur", "icon"=>"check-circle", "msg"=>"Uğurla əlavə olundu");
			      else
			        $data["status"] = array("status"=>"danger","title"=>"Xəta", "icon"=>"exclamation-triangle",  "msg"=>"Xəta baş verdi");
					}
				}
				else
					$data["status"] = array("status"=>"danger","title"=>"Xəta", "icon"=>"exclamation-triangle",  "msg"=>"Yüklənəcək şəkil tapılmadı");
			}
			else
				$data["status"] = array("status"=>"danger","title"=>"Xəta", "icon"=>"exclamation-triangle",  "msg"=>"Xəta baş verdi");
		}

		$count = 30;
		$data['from'] = $from = $this->input->get('page')?(int)$this->input->get('page'):0;

    $base_url = "/cars/add_mark";
    $data['mark_list'] = $this->cars_model->get_mark_list($from, $count);
    $total = $this->cars_model->get_mark_list_row();

    if ($total->count >= 1)
      $data["pagination"] = $this->pagination($from, $count, $base_url, $total->count, 3, 4);

		$this->home('cars/mark_list', $data);
	}

	public function active_passive_mark()
	{
		if($this->input->post("id"))
		{
			$id = (int) $this->input->post('id');
			$active = (int) $this->input->post('active_passive');

			$result = $this->universal_model->item_edit_save('carmark', 'id='.$id, array('active' => $active));
			$this->load->model('PagesModel');
			$this->cache->delete('mark_list');
			$cache_mark_list = $this->PagesModel->get_marks('');
			$this->cache->write($cache_mark_list, 'mark_list');

			if($result)
				echo '{"msg":"Dəyişdirildi", "'.($this->security->get_csrf_token_name()).'":"'.($this->security->get_csrf_hash()).'", "status":"success"}';
			else
				echo '{"msg":"Xəta", "'.($this->security->get_csrf_token_name()).'":"'.($this->security->get_csrf_hash()).'", "status":"error"}';
		}
	}

	public function change_popular_mark()
	{
		if($this->input->post("id"))
		{
			$id = (int) $this->input->post('id');
			$active = (int) $this->input->post('active_passive');

			$result = $this->universal_model->item_edit_save('carmark', 'id='.$id, array('popular' => $active));
			$this->load->model('PagesModel');
			$this->cache->delete('popular_mark_list');
			$cache_popular_mark_list = $this->PagesModel->get_marks(' and popular = 1');
			$this->cache->write($cache_popular_mark_list, 'popular_mark_list');

			if($result)
				echo '{"msg":"Dəyişdirildi", "'.($this->security->get_csrf_token_name()).'":"'.($this->security->get_csrf_hash()).'", "status":"success"}';
			else
				echo '{"msg":"Xəta", "'.($this->security->get_csrf_token_name()).'":"'.($this->security->get_csrf_hash()).'", "status":"error"}';
		}
	}

	public function delete_mark()
	{
		if($this->input->post("id"))
		{
			$id = (int) $this->input->post('id');

			$row = $this->universal_model->get_more_item_select_row('carmark', 'img', array('id' => $id));

			if ($row) {
				@unlink($this->config->item('server_root').'/assets/img/car_marks/small/'.$row->img);
				@unlink($this->config->item('server_root').'/assets/img/car_marks/big/'.$row->img);
				$result = $this->universal_model->delete_item('id='.$id, 'carmark');
				$this->load->model('PagesModel');
				$this->cache->delete('mark_list');
				$cache_mark_list = $this->PagesModel->get_marks('');
				$this->cache->write($cache_mark_list, 'mark_list');
				$this->cache->delete('popular_mark_list');
				$cache_popular_mark_list = $this->PagesModel->get_marks(' and popular = 1');
				$this->cache->write($cache_popular_mark_list, 'popular_mark_list');
			}
			else
				$result = 0;

			if($result)
				echo '{"msg":"Uğurla silindi", "'.($this->security->get_csrf_token_name()).'":"'.($this->security->get_csrf_hash()).'", "status":"success"}';
			else
				echo '{"msg":"Xəta baş verdi", "'.($this->security->get_csrf_token_name()).'":"'.($this->security->get_csrf_hash()).'", "status":"error"}';
		}
	}

	public function add_model()
	{
		if ($this->input->post())
		{
			$filtered_post = $this->filter_data($this->input->post());

			$mark_id = (int) $filtered_post['mark_id'];
			$model = $filtered_post['model'];
			$model = str_replace(' ', '', $model);
			$model_arr = explode(',', $model);

			foreach ($model_arr as $row) {
				$result = $this->universal_model->add_item(array('markid' => $mark_id, 'model' => $row, 'createdate' => date('Y-m-d H:i:s'), 'active' => 1), 'carmodel');
			}

			if($result)
        $data["status"] = array("status"=>"success","title"=>"Uğur", "icon"=>"check-circle", "msg"=>"Uğurla əlavə olundu");
      else
        $data["status"] = array("status"=>"danger","title"=>"Xəta", "icon"=>"exclamation-triangle",  "msg"=>"Xəta baş verdi");
		}

		$data['mark_list'] = $this->universal_model->get_more_item_select('carmark', 'id, mark', array('active' => 1));
		$count = 30;
		$data['from'] = $from = $this->input->get('page')?(int)$this->input->get('page'):0;

    $base_url = "/cars/add_model";
    $data['model_list'] = $this->cars_model->get_model_list($from, $count);
    $total = $this->cars_model->get_model_list_row();

    if ($total->count >= 1)
      $data["pagination"] = $this->pagination($from, $count, $base_url, $total->count, 3, 4);

		$this->home('cars/model_list', $data);
	}

	public function active_passive_model()
	{
		if($this->input->post("id"))
		{
			$id = (int) $this->input->post('id');
			$active = (int) $this->input->post('active_passive');

			$result = $this->universal_model->item_edit_save('carmodel', 'id='.$id, array('active' => $active));

			if($result)
				echo '{"msg":"Dəyişdirildi", "'.($this->security->get_csrf_token_name()).'":"'.($this->security->get_csrf_hash()).'", "status":"success"}';
			else
				echo '{"msg":"Xəta", "'.($this->security->get_csrf_token_name()).'":"'.($this->security->get_csrf_hash()).'", "status":"error"}';
		}
	}

	public function delete_model()
	{
		if($this->input->post("id"))
		{
			$id = (int) $this->input->post('id');
			$result = $this->universal_model->delete_item('id='.$id, 'carmodel');

			if($result)
				echo '{"msg":"Uğurla silindi", "'.($this->security->get_csrf_token_name()).'":"'.($this->security->get_csrf_hash()).'", "status":"success"}';
			else
				echo '{"msg":"Xəta baş verdi", "'.($this->security->get_csrf_token_name()).'":"'.($this->security->get_csrf_hash()).'", "status":"error"}';
		}
	}

	public function add_city()
	{
		if ($this->input->post())
		{
			$filtered_post = $this->filter_data($this->input->post());

			$city = $filtered_post['city'];

			$result = $this->universal_model->add_item(array('ad' => $city, 'tarix' => date('Y-m-d H:i:s'), 'active' => 1), 'elancities');
			$this->cache->delete('city_list');
			$cache_city_list = $this->universal_model->get_more_item_select('elancities', 'id, ad', array('active' => 1));
			$this->cache->write($cache_city_list, 'city_list');

			if($result)
        $data["status"] = array("status"=>"success","title"=>"Uğur", "icon"=>"check-circle", "msg"=>"Uğurla əlavə olundu");
      else
        $data["status"] = array("status"=>"danger","title"=>"Xəta", "icon"=>"exclamation-triangle",  "msg"=>"Xəta baş verdi");
		}

		$count = 30;
		$data['from'] = $from = $this->input->get('page')?(int)$this->input->get('page'):0;

    $base_url = "/cars/add_city";
    $data['cities'] = $this->cars_model->get_cities_list($from, $count);
    $total = $this->cars_model->get_cities_list_row();

    if ($total->count >= 1)
      $data["pagination"] = $this->pagination($from, $count, $base_url, $total->count, 3, 4);

		$this->home('cars/cities', $data);
	}

	public function active_passive_city()
	{
		if($this->input->post("id"))
		{
			$id = (int) $this->input->post('id');
			$active = (int) $this->input->post('active_passive');

			$result = $this->universal_model->item_edit_save('elancities', 'id='.$id, array('active' => $active));
			$this->cache->delete('city_list');
			$cache_city_list = $this->universal_model->get_more_item_select('elancities', 'id, ad', array('active' => 1));
			$this->cache->write($cache_city_list, 'city_list');

			if($result)
				echo '{"msg":"Dəyişdirildi", "'.($this->security->get_csrf_token_name()).'":"'.($this->security->get_csrf_hash()).'", "status":"success"}';
			else
				echo '{"msg":"Xəta", "'.($this->security->get_csrf_token_name()).'":"'.($this->security->get_csrf_hash()).'", "status":"error"}';
		}
	}

	public function delete_city()
	{
		if($this->input->post("id"))
		{
			$id = (int) $this->input->post('id');
			$result = $this->universal_model->delete_item('id='.$id, 'elancities');
			$this->cache->delete('city_list');
			$cache_city_list = $this->universal_model->get_more_item_select('elancities', 'id, ad', array('active' => 1));
			$this->cache->write($cache_city_list, 'city_list');

			if($result)
				echo '{"msg":"Uğurla silindi", "'.($this->security->get_csrf_token_name()).'":"'.($this->security->get_csrf_hash()).'", "status":"success"}';
			else
				echo '{"msg":"Xəta baş verdi", "'.($this->security->get_csrf_token_name()).'":"'.($this->security->get_csrf_hash()).'", "status":"error"}';
		}
	}

	public function add_carbody()
	{
		if ($this->input->post())
		{
			$filtered_post = $this->filter_data($this->input->post());

			$carbody = $filtered_post['carbody'];

			$result = $this->universal_model->add_item(array('body' => $carbody, 'createdate' => date('Y-m-d H:i:s'), 'active' => 1), 'carbody');
			$this->cache->delete('body_list');
			$cache_body_list = $this->universal_model->get_more_item_select('carbody', 'id, body', array('active' => 1));
			$this->cache->write($cache_body_list, 'body_list');

			if($result)
        $data["status"] = array("status"=>"success","title"=>"Uğur", "icon"=>"check-circle", "msg"=>"Uğurla əlavə olundu");
      else
        $data["status"] = array("status"=>"danger","title"=>"Xəta", "icon"=>"exclamation-triangle",  "msg"=>"Xəta baş verdi");
		}

		$count = 30;
		$data['from'] = $from = $this->input->get('page')?(int)$this->input->get('page'):0;

    $base_url = "/cars/add_carbody";
    $data['carbodies'] = $this->cars_model->get_carbodies_list($from, $count);
    $total = $this->cars_model->get_carbodies_list_row();

    if ($total->count >= 1)
      $data["pagination"] = $this->pagination($from, $count, $base_url, $total->count, 3, 4);

		$this->home('cars/carbody_list', $data);
	}

	public function active_passive_carbody()
	{
		if($this->input->post("id"))
		{
			$id = (int) $this->input->post('id');
			$active = (int) $this->input->post('active_passive');

			$result = $this->universal_model->item_edit_save('carbody', 'id='.$id, array('active' => $active));
			$this->cache->delete('body_list');
			$cache_body_list = $this->universal_model->get_more_item_select('carbody', 'id, body', array('active' => 1));
			$this->cache->write($cache_body_list, 'body_list');

			if($result)
				echo '{"msg":"Dəyişdirildi", "'.($this->security->get_csrf_token_name()).'":"'.($this->security->get_csrf_hash()).'", "status":"success"}';
			else
				echo '{"msg":"Xəta", "'.($this->security->get_csrf_token_name()).'":"'.($this->security->get_csrf_hash()).'", "status":"error"}';
		}
	}

	public function delete_carbody()
	{
		if($this->input->post("id"))
		{
			$id = (int) $this->input->post('id');
			$result = $this->universal_model->delete_item('id='.$id, 'carbody');
			$this->cache->delete('body_list');
			$cache_body_list = $this->universal_model->get_more_item_select('carbody', 'id, body', array('active' => 1));
			$this->cache->write($cache_body_list, 'body_list');

			if($result)
				echo '{"msg":"Uğurla silindi", "'.($this->security->get_csrf_token_name()).'":"'.($this->security->get_csrf_hash()).'", "status":"success"}';
			else
				echo '{"msg":"Xəta baş verdi", "'.($this->security->get_csrf_token_name()).'":"'.($this->security->get_csrf_hash()).'", "status":"error"}';
		}
	}

	public function add_engine()
	{
		if ($this->input->post())
		{
			$filtered_post = $this->filter_data($this->input->post());

			$engine = $filtered_post['engine'];
			$engine = str_replace(' ', '', $engine);
			$engine_arr = explode(',', $engine);

			foreach ($engine_arr as $row) {
				$result = $this->universal_model->add_item(array('engine' => $row, 'createdate' => date('Y-m-d H:i:s'), 'active' => 1), 'carengine');
			}

			$this->cache->delete('engine_list');
			$cache_engine_list = $this->universal_model->get_more_item_select('carengine', 'id, engine', array('active' => 1));
			$this->cache->write($cache_engine_list, 'engine_list');

			if($result)
        $data["status"] = array("status"=>"success","title"=>"Uğur", "icon"=>"check-circle", "msg"=>"Uğurla əlavə olundu");
      else
        $data["status"] = array("status"=>"danger","title"=>"Xəta", "icon"=>"exclamation-triangle",  "msg"=>"Xəta baş verdi");
		}

		$count = 30;
		$data['from'] = $from = $this->input->get('page')?(int)$this->input->get('page'):0;

    $base_url = "/cars/add_engine";
    $data['engines'] = $this->cars_model->get_engines_list($from, $count);
    $total = $this->cars_model->get_engines_list_row();

    if ($total->count >= 1)
      $data["pagination"] = $this->pagination($from, $count, $base_url, $total->count, 3, 4);

		$this->home('cars/engine_list', $data);
	}

	public function active_passive_engine()
	{
		if($this->input->post("id"))
		{
			$id = (int) $this->input->post('id');
			$active = (int) $this->input->post('active_passive');

			$result = $this->universal_model->item_edit_save('carengine', 'id='.$id, array('active' => $active));
			$this->cache->delete('engine_list');
			$cache_engine_list = $this->universal_model->get_more_item_select('carengine', 'id, engine', array('active' => 1));
			$this->cache->write($cache_engine_list, 'engine_list');

			if($result)
				echo '{"msg":"Dəyişdirildi", "'.($this->security->get_csrf_token_name()).'":"'.($this->security->get_csrf_hash()).'", "status":"success"}';
			else
				echo '{"msg":"Xəta", "'.($this->security->get_csrf_token_name()).'":"'.($this->security->get_csrf_hash()).'", "status":"error"}';
		}
	}

	public function delete_engine()
	{
		if($this->input->post("id"))
		{
			$id = (int) $this->input->post('id');
			$result = $this->universal_model->delete_item('id='.$id, 'carengine');
			$this->cache->delete('engine_list');
			$cache_engine_list = $this->universal_model->get_more_item_select('carengine', 'id, engine', array('active' => 1));
			$this->cache->write($cache_engine_list, 'engine_list');

			if($result)
				echo '{"msg":"Uğurla silindi", "'.($this->security->get_csrf_token_name()).'":"'.($this->security->get_csrf_hash()).'", "status":"success"}';
			else
				echo '{"msg":"Xəta baş verdi", "'.($this->security->get_csrf_token_name()).'":"'.($this->security->get_csrf_hash()).'", "status":"error"}';
		}
	}

	public function add_color()
	{
		if ($this->input->post())
		{
			$filtered_post = $this->filter_data($this->input->post());

			$color = $filtered_post['color'];
			$color = str_replace(' ', '', $color);
			$color_arr = explode(',', $color);

			foreach ($color_arr as $row) {
				$result = $this->universal_model->add_item(array('color' => $row, 'createdate' => date('Y-m-d H:i:s'), 'active' => 1), 'carcolor');
			}
			$this->cache->delete('color_list');
			$cache_color_list = $this->universal_model->get_more_item_select('carcolor', 'id, color', array('active' => 1));
			$this->cache->write($cache_color_list, 'color_list');

			if($result)
        $data["status"] = array("status"=>"success","title"=>"Uğur", "icon"=>"check-circle", "msg"=>"Uğurla əlavə olundu");
      else
        $data["status"] = array("status"=>"danger","title"=>"Xəta", "icon"=>"exclamation-triangle",  "msg"=>"Xəta baş verdi");
		}

		$count = 30;
		$data['from'] = $from = $this->input->get('page')?(int)$this->input->get('page'):0;

    $base_url = "/cars/add_color";
    $data['colors'] = $this->cars_model->get_color_list($from, $count);
    $total = $this->cars_model->get_color_list_row();

    if ($total->count >= 1)
      $data["pagination"] = $this->pagination($from, $count, $base_url, $total->count, 3, 4);

		$this->home('cars/color_list', $data);
	}

	public function active_passive_color()
	{
		if($this->input->post("id"))
		{
			$id = (int) $this->input->post('id');
			$active = (int) $this->input->post('active_passive');

			$result = $this->universal_model->item_edit_save('carcolor', 'id='.$id, array('active' => $active));
			$this->cache->delete('color_list');
			$cache_color_list = $this->universal_model->get_more_item_select('carcolor', 'id, color', array('active' => 1));
			$this->cache->write($cache_color_list, 'color_list');

			if($result)
				echo '{"msg":"Dəyişdirildi", "'.($this->security->get_csrf_token_name()).'":"'.($this->security->get_csrf_hash()).'", "status":"success"}';
			else
				echo '{"msg":"Xəta", "'.($this->security->get_csrf_token_name()).'":"'.($this->security->get_csrf_hash()).'", "status":"error"}';
		}
	}

	public function delete_color()
	{
		if($this->input->post("id"))
		{
			$id = (int) $this->input->post('id');
			$result = $this->universal_model->delete_item('id='.$id, 'carcolor');
			$this->cache->delete('color_list');
			$cache_color_list = $this->universal_model->get_more_item_select('carcolor', 'id, color', array('active' => 1));
			$this->cache->write($cache_color_list, 'color_list');

			if($result)
				echo '{"msg":"Uğurla silindi", "'.($this->security->get_csrf_token_name()).'":"'.($this->security->get_csrf_hash()).'", "status":"success"}';
			else
				echo '{"msg":"Xəta baş verdi", "'.($this->security->get_csrf_token_name()).'":"'.($this->security->get_csrf_hash()).'", "status":"error"}';
		}
	}

	public function add_interior_color()
	{
		if ($this->input->post())
		{
			$filtered_post = $this->filter_data($this->input->post());

			$interior_color = $filtered_post['interior_color'];
			$interior_color = str_replace(' ', '', $interior_color);
			$interior_color_arr = explode(',', $interior_color);

			foreach ($interior_color_arr as $row) {
				$result = $this->universal_model->add_item(array('interiorcolor' => $row, 'createdate' => date('Y-m-d H:i:s'), 'active' => 1), 'carinteriorcolor');
			}

			if($result)
				$data["status"] = array("status"=>"success","title"=>"Uğur", "icon"=>"check-circle", "msg"=>"Uğurla əlavə olundu");
			else
				$data["status"] = array("status"=>"danger","title"=>"Xəta", "icon"=>"exclamation-triangle",  "msg"=>"Xəta baş verdi");
		}

		$count = 30;
		$data['from'] = $from = $this->input->get('page')?(int)$this->input->get('page'):0;

		$base_url = "/cars/add_interior_color";
		$data['colors'] = $this->cars_model->get_interior_color_list($from, $count);
		$total = $this->cars_model->get_interior_color_list_row();

		if ($total->count >= 1)
			$data["pagination"] = $this->pagination($from, $count, $base_url, $total->count, 3, 4);

		$this->home('cars/interior_color_list', $data);
	}

	public function active_passive_interior_color()
	{
		if($this->input->post("id"))
		{
			$id = (int) $this->input->post('id');
			$active = (int) $this->input->post('active_passive');

			$result = $this->universal_model->item_edit_save('carinteriorcolor', 'id='.$id, array('active' => $active));

			if($result)
				echo '{"msg":"Dəyişdirildi", "'.($this->security->get_csrf_token_name()).'":"'.($this->security->get_csrf_hash()).'", "status":"success"}';
			else
				echo '{"msg":"Xəta", "'.($this->security->get_csrf_token_name()).'":"'.($this->security->get_csrf_hash()).'", "status":"error"}';
		}
	}

	public function delete_interior_color()
	{
		if($this->input->post("id"))
		{
			$id = (int) $this->input->post('id');
			$result = $this->universal_model->delete_item('id='.$id, 'carinteriorcolor');

			if($result)
				echo '{"msg":"Uğurla silindi", "'.($this->security->get_csrf_token_name()).'":"'.($this->security->get_csrf_hash()).'", "status":"success"}';
			else
				echo '{"msg":"Xəta baş verdi", "'.($this->security->get_csrf_token_name()).'":"'.($this->security->get_csrf_hash()).'", "status":"error"}';
		}
	}

	public function delete_car()
	{
		if ($this->input->post())
		{
			$id = (int) $this->input->post('id');

			$row = $this->universal_model->get_more_item_select_row('carad', 'id, status', 'id='.$id);
			if ($row->status == 3 || $row->status == 4) {
				$photos = $this->universal_model->get_more_item_select('carphoto', 'id, name', array('caradid' => $id));

				if ($photos) {
					foreach($photos as $raw)
					{
						$arr = explode('.', $raw->name);
						@unlink($this->config->item('server_root').'/assets/img/car_photos/800xauto/'.$raw->name);
						@unlink($this->config->item('server_root').'/assets/img/car_photos/800xauto/'.$arr[0].".webp");
						@unlink($this->config->item('server_root').'/assets/img/car_photos/90x90/'.$raw->name);
						@unlink($this->config->item('server_root').'/assets/img/car_photos/90x90/'.$arr[0].".webp");
						$this->universal_model->delete_item('id='.$raw->id, 'carphoto');
					}
				}

				$result = $this->universal_model->delete_item('id='.$id, 'carad');

				if($result)
					echo '{"msg":"Uğurla silindi", "'.($this->security->get_csrf_token_name()).'":"'.($this->security->get_csrf_hash()).'", "status":"success"}';
				else
					echo '{"msg":"Xəta baş verdi", "'.($this->security->get_csrf_token_name()).'":"'.($this->security->get_csrf_hash()).'", "status":"error"}';
			}
			else
				echo '{"msg":"Yalnız silinmiş və ya deaktiv edilmiş elanları silə bilərsiniz!", "'.($this->security->get_csrf_token_name()).'":"'.($this->security->get_csrf_hash()).'", "status":"error"}';
		}
	}

	public function just_delete_active_null()
	{
		$photos = $this->universal_model->get_more_item_select('carphoto', 'id, name', array('active' => 0));

		if ($photos) {
			foreach($photos as $row)
			{
				@unlink($this->config->item('server_root').'/assets/img/car_photos/800xauto/'.$row->name);
				@unlink($this->config->item('server_root').'/assets/img/car_photos/90x90/'.$row->name);
				$this->universal_model->delete_item('id='.$row->id, 'carphoto');
			}
		}
	}

	public function just_delete_deleted()
	{
		$photos = $this->universal_model->get_more_item_select('carphoto', 'id, name', array('deleted' => 1));

		if ($photos) {
			foreach($photos as $row)
			{
				@unlink($this->config->item('server_root').'/assets/img/car_photos/800xauto/'.$row->name);
				@unlink($this->config->item('server_root').'/assets/img/car_photos/90x90/'.$row->name);
				$this->universal_model->delete_item('id='.$row->id, 'carphoto');
			}
		}
	}

	function generate_pin()
	{
		$val = $this->ran_num(5);
		$check = false;

		$array = $this->universal_model->select_result('carad', 'pincode');
		foreach ($array as $row)
		{
			if ($row->pincode == $val)
				$check = true;
		}

		if ($check)
			$this->generate_pin();
		else
			return $val;
	}

	function ran_num($length) {
    $result = '';

    for($i = 0; $i < $length; $i++) {
        $result .= mt_rand(0, 9);
    }

    return $result;
	}
}

<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Rent_admin extends MY_Controller {
	function __construct()
	{
		parent::__construct();
		$this->is_logged_in();
		$this->check_role();
    $this->load->model('rent_admin_model');
    $this->load->model('universal_model');
	}

  public function add_class()
  {
    if ($this->input->post())
    {
      $filtered_post = $this->filter_data($this->input->post());

      $class = $filtered_post['class'];

      $result_id = $this->universal_model->add_item(array('class' => $class, 'active' => 1), 'rent_class');

      if ($result_id)
      {
        if(!empty($_FILES['class_photo']['tmp_name']) && $_FILES['class_photo']['tmp_name'] != 'none')
        {
          $img = $this->do_upload("class_photo", $this->config->item('server_root').'/assets/img/', 20000, 'mark', 'jpg|png|JPEG|jpeg');
          if (@$img["error"]==TRUE) {
            $data["status"] = array("status"=>"danger","title"=>"Xəta", "icon"=>"exclamation-triangle",  "msg"=>$img["error"]);
          }	else {
            $this->load->library('resize');
            $this->resize->getFileInfo($img['full_path']);

            $this->resize->resizeImage(250, 250, 'auto');
            $this->resize->saveImage($this->config->item('server_root').'/assets/img/rent_classes/'.$img["file_name"], 90);
            unlink($img['full_path']);

            $result = $this->universal_model->item_edit_save('rent_class', array('id' => $result_id), array('img' => $img['file_name']));

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

    $base_url = "/rent_admin/add_class";
    $data['class_list'] = $this->rent_admin_model->get_class_list($from, $count);
    $total = $this->rent_admin_model->get_class_list_row();

    if ($total->count >= 1)
      $data["pagination"] = $this->pagination($from, $count, $base_url, $total->count, 3, 4);

    $this->home('rent_admin/add_class', $data);
  }

  public function active_passive_class()
  {
    if($this->input->post("id"))
    {
      $id = (int) $this->input->post('id');
      $active = (int) $this->input->post('active_passive');

      $result = $this->universal_model->item_edit_save('rent_class', 'id='.$id, array('active' => $active));

      if($result)
        echo '{"msg":"Dəyişdirildi", "'.($this->security->get_csrf_token_name()).'":"'.($this->security->get_csrf_hash()).'", "status":"success"}';
      else
        echo '{"msg":"Xəta", "'.($this->security->get_csrf_token_name()).'":"'.($this->security->get_csrf_hash()).'", "status":"error"}';
    }
  }

  public function delete_class()
  {
    if($this->input->post("id"))
    {
      $id = (int) $this->input->post('id');

      $row = $this->universal_model->get_more_item_select_row('rent_class', 'img', array('id' => $id));

      if ($row) {
        @unlink($this->config->item('server_root').'/assets/img/rent_classes/'.$row->img);
        $result = $this->universal_model->delete_item('id='.$id, 'rent_class');
      }
      else
        $result = 0;

      if($result)
        echo '{"msg":"Uğurla silindi", "'.($this->security->get_csrf_token_name()).'":"'.($this->security->get_csrf_hash()).'", "status":"success"}';
      else
        echo '{"msg":"Xəta baş verdi", "'.($this->security->get_csrf_token_name()).'":"'.($this->security->get_csrf_hash()).'", "status":"error"}';
    }
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

    $base_url = "/rent_admin/car_list";
    $data['car_list'] = $this->rent_admin_model->get_car_list($from, $end, $author_id, $status);
    $total = $this->rent_admin_model->get_car_list_row($author_id, $status);

    $data['total_row'] = $total->count;
    $data['author_id'] = $this->universal_model->get_more_item_select('user', 'id, first_name, mobile', array('id' => $author_id));
    $data['status'] = $status;
    if ($total->count >= 1)
      $data["pagination"] = $this->pagination($from, $end, $base_url, $total->count, 3, 4);

		$this->home('rent_admin/car_list', $data);
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

      $mail_arr = $this->rent_admin_model->get_mail_by_carad_id($id);
      $mail = ($mail_arr)?$mail_arr->email:'';
			$elan_name = ($mail_arr)?strtolower(str_replace(' ', '-', $mail_arr->mark.'-'.$mail_arr->model.'-'.$mail_arr->year)):'auto';

			$car_status = $this->rent_admin_model->get_car_status($id);
			if ($car_status->vip != $vip || $car_status->vip_type != $vip_type)
				$this->universal_model->item_edit_save('rent_car', array('id' => $id), array('vip' => $vip, 'vipdate' => date('Y-m-d H:i:s'), 'vip_update_date' => date('Y-m-d H:i:s'), 'vip_type' => $vip_type));

			if ($car_status->premium != $premium || $car_status->premium_type != $premium_type)
				$this->universal_model->item_edit_save('rent_car', array('id' => $id), array('premium' => $premium, 'premium_date' => date('Y-m-d H:i:s'), 'premium_update_date' => date('Y-m-d H:i:s'), 'premium_type' => $premium_type));

			$result1 = $this->universal_model->item_edit_save('rent_car', array('id' => $id), array('status' => $status, 'reject_reason' => $reject_reason));

			if ($result1)
			{
				$msg = '';
				if ($status == 1 && $car_status->status != 1) {
					$pin_arr = $this->universal_model->get_more_item_select_row('rent_car', 'pincode', array('id' => $id));
					$pin_code = $pin_arr?$pin_arr->pincode:'';

					$msg = '<a href="https://otomoto.az/pages/product/'.$elan_name.'/'.$id.'">Elanınız aktiv edildi</a>
									<br><br><br>
									<h3>Elanın pin kodu: '.$pin_code.'</h3><br>
									<h2><b>Otomoto</b></h2>';
				} else if ($status == 2 && $car_status->status != 2)
					$msg = '<span>'.$mail_arr->mark.' '.$mail_arr->model.' '.$mail_arr->year.' elanınız deaktiv edildi</span>
									<br><br><br>
									<h2><b>Otomoto</b></h2>';
				else if ($status == 3 && $car_status->status != 3)
					$msg = '<span>'.$mail_arr->mark.' '.$mail_arr->model.' '.$mail_arr->year.' elanınıza imtina edildi</span>
									<br><br>
									<h3>İmtina səbəbi: </h3>
									<span>'.$reject_reason.'</span>
									<br><br><br>
									<h2><b>Otomoto</b></h2>';
				else if ($status == 4 && $car_status->status != 4)
					$msg = '<span>'.$mail_arr->mark.' '.$mail_arr->model.' '.$mail_arr->year.' km elanınız silindi</span>
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

	public function delete_car()
	{
		if ($this->input->post())
		{
			$id = (int) $this->input->post('id');

			$row = $this->universal_model->get_more_item_select_row('rent_car', 'id, status', 'id='.$id);
			if ($row->status == 3 || $row->status == 4) {
				$photos = $this->universal_model->get_more_item_select('rent_car_photo', 'id, name', array('rent_car_id' => $id));

				if ($photos) {
					foreach($photos as $row)
					{
						@unlink($this->config->item('server_root').'/assets/img/rent_car_photos/800xauto/'.$row->name);
						@unlink($this->config->item('server_root').'/assets/img/rent_car_photos/90x90/'.$row->name);
						$this->universal_model->delete_item('id='.$row->id, 'rent_car_photo');
					}
				}

				$result = $this->universal_model->delete_item('id='.$id, 'rent_car');

				if ($result)
					echo '{"msg":"Uğurla silindi", "'.($this->security->get_csrf_token_name()).'":"'.($this->security->get_csrf_hash()).'", "status":"success"}';
				else
					echo '{"msg":"Xəta baş verdi", "'.($this->security->get_csrf_token_name()).'":"'.($this->security->get_csrf_hash()).'", "status":"error"}';
			}
			else
				echo '{"msg":"Yalnız silinmiş və ya deaktiv edilmiş elanları silə bilərsiniz!", "'.($this->security->get_csrf_token_name()).'":"'.($this->security->get_csrf_hash()).'", "status":"error"}';
		}
	}

	public function add_car()
	{
		$data['mark'] = $this->universal_model->get_more_item_select('carmark', 'id, mark', array('active' => 1));
		$data['city'] = $this->universal_model->get_more_item_select('elancities', 'id, ad', array('active' => 1));
		$data['body'] = $this->universal_model->get_more_item_select('carbody', 'id, body', array('active' => 1));
		$data['fuel'] = ['Benzin', 'Dizel', 'Qaz', 'Elektro', 'Hibrid'];
		$data['transmission'] = ['Mexaniki', 'Avtomat', 'Robotlaşdırılmış', 'Variator'];
		$data['color'] = $this->universal_model->get_more_item_select('carcolor', 'id, color', array('active' => 1));
		$data['users'] = $this->universal_model->get_more_item_select('user', 'id, first_name, mobile', array('status' => 1));
		$data['classes'] = $this->universal_model->get_more_item_select('rent_class', 'id, class', 'active = 1');
		$data['pincode'] = $this->generate_pin();

		$this->home('rent_admin/add_car', $data);
	}

	public function add_car_func()
	{
		if($this->input->post())
		{
			$filtered_post = $this->filter_data($this->input->post());

			$vars = array(
					'class' => (int) $filtered_post['class'],
					'mark' => (int) $filtered_post['marka'],
					'model' => (int) $filtered_post['model'],
					'year' => (int) $filtered_post['year'],
					'city' => (int) $filtered_post['city'],
					'body' => (int) $filtered_post['car_body'],
					'fuel' => $filtered_post['fuel'],
					'transmission' => $filtered_post['transmission'],
					'color' => (int) $filtered_post['color'],
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
					'currency' => $filtered_post['valyuta'],
					'status' => (int) $filtered_post['status'],
					'price' => $this->input->post('price')?(int)$filtered_post['price']:0,
					'authorid' => (int) $filtered_post['author_id'],
					'reject_reason' => $filtered_post['reject_reason'],
					'included_km' => (int) $filtered_post['included_km'],
					'surcharge' => (int) $filtered_post['surcharge'],
					'insurance' => $this->input->post('insurance')?1:0,
					'deposit' => (int) $filtered_post['deposit'],
					'delivery' => $this->input->post('delivery')?1:0,
					'returning' => $this->input->post('returning')?1:0,
					'limitation' => (int) $filtered_post['limitation'],
					'baby_chair' => $this->input->post('baby_chair')?1:0,
					'roof_rack' => $this->input->post('roof_rack')?1:0,
					'casco' => $this->input->post('casco')?1:0,
					'osago' => $this->input->post('osago')?1:0,
					'pincode' => (int) $filtered_post['pincode'],
					'createdate' => date('Y-m-d H:i:s')
			);

			$result = $this->universal_model->add_item($vars, 'rent_car');

			if ($result) {
				$this->universal_model->item_edit_save('rent_car_photo', array('rent_car_id' => 999999999), array('rent_car_id' => $result));
				redirect('/rent_admin/edit_car/'.$result.'?added=1');
			}
		}
	}

	public function edit_car($id = 0)
	{
		$id = (int) $id;
		$car_status = $this->rent_admin_model->get_car_status($id);

		if($this->input->post())
		{
			$this->load->library("template");
			$filtered_post = $this->filter_data($this->input->post());

			$vars = array(
				'class' => (int) $filtered_post['class'],
				'mark' => (int) $filtered_post['marka'],
				'model' => (int) $filtered_post['model'],
				'year' => (int) $filtered_post['year'],
				'city' => (int) $filtered_post['city'],
				'body' => (int) $filtered_post['car_body'],
				'fuel' => $filtered_post['fuel'],
				'transmission' => $filtered_post['transmission'],
				'color' => (int) $filtered_post['color'],
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
				'currency' => $filtered_post['valyuta'],
				'status' => (int) $filtered_post['status'],
				'price' => $this->input->post('price')?(int)$filtered_post['price']:0,
				'authorid' => (int) $filtered_post['author_id'],
				'reject_reason' => $filtered_post['reject_reason'],
				'included_km' => (int) $filtered_post['included_km'],
				'surcharge' => (int) $filtered_post['surcharge'],
				'insurance' => $this->input->post('insurance')?1:0,
				'deposit' => (int) $filtered_post['deposit'],
				'delivery' => $this->input->post('delivery')?1:0,
				'returning' => $this->input->post('returning')?1:0,
				'limitation' => (int) $filtered_post['limitation'],
				'baby_chair' => $this->input->post('baby_chair')?1:0,
				'roof_rack' => $this->input->post('roof_rack')?1:0,
				'casco' => $this->input->post('casco')?1:0,
				'osago' => $this->input->post('osago')?1:0
			);

			$status = (int) $filtered_post['status'];
			$mail_arr = $this->rent_admin_model->get_mail_by_carad_id($id);
			$mail = ($mail_arr)?$mail_arr->email:'';
			$elan_name = ($mail_arr)?strtolower(str_replace(' ', '-', $mail_arr->mark.'-'.$mail_arr->model.'-'.$mail_arr->year)):'auto';

			// print_r($vars);
			$result = $this->universal_model->item_edit_save('rent_car', array('id' => $id), $vars);

			if ($result)
			{
				$msg = '';

				if ($status == 1 && $car_status->status != 1) {
					$pin_arr = $this->universal_model->get_more_item_select_row('rent_car', 'pincode', array('id' => $id));
					$pin_code = $pin_arr?$pin_arr->pincode:'';

					$msg = '<a href="https://otomoto.az/pages/product/'.$elan_name.'/'.$id.'">Elanınız aktiv edildi</a>
									<br><br><br>
									<h3>Elanın pin kodu: '.$pin_code.'</h3><br>
									<h2><b>Otomoto</b></h2>';
				} else if ($status == 2 && $car_status->status != 2)
					$msg = '<span>'.$mail_arr->mark.' '.$mail_arr->model.' '.$mail_arr->year.' elanınız deaktiv edildi</span>
									<br><br><br>
									<h2><b>Otomoto</b></h2>';
				else if ($status == 3 && $car_status->status != 3)
					$msg = '<span>'.$mail_arr->mark.' '.$mail_arr->model.' '.$mail_arr->year.' elanınıza imtina edildi</span>
									<br><br>
									<h3>İmtina səbəbi: </h3>
									<span>'.$filtered_post['reject_reason'].'</span>
									<br><br><br>
									<h2><b>Otomoto</b></h2>';
				else if ($status == 4 && $car_status->status != 4)
					$msg = '<span>'.$mail_arr->mark.' '.$mail_arr->model.' '.$mail_arr->year.' elanınız silindi</span>
									<br><br><br>
									<h2><b>Otomoto</b></h2>';

				if($msg)
					$result2 = $this->template->send_mail("Otomoto", $msg, $mail);
				else
					$result2 = true;

				if ($result2)
					$data["status"] = array("status"=>"success", "title"=>"Success", "icon"=>"check-circle", "msg"=>"Elan uğurla yenilendi.");
				else
      		$data["status"] = array("status"=>"danger", "title"=>"Error", "icon"=>"exclamation-triangle", "msg"=>"Xəta baş verdi");
			}
			else
      		$data["status"] = array("status"=>"danger", "title"=>"Error", "icon"=>"exclamation-triangle", "msg"=>"Xəta baş verdi");
		}

		$data['car_data'] = $this->rent_admin_model->get_car_data($id);
		$data['classes'] = $this->universal_model->get_more_item_select('rent_class', 'id, class', 'active = 1');
		$data['mark'] = $this->universal_model->get_more_item_select('carmark', 'id, mark', array('active' => 1));
		$data['model'] = $this->universal_model->get_more_item_select('carmodel', 'id, model', array('active' => 1, 'markid' => $data['car_data']->mark));
		$data['city'] = $this->universal_model->get_more_item_select('elancities', 'id, ad', array('active' => 1));
		$data['body'] = $this->universal_model->get_more_item_select('carbody', 'id, body', array('active' => 1));
		$data['fuel'] = ['Benzin', 'Dizel', 'Qaz', 'Elektro', 'Hibrid'];
		$data['transmission'] = ['Mexaniki', 'Avtomat', 'Robotlaşdırılmış', 'Variator'];
		$data['color'] = $this->universal_model->get_more_item_select('carcolor', 'id, color', array('active' => 1));
		$data['added'] = ((int) $this->input->get('added') == 1)?1:0;
		$data['users'] = $this->universal_model->get_more_item_select('user', 'id, first_name, mobile', array('status' => 1));

		$this->home('rent_admin/edit_car', $data);
	}

	function generate_pin()
	{
		$val = $this->ran_num(5);
		$check = false;

		$array = $this->universal_model->select_result('rent_car', 'pincode');
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

	public function add_img()
  {
    if ($this->input->get("type"))
      $this->rent_ajax('/assets/img/rent_car_photos');
  }

	public function rent_log()
	{
    $data['user_list'] = $this->universal_model->get_more_item_select('user', 'id, first_name, mobile', array('status' => 1));

    $end = 30;
    if ($this->input->get())
      $filtered_get = $this->filter_data($this->input->get());

    $from = ($this->input->get('page'))?(int)$filtered_get['page']:0;
    $rent_car_id = $this->input->get('rent_car_id')?(int)$filtered_get['rent_car_id']:0;

    $base_url = "/rent_admin/rent_log";
    $data['log_list'] = $this->rent_admin_model->get_log_list($from, $end, $rent_car_id);
    $total = $this->rent_admin_model->get_log_list_row($rent_car_id);

    $data['total_row'] = $total->count;
    $data['rent_car_id'] = $rent_car_id;

    if ($total->count >= 1)
      $data["pagination"] = $this->pagination($from, $end, $base_url, $total->count, 3, 4);

		$this->home('rent_admin/rent_log', $data);
	}
}

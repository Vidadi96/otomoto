<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Users extends MY_Controller {
	function __construct()
	{
		parent::__construct();
		$this->is_logged_in();
		$this->check_role();
    $this->load->model('users_model');
    $this->load->model('universal_model');
	}

	public function add_user()
	{
		$name = $mail = $phone = '';
		$user_type = 0;

		if ($this->input->get('name'))
		{
			$filtered_get = $this->filter_data($this->input->get());

			$name = $filtered_get['name'];
			$mail = $filtered_get['mail'];
			$phone = $filtered_get['phone'];
			$user_type = (int) $filtered_get['user_type'];
		}

		$data['name'] = $name;
		$data['phone'] = $phone;
		$data['mail'] = $mail;
		$data['user_type'] = $user_type;

		$count = 30;
		$data['from'] = $from = $this->input->get('page')?(int)$this->input->get('page'):0;

    $base_url = "/users/add_user";
    $data['user_list'] = $this->users_model->get_user_list($from, $count, $name, $mail, $phone, $user_type);
    $total = $this->users_model->get_user_list_row($name, $mail, $phone, $user_type);

    if ($total->count >= 1)
      $data["pagination"] = $this->pagination($from, $count, $base_url, $total->count, 3, 4);

		$this->home('users/user_list', $data);
	}

	public function active_passive_autosalon()
	{
		if($this->input->post("id"))
		{
			$id = (int) $this->input->post('id');
			$active = (int) $this->input->post('active_passive');

			$result = $this->universal_model->item_edit_save('user', 'id='.$id, array('autosalon' => $active));

			if($result)
				echo '{"msg":"Dəyişdirildi", "'.($this->security->get_csrf_token_name()).'":"'.($this->security->get_csrf_hash()).'", "status":"success"}';
			else
				echo '{"msg":"Xəta", "'.($this->security->get_csrf_token_name()).'":"'.($this->security->get_csrf_hash()).'", "status":"error"}';
		}
	}

	public function active_passive_resmi()
	{
		if($this->input->post("id"))
		{
			$id = (int) $this->input->post('id');
			$active = (int) $this->input->post('active_passive');

			$result = $this->universal_model->item_edit_save('user', 'id='.$id, array('resmi' => $active));

			if($result)
				echo '{"msg":"Dəyişdirildi", "'.($this->security->get_csrf_token_name()).'":"'.($this->security->get_csrf_hash()).'", "status":"success"}';
			else
				echo '{"msg":"Xəta", "'.($this->security->get_csrf_token_name()).'":"'.($this->security->get_csrf_hash()).'", "status":"error"}';
		}
	}

	public function active_passive_unlimited()
	{
		if ($this->input->post("id"))
		{
			$id = (int) $this->input->post('id');
			$active = (int) $this->input->post('active_passive');

			$result = $this->universal_model->item_edit_save('user', 'id='.$id, array('unlimited' => $active));
			$this->users_model->get_cars_unlimited($id);

			if($result)
				echo '{"msg":"Dəyişdirildi", "'.($this->security->get_csrf_token_name()).'":"'.($this->security->get_csrf_hash()).'", "status":"success"}';
			else
				echo '{"msg":"Xəta", "'.($this->security->get_csrf_token_name()).'":"'.($this->security->get_csrf_hash()).'", "status":"error"}';
		}
	}

	public function delete_user()
	{
		if($this->input->post("id"))
		{
			$id = (int) $this->input->post('id');
			$check = $this->universal_model->get_more_item_select('carad', 'id', array('authorid' => $id, 'status' => 1, 'car_status' => 0));

			if ($check)
				echo '{"msg":"Aktiv elanları olan istifadəçini silə bilməzsiniz", "'.($this->security->get_csrf_token_name()).'":"'.($this->security->get_csrf_hash()).'", "status":"error"}';
			else {
				$result = $this->universal_model->delete_item('id='.$id, 'user');

				if($result)
					echo '{"msg":"Uğurla silindi", "'.($this->security->get_csrf_token_name()).'":"'.($this->security->get_csrf_hash()).'", "status":"success"}';
				else
					echo '{"msg":"Xəta baş verdi", "'.($this->security->get_csrf_token_name()).'":"'.($this->security->get_csrf_hash()).'", "status":"error"}';
			}
		}
	}

	public function add_balance()
	{
		if ($this->input->post())
		{
			$user_id = (int) $this->input->post('user_id');
			$salon = (int) $this->input->post('salon');
			$quantity = (float) $this->input->post('quantity');

			$vars = array(
				'amount' => $quantity,
				'authorid' => $user_id,
				'createdate' => date('Y-m-d H:i:s'),
				'action' => 3,
				'caradid' => 0,
				'active' => 1,
				'salon' => $salon
			);

			$result = $this->universal_model->add_item($vars, 'car_orders');

			echo $result?1:0;
		}
	}

	public function cng_pass()
	{
		if ($this->input->post())
		{
			$filtered_post = $this->filter_data($this->input->post());
			$user_id = (int) $filtered_post['user_id'];
			$password = $filtered_post['password'];

			$result = $this->universal_model->update_table('user', array('id' => $user_id), array('password' => md5($password)));
			echo $result?1:0;
		}
	}

}

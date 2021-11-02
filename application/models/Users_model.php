<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Users_model extends CI_Model
{
	function __construct()
  {
      parent::__construct();
  }

	function get_user_list($from, $count, $name, $mail, $phone, $user_type)
	{
		$where = '';
		$where .= $name?' and u.first_name like "%'.$name.'%"':'';
		$where .= $mail?' and u.email like "%'.$mail.'%"':'';
		$where .= $phone?' and (u.mobile like "%'.$phone.'%" or u.mobile2 like "%'.$phone.'%" or u.mobile3 like "%'.$phone.'%")':'';
		$where .= ($user_type == 2)?' and u.autosalon = 0':(($user_type == 1)?' and u.autosalon = 1':'');

		$query = 'SELECT u.id, u.first_name, u.email, u.unlimited, u.mobile, u.autosalon, u.resmi,
										 (IF(ISNULL(co.plus), 0, co.plus) - IF(ISNULL(co.minus), 0, co.minus)  - IF(ISNULL(co.ads), 0, co.ads)) as balans
							FROM user as u
							LEFT JOIN (SELECT authorid,
																SUM(CASE WHEN action in (3,5) THEN amount END) as plus,
																SUM(CASE WHEN action in (12, 13, 14, 15, 16, 17, 18, 19) THEN amount END) as minus,
																COALESCE(SUM(case when action in (4) and salon = 1 then amount END),0) as ads
												 FROM car_orders
												 WHERE active = 1
												 GROUP BY authorid) AS co ON co.authorid = u.id
							WHERE 1'.$where.'
							ORDER BY id desc
							LIMIT '.$from.', '.$count;

		return $this->db->query($query)->result();
	}

	function get_user_list_row($name, $mail, $phone, $user_type)
	{
		$where = '';
		$where .= $name?' and first_name like "%'.$name.'%"':'';
		$where .= $mail?' and email like "%'.$mail.'%"':'';
		$where .= $phone?' and (mobile like "%'.$phone.'%" or mobile2 like "%'.$phone.'%" or mobile3 like "%'.$phone.'%")':'';
		$where .= ($user_type == 2)?' and autosalon = 0':(($user_type == 1)?' and autosalon = 1':'');

		$query = 'SELECT count(*) as "count" FROM user WHERE 1'.$where;
		return $this->db->query($query)->row();
	}

	function get_cars_unlimited($user_id)
	{
		$query = 'UPDATE carad
							SET vip_update_date = "'.date('Y-m-d H:i:s').'", premium_update_date = "'.date('Y-m-d H:i:s').'"
							WHERE authorid = '.$user_id;

		$this->db->query($query);
	}

}

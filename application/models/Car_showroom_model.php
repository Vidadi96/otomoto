<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Car_showroom_model extends CI_Model
{
	function __construct()
  {
      parent::__construct();
  }

  function get_car_showroom_list($type)
  {
		$where = $type == 1?'is_rent = 0':'is_rent = 1';
		$table = $type == 1?'carad':'rent_car';

    $query = 'SELECT u.id, u.logo, u.shirketad, u.etraflimelumat, u.mobile, car.car_count, u.resmi FROM user as u
              LEFT JOIN (SELECT authorid, count(id) as "car_count" FROM '.$table.'
                         WHERE car_status = 0 and status = 1
                         GROUP BY authorid
                       ) as car on car.authorid = u.id
              WHERE u.status="1" and u.autosalon=1 and '.$where.'
							ORDER BY u.resmi desc, u.shirketad asc';

    return $this->db->query($query)->result();
  }

	public function get_showroom_data($id)
	{
		$query = 'SELECT u.id, u.logo, u.avatar, u.shirketad, u.etraflimelumat, m.*, u.mobile, u.mobile2, u.mobile3, u.ishgunleri, u.counter FROM user as u
							LEFT JOIN map as m on m.map_id = u.map_id
							WHERE u.id = '.$id;

		return $this->db->query($query)->row();
	}

	public function get_showroom_ads($where, $order_by)
	{
		$where_user = $this->session->userdata('uid')?' uid = '.$this->session->userdata('uid'):' tmp_user_id = '.$this->session->userdata('tmp_user');

		$query = 'SELECT cp.name as "image", city.ad as "city", CONCAT(mark.mark, " ", model.model) as "title", car.year, engine.engine, car.mileage,
										 IF(ISNULL(f.id), 0, f.beyen) as "favorit", car.id, car.price, car.agreement, car.currency, car.createdate, car.vip, car.premium, u.autosalon,
										 car.premium_date, car.vipdate, IF(ISNULL(au.id), 0, 1) as "on_auction"
							FROM carad as car
							LEFT JOIN (SELECT id, carad_id FROM auction WHERE status = 1) as au on au.carad_id = car.id
							LEFT JOIN (SELECT cp1.caradid, cp1.name FROM carphoto as cp1
                         LEFT JOIN (SELECT caradid, min(location) as location FROM carphoto WHERE active = 1 and deleted = 0 GROUP BY caradid) as cp2 on cp2.caradid = cp1.caradid
                         WHERE cp1.location = cp2.location and cp1.deleted = 0) as cp on cp.caradid = car.id
							LEFT JOIN (SELECT id, mark FROM carmark) as mark on mark.id = car.mark
							LEFT JOIN (SELECT id, model FROM carmodel) as model on model.id = car.model
							LEFT JOIN (SELECT id, ad FROM elancities) as city on city.id = car.city
							LEFT JOIN (SELECT id, pid, beyen FROM favorit
												 WHERE '.$where_user.') as f on f.pid = car.id
							LEFT JOIN (SELECT id, autosalon FROM user) as u on u.id = car.authorid
							LEFT JOIN (SELECT id, engine FROM carengine WHERE active=1) as engine on engine.id = car.engine
							WHERE car.status=1 and car.car_status=0 and '.$where.'
							GROUP BY car.id
							ORDER BY '.$order_by;

		return $this->db->query($query)->result();
	}

	public function get_rent_showroom_ads($where, $order_by)
	{
		$where_user = $this->session->userdata('uid')?' uid = '.$this->session->userdata('uid'):' tmp_user_id = '.$this->session->userdata('tmp_user');

		$query = 'SELECT cp.name as "image", city.ad as "city", CONCAT(mark.mark, " ", model.model) as "title", car.year, engine.engine, car.mileage,
										 IF(ISNULL(f.id), 0, f.beyen) as "favorit", car.id, car.price, car.currency, car.createdate, u.autosalon
							FROM rent_car as car
							LEFT JOIN (SELECT cp1.rent_car_id, cp1.name FROM rent_car_photo as cp1
                         LEFT JOIN (SELECT rent_car_id, min(location) as location FROM rent_car_photo WHERE active = 1 and deleted = 0 GROUP BY rent_car_id) as cp2 on cp2.rent_car_id = cp1.rent_car_id
                         WHERE cp1.location = cp2.location and cp1.deleted = 0) as cp on cp.rent_car_id = car.id
							LEFT JOIN (SELECT id, mark FROM carmark) as mark on mark.id = car.mark
							LEFT JOIN (SELECT id, model FROM carmodel) as model on model.id = car.model
							LEFT JOIN (SELECT id, ad FROM elancities) as city on city.id = car.city
							LEFT JOIN (SELECT id, pid, beyen FROM favorit
												 WHERE '.$where_user.') as f on f.pid = car.id
							LEFT JOIN (SELECT id, autosalon FROM user) as u on u.id = car.authorid
							LEFT JOIN (SELECT id, engine FROM carengine WHERE active=1) as engine on engine.id = car.engine
							WHERE car.status=1 and car.car_status=0 and '.$where.'
							GROUP BY car.id
							ORDER BY '.$order_by;

		return $this->db->query($query)->result();
	}
}

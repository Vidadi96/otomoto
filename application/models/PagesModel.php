<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class PagesModel extends CI_Model
{
	function __construct()
  {
      parent::__construct();
			// $this->db->query('SET TRANSACTION ISOLATION LEVEL READ UNCOMMITTED');
  }

	function get_cars_total_row()
	{
		$query = 'SELECT count(*) as "count" FROM carad
							WHERE status = 1';

		return $this->db->query($query)->row();
	}

	function get_rent_cars_total_row()
	{
		$query = 'SELECT count(*) as "count" FROM rent_car
							WHERE status = 1';

		return $this->db->query($query)->row();
	}

	function get_main_list($vars, $main_where, $limit)
	{
		$where = '';
		$where_user = $this->session->userdata('uid')?' uid = '.$this->session->userdata('uid'):' tmp_user_id = '.$this->session->userdata('tmp_user');

		$where .= $vars['mark']?' and car.mark in ('.$vars['mark'].')':'';
		$where .= $vars['model']?' and car.model in ('.$vars['model'].')':'';
		$where .= $vars['city']?' and car.city in ('.$vars['city'].')':'';
		$where .= $vars['body']?' and car.body in ('.$vars['body'].')':'';
		$where .= $vars['color']?' and car.color in ('.$vars['color'].')':'';
		$where .= $vars['fuel']?' and car.fuel in ('.$vars['fuel'].')':'';
		$where .= $vars['transmission']?' and car.transmission in ('.$vars['transmission'].')':'';
		$where .= $vars['drive']?' and car.drive in ('.$vars['drive'].')':'';

		$where .= $vars['currency']?' and car.currency = '.$vars['currency']:'';
		$where .= $vars['min_mileage']?' and car.mileage >= '.$vars['min_mileage']:'';
		$where .= $vars['max_mileage']?' and car.mileage < '.$vars['max_mileage']:'';
		$where .= $vars['min_price']?' and car.price >= '.$vars['min_price']:'';
		$where .= $vars['max_price']?' and car.price < '.$vars['max_price']:'';
		$where .= $vars['min_year']?' and car.year >= '.$vars['min_year']:'';
		$where .= $vars['max_year']?' and car.year <= '.$vars['max_year']:'';
		$where .= $vars['credit']?' and car.credit = 1':'';
		$where .= $vars['barter']?' and car.barter = 1':'';
		$where .= $vars['disk']?' and car.wheels = 1':'';
		$where .= $vars['radar']?' and car.parkingsensor = 1':'';
		$where .= $vars['camera']?' and car.camera = 1':'';
		$where .= $vars['qapanma']?' and car.centrallocking = 1':'';
		$where .= $vars['lampa']?' and car.xenon = 1':'';
		$where .= $vars['leather']?' and car.leather = 1':'';
		$where .= $vars['lyuk']?' and car.sunproof = 1':'';
		$where .= $vars['isidilme']?' and car.heatedseats = 1':'';
		$where .= $vars['abs']?' and car.abs = 1':'';
		$where .= $vars['kondisioner']?' and car.aircondition = 1':'';
		$where .= $vars['sensor']?' and car.parkingsensor = 1':'';
		$where .= $vars['havalandirma']?' and car.seatventilation = 1':'';
		$where .= $vars['perde']?' and car.sidecurtains = 1':'';
		$where .= $vars['esp']?' and car.esp = 1':'';
		$where .= $vars['min_engine']?' and engine.engine >= '.$vars['min_engine']:'';
		$where .= $vars['max_engine']?' and engine.engine < '.$vars['max_engine']:'';
		$order_by = $vars['order']?$vars['order']:'car.createdate desc'; //'IF((car.premium_update_date > 0 and car.premium_update_date > car.vip_update_date), car.premium_update_date, IF(car.vip_update_date > 0, car.vip_update_date, car.createdate)) desc';
		$order_by = ($order_by == 'createdate')?'car.createdate desc':$order_by; //'IF((car.premium_update_date > 0 and car.premium_update_date > car.vip_update_date), car.premium_update_date, IF(car.vip_update_date > 0, car.vip_update_date, car.createdate)) desc':$order_by;

		$query = 'SELECT cp.name as "image", city.ad as "city", CONCAT(mark.mark, " ", model.model) as "title", car.year, engine.engine, car.mileage,
										 IF(ISNULL(f.id), 0, f.beyen) as "favorit", car.id, car.price, car.agreement, car.currency, car.createdate, car.vip, car.premium, u.autosalon,
										 car.premium_date, car.vipdate, IF(ISNULL(au.id), 0, 1) as "on_auction", u.unlimited
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
							LEFT JOIN (SELECT id, autosalon, unlimited FROM user) as u on u.id = car.authorid
							LEFT JOIN (SELECT id, engine FROM carengine WHERE active=1) as engine on engine.id = car.engine
							WHERE status=1 and car_status is false '.$main_where.$where.'
							GROUP BY car.id
							ORDER BY '.$order_by.'
							LIMIT '.$limit;

		return $this->db->query($query)->result();
	}

	function get_rent_main_list($vars, $main_where, $limit)
	{
		$where = '';
		$where_user = $this->session->userdata('uid')?' uid = '.$this->session->userdata('uid'):' tmp_user_id = '.$this->session->userdata('tmp_user');

		$where .= $vars['mark']?' and car.mark in ('.$vars['mark'].')':'';
		$where .= $vars['model']?' and car.model in ('.$vars['model'].')':'';
		$where .= $vars['city']?' and car.city in ('.$vars['city'].')':'';
		$where .= $vars['body']?' and car.body in ('.$vars['body'].')':'';
		$where .= $vars['color']?' and car.color in ('.$vars['color'].')':'';
		$where .= $vars['fuel']?' and car.fuel in ('.$vars['fuel'].')':'';
		$where .= $vars['transmission']?' and car.transmission in ('.$vars['transmission'].')':'';

		$where .= $vars['class']?' and car.class = '.$vars['class']:'';
		$where .= $vars['currency']?' and car.currency = '.$vars['currency']:'';
		$where .= $vars['min_price']?' and car.price >= '.$vars['min_price']:'';
		$where .= $vars['max_price']?' and car.price < '.$vars['max_price']:'';
		$where .= $vars['min_year']?' and car.year >= '.$vars['min_year']:'';
		$where .= $vars['max_year']?' and car.year <= '.$vars['max_year']:'';
		$where .= $vars['min_included_km']?' and car.included_km >= '.$vars['min_included_km']:'';
		$where .= $vars['max_included_km']?' and car.included_km <= '.$vars['max_included_km']:'';
		$where .= $vars['min_deposit']?' and car.deposit >= '.$vars['min_deposit']:'';
		$where .= $vars['max_deposit']?' and car.deposit <= '.$vars['max_deposit']:'';
		$where .= $vars['min_limitation']?' and car.limitation >= '.$vars['min_limitation']:'';
		$where .= $vars['max_limitation']?' and car.limitation <= '.$vars['max_limitation']:'';
		$where .= $vars['disk']?' and car.wheels = 1':'';
		$where .= $vars['radar']?' and car.parkingsensor = 1':'';
		$where .= $vars['camera']?' and car.camera = 1':'';
		$where .= $vars['qapanma']?' and car.centrallocking = 1':'';
		$where .= $vars['lampa']?' and car.xenon = 1':'';
		$where .= $vars['leather']?' and car.leather = 1':'';
		$where .= $vars['lyuk']?' and car.sunproof = 1':'';
		$where .= $vars['isidilme']?' and car.heatedseats = 1':'';
		$where .= $vars['abs']?' and car.abs = 1':'';
		$where .= $vars['kondisioner']?' and car.aircondition = 1':'';
		$where .= $vars['sensor']?' and car.parkingsensor = 1':'';
		$where .= $vars['havalandirma']?' and car.seatventilation = 1':'';
		$where .= $vars['perde']?' and car.sidecurtains = 1':'';
		$where .= $vars['esp']?' and car.esp = 1':'';
		$where .= $vars['insurance']?' and car.insurance = 1':'';
		$where .= $vars['roof_rack']?' and car.roof_rack = 1':'';
		$where .= $vars['baby_chair']?' and car.baby_chair = 1':'';
		$where .= $vars['delivery']?' and car.delivery = 1':'';
		$where .= $vars['returning']?' and car.returning = 1':'';
		$order_by = $vars['order']?$vars['order']:'IF((car.premium_update_date > 0 and car.premium_update_date > car.vip_update_date), car.premium_update_date, IF(car.vip_update_date > 0, car.vip_update_date, car.createdate)) desc';
		$order_by = ($order_by == 'createdate')?'IF((car.premium_update_date > 0 and car.premium_update_date > car.vip_update_date), car.premium_update_date, IF(car.vip_update_date > 0, car.vip_update_date, car.createdate)) desc':$order_by;

		$query = 'SELECT cp.name as "image", city.ad as "city", CONCAT(mark.mark, " ", model.model) as "title", car.year, engine.engine, car.mileage,
										 IF(ISNULL(f.id), 0, f.beyen) as "favorit", car.id, car.price, car.currency, car.createdate, u.autosalon, car.vip, car.premium
							FROM rent_car as car
							LEFT JOIN (SELECT id, carad_id FROM auction WHERE status = 1) as au on au.carad_id = car.id
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
							WHERE status=1 and car_status is false '.$main_where.$where.'
							GROUP BY car.id
							ORDER BY '.$order_by.'
							LIMIT '.$limit;

		return $this->db->query($query)->result();
	}

	function get_main_list_top($vars, $main_where, $limit, $order)
	{
		$where = '';
		$where_user = $this->session->userdata('uid')?' uid = '.$this->session->userdata('uid'):' tmp_user_id = '.$this->session->userdata('tmp_user');

		$where .= $vars['mark']?' and car.mark in ('.$vars['mark'].')':'';
		$where .= $vars['model']?' and car.model in ('.$vars['model'].')':'';
		$where .= $vars['city']?' and car.city in ('.$vars['city'].')':'';
		$where .= $vars['body']?' and car.body in ('.$vars['body'].')':'';
		$where .= $vars['color']?' and car.color in ('.$vars['color'].')':'';
		$where .= $vars['fuel']?' and car.fuel in ('.$vars['fuel'].')':'';
		$where .= $vars['transmission']?' and car.transmission in ('.$vars['transmission'].')':'';
		$where .= $vars['drive']?' and car.drive in ('.$vars['drive'].')':'';

		$where .= $vars['currency']?' and car.currency = '.$vars['currency']:'';
		$where .= $vars['min_mileage']?' and car.mileage >= '.$vars['min_mileage']:'';
		$where .= $vars['max_mileage']?' and car.mileage < '.$vars['max_mileage']:'';
		$where .= $vars['min_price']?' and car.price >= '.$vars['min_price']:'';
		$where .= $vars['max_price']?' and car.price < '.$vars['max_price']:'';
		$where .= $vars['min_year']?' and car.year >= '.$vars['min_year']:'';
		$where .= $vars['max_year']?' and car.year <= '.$vars['max_year']:'';
		$where .= $vars['credit']?' and car.credit = 1':'';
		$where .= $vars['barter']?' and car.barter = 1':'';
		$where .= $vars['disk']?' and car.wheels = 1':'';
		$where .= $vars['radar']?' and car.parkingsensor = 1':'';
		$where .= $vars['camera']?' and car.camera = 1':'';
		$where .= $vars['qapanma']?' and car.centrallocking = 1':'';
		$where .= $vars['lampa']?' and car.xenon = 1':'';
		$where .= $vars['leather']?' and car.leather = 1':'';
		$where .= $vars['lyuk']?' and car.sunproof = 1':'';
		$where .= $vars['isidilme']?' and car.heatedseats = 1':'';
		$where .= $vars['abs']?' and car.abs = 1':'';
		$where .= $vars['kondisioner']?' and car.aircondition = 1':'';
		$where .= $vars['sensor']?' and car.parkingsensor = 1':'';
		$where .= $vars['havalandirma']?' and car.seatventilation = 1':'';
		$where .= $vars['perde']?' and car.sidecurtains = 1':'';
		$where .= $vars['esp']?' and car.esp = 1':'';
		$where .= $vars['min_engine']?' and engine.engine >= '.$vars['min_engine']:'';
		$where .= $vars['max_engine']?' and engine.engine < '.$vars['max_engine']:'';

		$query = 'SELECT cp.name as "image", city.ad as "city", CONCAT(mark.mark, " ", model.model) as "title",
										 IF(ISNULL(f.id), 0, f.beyen) as "favorit", car.id, car.price, car.agreement, car.currency, car.createdate,
										 car.vip, car.premium, u.autosalon, car.year, engine.engine, car.mileage,
										 car.premium_date, car.vipdate, IF(ISNULL(au.id), 0, 1) as "on_auction", u.unlimited
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
							LEFT JOIN (SELECT id, autosalon, unlimited FROM user) as u on u.id = car.authorid
							LEFT JOIN (SELECT id, engine FROM carengine WHERE active=1) as engine on engine.id = car.engine
							WHERE status=1 and car_status=0'.$main_where.$where.'
							GROUP BY car.id
							ORDER BY '.$order.'
							LIMIT '.$limit;

		return $this->db->query($query)->result();
	}

	function get_rent_main_list_top($vars, $main_where, $limit, $order)
	{
		$where = '';
		$where_user = $this->session->userdata('uid')?' uid = '.$this->session->userdata('uid'):' tmp_user_id = '.$this->session->userdata('tmp_user');

		$where .= $vars['mark']?' and car.mark in ('.$vars['mark'].')':'';
		$where .= $vars['model']?' and car.model in ('.$vars['model'].')':'';
		$where .= $vars['city']?' and car.city in ('.$vars['city'].')':'';
		$where .= $vars['body']?' and car.body in ('.$vars['body'].')':'';
		$where .= $vars['color']?' and car.color in ('.$vars['color'].')':'';
		$where .= $vars['fuel']?' and car.fuel in ('.$vars['fuel'].')':'';
		$where .= $vars['transmission']?' and car.transmission in ('.$vars['transmission'].')':'';

		$where .= $vars['class']?' and car.class = '.$vars['class']:'';
		$where .= $vars['currency']?' and car.currency = '.$vars['currency']:'';
		$where .= $vars['min_price']?' and car.price >= '.$vars['min_price']:'';
		$where .= $vars['max_price']?' and car.price < '.$vars['max_price']:'';
		$where .= $vars['min_year']?' and car.year >= '.$vars['min_year']:'';
		$where .= $vars['max_year']?' and car.year <= '.$vars['max_year']:'';
		$where .= $vars['min_included_km']?' and car.included_km >= '.$vars['min_included_km']:'';
		$where .= $vars['max_included_km']?' and car.included_km <= '.$vars['max_included_km']:'';
		$where .= $vars['min_deposit']?' and car.deposit >= '.$vars['min_deposit']:'';
		$where .= $vars['max_deposit']?' and car.deposit <= '.$vars['max_deposit']:'';
		$where .= $vars['min_limitation']?' and car.limitation >= '.$vars['min_limitation']:'';
		$where .= $vars['max_limitation']?' and car.limitation <= '.$vars['max_limitation']:'';
		$where .= $vars['disk']?' and car.wheels = 1':'';
		$where .= $vars['radar']?' and car.parkingsensor = 1':'';
		$where .= $vars['camera']?' and car.camera = 1':'';
		$where .= $vars['qapanma']?' and car.centrallocking = 1':'';
		$where .= $vars['lampa']?' and car.xenon = 1':'';
		$where .= $vars['leather']?' and car.leather = 1':'';
		$where .= $vars['lyuk']?' and car.sunproof = 1':'';
		$where .= $vars['isidilme']?' and car.heatedseats = 1':'';
		$where .= $vars['abs']?' and car.abs = 1':'';
		$where .= $vars['kondisioner']?' and car.aircondition = 1':'';
		$where .= $vars['sensor']?' and car.parkingsensor = 1':'';
		$where .= $vars['havalandirma']?' and car.seatventilation = 1':'';
		$where .= $vars['perde']?' and car.sidecurtains = 1':'';
		$where .= $vars['esp']?' and car.esp = 1':'';
		$where .= $vars['insurance']?' and car.insurance = 1':'';
		$where .= $vars['roof_rack']?' and car.roof_rack = 1':'';
		$where .= $vars['baby_chair']?' and car.baby_chair = 1':'';
		$where .= $vars['delivery']?' and car.delivery = 1':'';
		$where .= $vars['returning']?' and car.returning = 1':'';

		$query = 'SELECT cp.name as "image", city.ad as "city_name", CONCAT(mark.mark, " ", model.model) as "title",
										 IF(ISNULL(f.id), 0, f.beyen) as "favorit", u.autosalon, engine.engine, car.*
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
							WHERE status=1 and car_status=0'.$main_where.$where.'
							GROUP BY car.id
							ORDER BY '.$order.'
							LIMIT '.$limit;

		return $this->db->query($query)->result();
	}

	function get_main_list_count($vars, $main_where)
	{
		$where = '';

		$where .= $vars['mark']?' and car.mark in ('.$vars['mark'].')':'';
		$where .= $vars['model']?' and car.model in ('.$vars['model'].')':'';
		$where .= $vars['city']?' and car.city in ('.$vars['city'].')':'';
		$where .= $vars['body']?' and car.body in ('.$vars['body'].')':'';
		$where .= $vars['color']?' and car.color in ('.$vars['color'].')':'';
		$where .= $vars['fuel']?' and car.fuel in ('.$vars['fuel'].')':'';
		$where .= $vars['transmission']?' and car.transmission in ('.$vars['transmission'].')':'';
		$where .= $vars['drive']?' and car.drive in ('.$vars['drive'].')':'';

		$where .= $vars['currency']?' and car.currency = '.$vars['currency']:'';
		$where .= $vars['min_mileage']?' and car.mileage >= '.$vars['min_mileage']:'';
		$where .= $vars['max_mileage']?' and car.mileage < '.$vars['max_mileage']:'';
		$where .= $vars['min_price']?' and car.price >= '.$vars['min_price']:'';
		$where .= $vars['max_price']?' and car.price < '.$vars['max_price']:'';
		$where .= $vars['min_year']?' and car.year >= '.$vars['min_year']:'';
		$where .= $vars['max_year']?' and car.year <= '.$vars['max_year']:'';
		$where .= $vars['credit']?' and car.credit = 1':'';
		$where .= $vars['barter']?' and car.barter = 1':'';
		$where .= $vars['disk']?' and car.wheels = 1':'';
		$where .= $vars['radar']?' and car.parkingsensor = 1':'';
		$where .= $vars['camera']?' and car.camera = 1':'';
		$where .= $vars['qapanma']?' and car.centrallocking = 1':'';
		$where .= $vars['lampa']?' and car.xenon = 1':'';
		$where .= $vars['leather']?' and car.leather = 1':'';
		$where .= $vars['lyuk']?' and car.sunproof = 1':'';
		$where .= $vars['isidilme']?' and car.heatedseats = 1':'';
		$where .= $vars['abs']?' and car.abs = 1':'';
		$where .= $vars['kondisioner']?' and car.aircondition = 1':'';
		$where .= $vars['sensor']?' and car.parkingsensor = 1':'';
		$where .= $vars['havalandirma']?' and car.seatventilation = 1':'';
		$where .= $vars['perde']?' and car.sidecurtains = 1':'';
		$where .= $vars['esp']?' and car.esp = 1':'';
		$where .= $vars['min_engine']?' and engine.engine >= '.$vars['min_engine']:'';
		$where .= $vars['max_engine']?' and engine.engine < '.$vars['max_engine']:'';

		$query = 'SELECT count(*) as "count" FROM carad as car
							LEFT JOIN (SELECT id, engine FROM carengine WHERE active=1) as engine on engine.id = car.engine
							LEFT JOIN (SELECT id, unlimited FROM user) as u on u.id = car.authorid
							WHERE status=1 and car_status=0'.$main_where.$where;

		return $this->db->query($query)->row();
	}

	function get_rent_main_list_count($vars, $main_where)
	{
		$where = '';

		$where .= $vars['mark']?' and car.mark in ('.$vars['mark'].')':'';
		$where .= $vars['model']?' and car.model in ('.$vars['model'].')':'';
		$where .= $vars['city']?' and car.city in ('.$vars['city'].')':'';
		$where .= $vars['body']?' and car.body in ('.$vars['body'].')':'';
		$where .= $vars['color']?' and car.color in ('.$vars['color'].')':'';
		$where .= $vars['fuel']?' and car.fuel in ('.$vars['fuel'].')':'';
		$where .= $vars['transmission']?' and car.transmission in ('.$vars['transmission'].')':'';

		$where .= $vars['class']?' and car.class = '.$vars['class']:'';
		$where .= $vars['currency']?' and car.currency = '.$vars['currency']:'';
		$where .= $vars['min_price']?' and car.price >= '.$vars['min_price']:'';
		$where .= $vars['max_price']?' and car.price < '.$vars['max_price']:'';
		$where .= $vars['min_year']?' and car.year >= '.$vars['min_year']:'';
		$where .= $vars['max_year']?' and car.year <= '.$vars['max_year']:'';
		$where .= $vars['min_included_km']?' and car.included_km >= '.$vars['min_included_km']:'';
		$where .= $vars['max_included_km']?' and car.included_km <= '.$vars['max_included_km']:'';
		$where .= $vars['min_deposit']?' and car.deposit >= '.$vars['min_deposit']:'';
		$where .= $vars['max_deposit']?' and car.deposit <= '.$vars['max_deposit']:'';
		$where .= $vars['min_limitation']?' and car.limitation >= '.$vars['min_limitation']:'';
		$where .= $vars['max_limitation']?' and car.limitation <= '.$vars['max_limitation']:'';
		$where .= $vars['disk']?' and car.wheels = 1':'';
		$where .= $vars['radar']?' and car.parkingsensor = 1':'';
		$where .= $vars['camera']?' and car.camera = 1':'';
		$where .= $vars['qapanma']?' and car.centrallocking = 1':'';
		$where .= $vars['lampa']?' and car.xenon = 1':'';
		$where .= $vars['leather']?' and car.leather = 1':'';
		$where .= $vars['lyuk']?' and car.sunproof = 1':'';
		$where .= $vars['isidilme']?' and car.heatedseats = 1':'';
		$where .= $vars['abs']?' and car.abs = 1':'';
		$where .= $vars['kondisioner']?' and car.aircondition = 1':'';
		$where .= $vars['sensor']?' and car.parkingsensor = 1':'';
		$where .= $vars['havalandirma']?' and car.seatventilation = 1':'';
		$where .= $vars['perde']?' and car.sidecurtains = 1':'';
		$where .= $vars['esp']?' and car.esp = 1':'';
		$where .= $vars['insurance']?' and car.insurance = 1':'';
		$where .= $vars['roof_rack']?' and car.roof_rack = 1':'';
		$where .= $vars['baby_chair']?' and car.baby_chair = 1':'';
		$where .= $vars['delivery']?' and car.delivery = 1':'';
		$where .= $vars['returning']?' and car.returning = 1':'';

		$query = 'SELECT count(*) as "count" FROM rent_car as car
							LEFT JOIN (SELECT id, engine FROM carengine WHERE active=1) as engine on engine.id = car.engine
							WHERE status=1 and car_status=0'.$main_where.$where;

		return $this->db->query($query)->row();
	}

	public function get_product_data($id)
	{
		$where_user = $this->session->userdata('uid')?' uid = '.$this->session->userdata('uid'):' tmp_user_id = '.$this->session->userdata('tmp_user');

		$query = 'SELECT car.additionalinfo, city.ad as "city", CONCAT(mark.mark, " ", model.model) as "title",
										 IF(ISNULL(f.id), 0, f.beyen) as "favorit", car.id, car.price, car.agreement, car.currency, car.createdate, car.vip, car.premium, u.autosalon, u.first_name, u.mobile,
										 mark.mark, model.model, car.year, b.body, col.color, incol.interiorcolor, car.horsepower, car.fuel, car.transmission, car.drive, car.mileage, e.engine,
										 car.wheels, car.parkingsensor, car.camera, car.centrallocking, car.xenon, car.leather, car.sunproof, car.heatedseats, car.abs, car.aircondition, car.rainsensor,
										 car.seatventilation, car.sidecurtains, car.esp, car.credit, car.barter, car.mark as "mark_id", car.model as "model_id", car.counter, car.id, car.authorid,
										 IF(ISNULL(au.id), 0, 1) AS "on_auction", au.id as "auction_id", au.carad_id, au.discount, au.period, au.participants, au.phone_show, au.create_date
							FROM carad as car
							LEFT JOIN (SELECT * FROM auction WHERE status = 1) AS au ON au.carad_id = car.id
							LEFT JOIN (SELECT id, mark FROM carmark) as mark on mark.id = car.mark
							LEFT JOIN (SELECT id, model FROM carmodel) as model on model.id = car.model
							LEFT JOIN (SELECT id, ad FROM elancities) as city on city.id = car.city
							LEFT JOIN (SELECT id, body FROM carbody) as b on b.id = car.body
							LEFT JOIN (SELECT id, color FROM carcolor) as col on col.id = car.color
							LEFT JOIN (SELECT id, interiorcolor FROM carinteriorcolor) as incol on incol.id = car.interiorcolor
							LEFT JOIN (SELECT id, pid, beyen FROM favorit
												 WHERE '.$where_user.') as f on f.pid = car.id
							LEFT JOIN (SELECT id, first_name, mobile, autosalon FROM user) as u on u.id = car.authorid
							LEFT JOIN (SELECT id, engine FROM carengine WHERE active=1) as e on e.id = car.engine
							WHERE car.id = '.$id;

		return $this->db->query($query)->row();
	}

	public function get_rent_product_data($id)
	{
		$where_user = $this->session->userdata('uid')?' uid = '.$this->session->userdata('uid'):' tmp_user_id = '.$this->session->userdata('tmp_user');

		$query = 'SELECT car.additionalinfo, city.ad as "city", CONCAT(mark.mark, " ", model.model) as "title", class.class,
										 IF(ISNULL(f.id), 0, f.beyen) as "favorit", car.id, car.price, car.currency, car.createdate, car.vip, car.premium, u.autosalon, u.first_name, u.mobile, u.email,
										 mark.mark, model.model, car.year, b.body, col.color, incol.interiorcolor, car.fuel, car.transmission,
										 car.wheels, car.parkingsensor, car.camera, car.centrallocking, car.xenon, car.leather, car.sunproof, car.heatedseats, car.abs, car.aircondition, car.rainsensor,
										 car.seatventilation, car.sidecurtains, car.esp, car.returning, car.delivery, car.baby_chair,  car.mark as "mark_id", car.model as "model_id", car.counter, car.id, car.authorid,
										 car.roof_rack, car.limitation, car.surcharge, car.insurance, car.included_km, car.deposit
							FROM rent_car as car
							LEFT JOIN (SELECT id, mark FROM carmark) as mark on mark.id = car.mark
							LEFT JOIN (SELECT id, model FROM carmodel) as model on model.id = car.model
							LEFT JOIN (SELECT id, class FROM rent_class) as class on class.id = car.class
							LEFT JOIN (SELECT id, ad FROM elancities) as city on city.id = car.city
							LEFT JOIN (SELECT id, body FROM carbody) as b on b.id = car.body
							LEFT JOIN (SELECT id, color FROM carcolor) as col on col.id = car.color
							LEFT JOIN (SELECT id, interiorcolor FROM carinteriorcolor) as incol on incol.id = car.interiorcolor
							LEFT JOIN (SELECT id, pid, beyen FROM favorit
												 WHERE '.$where_user.') as f on f.pid = car.id
							LEFT JOIN (SELECT id, first_name, mobile, autosalon, email FROM user) as u on u.id = car.authorid
							LEFT JOIN (SELECT id, engine FROM carengine WHERE active=1) as e on e.id = car.engine
							WHERE car.id = '.$id;

		return $this->db->query($query)->row();
	}

	public function get_similar_ads($where, $limit)
	{
		$where_user = $this->session->userdata('uid')?' uid = '.$this->session->userdata('uid'):' tmp_user_id = '.$this->session->userdata('tmp_user');

		$query = 'SELECT cp.name as "image", city.ad as "city", CONCAT(mark.mark, " ", model.model) as "title",
										 IF(ISNULL(f.id), 0, f.beyen) as "favorit", car.id, car.price, car.agreement, car.currency, car.createdate, car.vip, car.premium, u.autosalon,
										 car.premium_date, car.vipdate, IF(ISNULL(au.id), 0, 1) as "on_auction", car.year, engine.engine, car.mileage
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
							ORDER BY car.createdate desc
							LIMIT '.$limit;

		return $this->db->query($query)->result();
	}

	public function get_rent_similar_ads($where, $limit)
	{
		$where_user = $this->session->userdata('uid')?' uid = '.$this->session->userdata('uid'):' tmp_user_id = '.$this->session->userdata('tmp_user');

		$query = 'SELECT cp.name as "image", city.ad as "city", CONCAT(mark.mark, " ", model.model) as "title",
										 IF(ISNULL(f.id), 0, f.beyen) as "favorit", car.id, car.price, car.currency, car.createdate,
										 u.autosalon, car.year
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
							ORDER BY car.createdate desc
							LIMIT '.$limit;

		return $this->db->query($query)->result();
	}

	public function get_similar_ads_count($where)
	{
		$query = 'SELECT count(*) as "count" FROM carad as car
							WHERE car.status=1 and car.car_status=0 and '.$where;

		return $this->db->query($query)->row();
	}

	public function get_rent_similar_ads_count($where)
	{
		$query = 'SELECT count(*) as "count" FROM rent_car as car
							WHERE car.status=1 and car.car_status=0 and '.$where;

		return $this->db->query($query)->row();
	}

	public function get_showroom_data($id)
	{
		$query = 'SELECT u.id, u.logo, u.shirketad, u.etraflimelumat, m.*, u.mobile, u.mobile2, u.mobile3, u.ishgunleri FROM user as u
							LEFT JOIN map as m on m.map_id = u.map_id
							WHERE u.id = '.$id;

		return $this->db->query($query)->row();
	}

	public function edit_with_pin_data($id)
	{
		$query = "SELECT * FROM carads_view
							WHERE id=".(int)$id." and (status = 1 or status = 0)";

		return $this->db->query($query)->result_array();
	}

	public function get_marks($where)
	{
		$query = 'SELECT m.id, m.img, m.mark, c.count FROM carmark as m
							LEFT JOIN (SELECT count(mark) as "count", mark FROM carad
												 WHERE status = 1 and car_status = 0
											 	 GROUP BY mark) as c on c.mark = m.id
							WHERE m.active = 1 '.$where.'
							ORDER BY m.mark';

		return $this->db->query($query)->result();
	}

	public function get_model_list($mark)
	{
		$query = 'SELECT m.id, m.model, c.count FROM carmodel as m
							LEFT JOIN (SELECT count(model) as "count", model FROM carad
												 WHERE status = 1 and car_status = 0
											 	 GROUP BY model) as c on c.model = m.id
							WHERE m.active = 1 and markid = '.$mark.'
							ORDER BY m.model';

		return $this->db->query($query)->result();
	}

	public function get_rent_model_list($mark)
	{
		$query = 'SELECT m.id, m.model, c.count FROM carmodel as m
							LEFT JOIN (SELECT count(model) as "count", model FROM rent_car
												 WHERE status = 1 and car_status = 0
											 	 GROUP BY model) as c on c.model = m.id
							WHERE m.active = 1 and markid = '.$mark.'
							ORDER BY m.model';

		return $this->db->query($query)->result();
	}

	public function get_classes()
	{
		$query = 'SELECT rcl.id, rcl.class, rcl.img, count(rc.class) as "count" FROM rent_class as rcl
							LEFT JOIN (SELECT class FROM rent_car
												 WHERE status = 1 and car_status = 0
											 	) as rc on rc.class = rcl.id
							WHERE rcl.active = 1
							GROUP BY rcl.id';

		return $this->db->query($query)->result();
	}

	public function get_rent_mark_list($class)
	{
		$query = 'SELECT mark.id, mark.mark, count(rc.mark) as "count" FROM rent_car as rc
							LEFT JOIN (SELECT id, mark FROM carmark) as mark on mark.id  = rc.mark
							WHERE rc.class = '.$class.' and rc.status = 1 and rc.car_status = 0
							GROUP BY rc.mark
							ORDER BY mark.mark';

		return $this->db->query($query)->result();
	}

	public function get_year_list($mark, $model)
	{
		$where = $model?' and model = '.$model:'';

		$query = 'SELECT year, count(year) as "count" FROM `carad`
							WHERE mark = '.$mark.$where.' and status = 1 and car_status = 0
							GROUP BY year
							ORDER BY year asc';

		return $this->db->query($query)->result();
	}

	public function get_rent_year_list($mark, $model)
	{
		$where = $model?' and model = '.$model:'';

		$query = 'SELECT year, count(year) as "count" FROM `rent_car`
							WHERE mark = '.$mark.$where.' and status = 1 and car_status = 0
							GROUP BY year
							ORDER BY year asc';

		return $this->db->query($query)->result();
	}

	public function get_favourite($where, $order_by)
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

	public function get_auction_cars($where, $order_by)
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
							WHERE car.status=1 and car.car_status=0 and au.id is not null and '.$where.'
							GROUP BY car.id
							ORDER BY '.$order_by;

		return $this->db->query($query)->result();
	}

	public function get_participants_count($id)
	{
		$query = 'SELECT DISTINCT(phone) as "user_id" FROM auction_offers
							WHERE auction_id = '.$id;

		return $this->db->query($query)->result();
	}

	public function get_auction_offers($id)
	{
		$query = 'SELECT ao.*, u.first_name FROM auction_offers as ao
							LEFT JOIN (SELECT id, first_name FROM user) as u ON u.id = ao.user_id
							WHERE ao.auction_id = '.$id.'
							ORDER BY ao.offer_date desc';

		return $this->db->query($query)->result();
	}

	public function get_last_price($auction_id)
	{
		$query = 'SELECT MAX(offer_price) as "last_price" FROM auction_offers
							WHERE auction_id = '.$auction_id;

		return $this->db->query($query)->row();
	}

	public function get_auction_users($auction_id)
	{
		$query = 'SELECT user_id FROM auction_offers
							WHERE auction_id = '.$auction_id.'
							ORDER BY offer_date desc
							LIMIT 5';

		return $this->db->query($query)->result();
	}

	public function get_appraisement_mark_list()
	{
		$query = 'SELECT distinct(ap.mark) as "ap_mark", m.mark, m.img as "img" FROM appraisement as ap
							LEFT JOIN (SELECT mark, img FROM carmark) as m ON ap.mark = m.mark';

		return $this->db->query($query)->result();
	}

	public function get_appraisement_model_list($mark)
	{
		$query = 'SELECT distinct(model) as "model" FROM appraisement
							WHERE mark = "'.$mark.'"';

		return $this->db->query($query)->result();
	}

	public function get_appraisement_year_list($mark, $model)
	{
		$query = 'SELECT distinct(year) as "year" FROM appraisement
							WHERE mark = "'.$mark.'" and model="'.$model.'"
							ORDER BY year asc';

		return $this->db->query($query)->result();
	}

	public function get_appraisement_result($mark, $model, $year)
	{
		$query = 'SELECT price, currency FROM appraisement
							WHERE mark = "'.$mark.'" and model="'.$model.'" and year = '.$year;

		return $this->db->query($query)->result();
	}

	public function auto_check_appraisement()
	{
		$query1 = 'DELETE FROM appraisement
							 WHERE carad_id !=0 and carad_id not in
							 (SELECT id FROM carad WHERE status = 1 and car_status = 0)';

		$query2 = 'INSERT INTO appraisement (mark, model, year, price, currency, carad_id)
							 SELECT UPPER(mark.mark) as "mark", UPPER(model.model) as "model", c.year, c.price, c.currency, c.id FROM carad as c
							 LEFT JOIN (SELECT carad_id FROM appraisement) as ap ON ap.carad_id = c.id
							 LEFT JOIN (SELECT id, mark FROM carmark) as mark ON mark.id = c.mark
							 LEFT JOIN (SELECT id, model FROM carmodel) as model ON model.id = c.model
							 WHERE c.status = 1 and c.car_status = 0 and ap.carad_id is null';

		$this->db->query($query1);
		$this->db->query($query2);
	}

	public function prosto_func()
	{
		$sql = "SELECT car.id AS 'id', car.vip AS 'vip', car.vipdate AS 'vipdate', car.premium AS 'premium',
									 car.premium_date AS 'premium_date', car.status AS 'status', car.reject_reason AS 'reject_reason',
									 car.car_status AS 'car_status', car.authorid AS 'authorid', car.mark AS 'mark', car.model AS 'model',
									 car.year AS 'year', car.city AS 'city', car.body AS 'body', car.mileage AS 'mileage',
									 car.fuel AS 'fuel', car.engine AS 'engine', car.transmission AS 'transmission', car.drive AS 'drive',
									 car.color AS 'color', car.interiorcolor AS 'interiorcolor', car.credit AS 'credit', car.barter AS 'barter',
									 car.horsepower AS 'horsepower', car.wheels AS 'wheels', car.leather AS 'leather', car.parkingsensor AS 'parkingsensor',
									 car.sunproof AS 'sunproof', car.camera AS 'camera', car.heatedseats AS 'heatedseats',
									 car.centrallocking AS 'centrallocking', car.abs AS 'abs', car.xenon AS 'xenon', car.aircondition AS 'aircondition',
									 car.rainsensor AS 'rainsensor', car.sidecurtains AS 'sidecurtains', car.seatventilation AS 'seatventilation',
									 car.esp AS 'esp', car.youtubelink AS 'youtubelink', car.additionalinfo AS 'additionalinfo',
									 car.price AS 'price', car.agreement AS 'agreement', car.currency AS 'currency', car.pincode AS 'pincode',
									 car.counter AS 'counter', car.favourite AS 'favourite', car.createdate AS 'createdate', en.engine AS 'enginename',
									 mark.mark AS 'markname', model.model AS 'modelname', cp.name AS 'image', u.first_name AS 'user',
									 ph.photocount AS 'photocount'
					  FROM u1023543_pent.carad as car
						LEFT JOIN (SELECT cp1.caradid AS 'caradid', cp1.name AS 'name' FROM u1023543_pent.carphoto as cp1
											 LEFT JOIN (SELECT caradid, min(location) as location FROM u1023543_pent.carphoto WHERE active = 1 and deleted = 0 GROUP BY caradid) as cp2 on cp2.caradid = cp1.caradid
											 WHERE cp1.location = cp2.location and cp1.deleted = 0) as cp on cp.caradid = car.id
						LEFT JOIN (SELECT u1023543_pent.user.id AS 'id', u1023543_pent.user.first_name AS `first_name` FROM u1023543_pent.user) as u on u.id = car.authorid
						LEFT JOIN (SELECT u1023543_pent.carmark.id AS `id`, u1023543_pent.carmark.mark AS `mark` FROM u1023543_pent.carmark) as mark on mark.id = car.mark
						LEFT JOIN (SELECT u1023543_pent.carmodel.id AS `id`, u1023543_pent.carmodel.model AS `model` FROM u1023543_pent.carmodel) as model on model.id = car.model
						LEFT JOIN u1023543_pent.carengine as en on en.id = car.engine
						LEFT JOIN (SELECT u1023543_pent.carphoto.caradid AS `caradid`, count(u1023543_pent.carphoto.caradid) AS `photocount` FROM u1023543_pent.carphoto
											 WHERE u1023543_pent.carphoto.active = 1 and u1023543_pent.carphoto.deleted = 0
											 GROUP BY u1023543_pent.carphoto.caradid
										 	) as ph on ph.caradid = car.id
						GROUP BY car.id";
	}

	public function get_unlimited_list()
	{
		$query = 'SELECT c.id, c.vip_update_date, c.premium_update_date FROM carad as c
							LEFT JOIN (SELECT id, unlimited FROM user) as u on u.id = c.authorid
							WHERE c.status = 1 and c.car_status = 0 and u.unlimited = 1';

		return $this->db->query($query)->result();
	}
}

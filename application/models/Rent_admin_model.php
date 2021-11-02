<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Rent_admin_model extends CI_Model
{
	function __construct()
  {
      parent::__construct();
  }

  function get_class_list($from, $count)
	{
		$query = 'SELECT * FROM rent_class
							LIMIT '.$from.', '.$count;

		return $this->db->query($query)->result();
	}

	function get_class_list_row()
	{
		$query = 'SELECT count(*) as "count" FROM rent_class';
		return $this->db->query($query)->row();
	}

	function get_car_list($from, $end, $author_id, $status)
  {
    $where = '';
    $where .= ($author_id)?' and car.authorid = '.$author_id:'';
    $where .= ($status > -1 && $status < 5)?' and car.status = '.$status:(($status == 5)?' and car.status = 0':'');

    $query = 'SELECT car.id, car.reject_reason, car.status, car.price, car.currency, car.vip, car.vip_type, car.premium, car.premium_type,
										 mark.mark, model.model, cp.name as "image", u.first_name as "user" FROM rent_car as car
              LEFT JOIN (SELECT cp1.rent_car_id, cp1.name FROM rent_car_photo as cp1
                         LEFT JOIN (SELECT rent_car_id, min(location) as location FROM rent_car_photo WHERE active = 1 and deleted = 0 GROUP BY rent_car_id) as cp2 on cp2.rent_car_id = cp1.rent_car_id
                         WHERE cp1.location = cp2.location and cp1.deleted = 0) as cp on cp.rent_car_id = car.id
              LEFT JOIN (SELECT id, first_name FROM user) as u on u.id = car.authorid
              LEFT JOIN (SELECT id, mark FROM carmark) as mark on mark.id = car.mark
              LEFT JOIN (SELECT id, model FROM carmodel) as model on model.id = car.model
              WHERE 1'.$where.'
							GROUP BY car.id
							ORDER BY car.createdate desc
              LIMIT '.$from.', '.$end;

    return $this->db->query($query)->result();
  }

	function get_car_list_row($author_id, $status)
  {
    $where = '';
    $where .= ($author_id)?' and car.authorid = '.$author_id:'';
    $where .= ($status > -1)?' and car.status = '.$status:'';

    $query = 'SELECT count(*) as "count" FROM rent_car as car
              WHERE 1'.$where;

    return $this->db->query($query)->row();
  }

	function get_log_list($from, $end, $rent_car_id)
  {
    $where = '';
    $where .= $rent_car_id?' and rl.rent_car_id = '.$rent_car_id:'';

    $query = 'SELECT car.mark, car.model, car.image, rl.name, rl.mobile, rl.create_date FROM rent_log as rl
							LEFT JOIN (SELECT car.id as "id", mark.mark as "mark", model.model as "model", cp.name as "image" FROM rent_car as car
												 LEFT JOIN (SELECT cp1.rent_car_id, cp1.name FROM rent_car_photo as cp1
																	  LEFT JOIN (SELECT rent_car_id, min(location) as location FROM rent_car_photo WHERE active = 1 and deleted = 0 GROUP BY rent_car_id) as cp2 on cp2.rent_car_id = cp1.rent_car_id
																	  WHERE cp1.location = cp2.location) as cp on cp.rent_car_id = car.id
					               LEFT JOIN (SELECT id, mark FROM carmark) as mark on mark.id = car.mark
					               LEFT JOIN (SELECT id, model FROM carmodel) as model on model.id = car.model
												 GROUP BY car.id
											 ) as car on car.id = rl.rent_car_id
              WHERE 1'.$where.'
							ORDER BY rl.create_date desc
              LIMIT '.$from.', '.$end;

    return $this->db->query($query)->result();
  }

	function get_log_list_row($rent_car_id)
  {
    $where = '';
    $where .= $rent_car_id?' and rl.rent_car_id = '.$rent_car_id:'';

    $query = 'SELECT count(*) as "count" FROM rent_log as rl
              WHERE 1'.$where;

    return $this->db->query($query)->row();
  }

	function get_car_status($id)
	{
		$query = 'SELECT vip, vip_type, premium, premium_type, status FROM rent_car WHERE id = '.$id;
		return $this->db->query($query)->row();
	}

	function get_mail_by_carad_id($id)
  {
    $query = 'SELECT mark.mark, model.model, car.year, car.mileage, u.email FROM rent_car as car
							LEFT JOIN (SELECT id, mark FROM carmark) as mark on mark.id = car.mark
							LEFT JOIN (SELECT id, model FROM carmodel) as model on model.id = car.model
              LEFT JOIN (SELECT id, email FROM user) as u on u.id = car.authorid
              WHERE car.id = '.$id;

    return $this->db->query($query)->row();
  }

	function get_engines()
	{
		$query = 'SELECT id, engine FROM carengine
							WHERE active = 1
							ORDER BY cast(engine as decimal(4,2)) asc';

		return $this->db->query($query)->result();
	}

	function get_car_data($id)
	{
		$query = 'SELECT car.*, u.first_name, u.mobile FROM rent_car as car
							LEFT JOIN (SELECT id, first_name, mobile FROM user) as u on u.id = car.authorid
							WHERE car.id = '.$id;

		return $this->db->query($query)->row();
	}

}
